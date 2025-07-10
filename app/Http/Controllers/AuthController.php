<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Modal metodları
    public function showLoginModal(Request $request)
    {
        if ($request->has('modal')) {
            return view('auth.login-modal');
        }
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        // Admin modelinde username veya email ile giriş
        $admin = Admin::where(function ($query) use ($credentials) {
            $query->where('username', $credentials['username'])
                ->orWhere('email', $credentials['username']);
        })->where('password', md5($credentials['password']))
            ->first();

        if ($admin) {
            if ($admin->durum == 2) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'username' => 'Hesabınız askıya alınmıştır. Detaylı Bilgi İçin Canlı Desteğe Bağlanınız.'
                ]);
            }

            session(['admin_id' => $admin->id, 'admin' => $admin]);
            $admin->update([
                'songirisi' => now(),
                'songirisip' => $request->ip()
            ]);

            // Inertia için redirect response
            return redirect()->intended('/');
        } else {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'username' => 'Kullanıcı adı/email veya şifre hatalı.'
            ]);
        }
    }

    public function showRegisterModal(Request $request)
    {
        if ($request->has('modal')) {
            return view('auth.register-modal');
        }
        return view('auth.register');
    }

    private function mernisTCKimlikDogrula($tc, $ad, $soyad, $dogumYili)
    {
        if (strlen($tc) !== 11) {
            return false;
        }
        try {
            $client = new \SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');
            $parametre = [
                'TCKimlikNo' => $tc,
                'Ad'         => $ad,
                'Soyad'      => $soyad,
                'DogumYili'  => (int)$dogumYili
            ];
            $result = $client->TCKimlikNoDogrula($parametre);
            return $result->TCKimlikNoDogrulaResult;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8|confirmed',
            'currency' => 'required|string|max:10',
            'telefon' => 'required|string|max:20',
            'postakodu' => 'required|string|max:20',
            'ulke' => 'required|string|max:255',
            'il' => 'required|string|max:32',
            'ilce' => 'required|string|max:32',
            'dt' => 'required|string|max:10',
            'tc' => 'required|string|max:20',
        ]);

        // Doğum yılına ve MySQL formatına al
        $dogumYili = null;
        $dtMysql = null;
        if ($request->dt && preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $request->dt, $m)) {
            $dogumYili = $m[1];
            $dtMysql = $request->dt;
        }

        // TC Kimlik doğrulama
        if (!$this->mernisTCKimlikDogrula($request->tc, $request->name, $request->surname, $dogumYili)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'tc' => 'TC Kimlik doğrulaması başarısız. Bilgilerinizi kontrol ediniz.'
            ]);
        }

        $admin = Admin::create([
            'name' => $request->name . ' ' . $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => md5($request->password),
            'bakiye' => 0,
            'parabirimi' => $request->currency,
            'durum' => 1,
            'sifresi' => null,
            'telefon' => $request->telefon,
            'postakodu' => $request->postakodu,
            'ulke' => $request->ulke,
            'il' => $request->il,
            'ilce' => $request->ilce,
            'dt' => $dtMysql,
            'tc' => $request->tc,
            'spor' => 1,
            'casino' => 1,
            'cekim' => 1,
            'cevrim' => 1,
            '2factor' => 0,
            'aff' => 0,
            'bayisi' => 'default',
            'songirisi' => null,
            'kayit_ip' => $request->ip(),
            'kayit_tarih' => now(),
            'songiris' => null,
            'songirisip' => $request->ip(),
        ]);

        session(['admin_id' => $admin->id, 'admin' => $admin]);

        // Inertia için redirect response
        return redirect()->intended('/');
    }

    public function userLogout(Request $request)
    {
        // Admin session'ını temizle
        $request->session()->forget(['admin_id', 'admin']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Inertia için redirect response
        return redirect('/');
    }

    // ADMIN KAYIT (REGISTER)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'    => 'required|unique:admin',
            'password'    => 'required|min:6',
            'name'        => 'nullable|string',
            'email'       => 'required|email|unique:admin',
            'bakiye'      => 'nullable|numeric',
            'parabirimi'  => 'nullable|string|max:25',
            'durum'       => 'nullable|integer',
            'sifresi'     => 'nullable|string|max:64',
            'telefon'     => 'nullable|string|max:20',
            'postakodu'   => 'nullable|integer',
            'ulke'        => 'required|string|max:255',
            'il'          => 'nullable|string|max:32',
            'ilce'        => 'nullable|string|max:32',
            'dt'          => 'nullable|date',
            'tc'          => 'nullable|numeric',
            'spor'        => 'nullable|integer',
            'casino'      => 'nullable|integer',
            'cekim'       => 'nullable|integer',
            '2factor'     => 'nullable|integer',
            'aff'         => 'nullable|integer',
            'bayisi'      => 'required|string|max:255',
            'songirisi'   => 'nullable|string|max:50',
            'kayit_ip'    => 'nullable|string',
            'kayit_tarih' => 'nullable|date',
            'cevrim'      => 'nullable|string|max:255',
            'songiris'    => 'nullable|string|max:255',
            'songirisip'  => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $admin = Admin::create([
            'username'    => $request->username,
            'password'    => md5($request->password),
            'name'        => $request->name,
            'email'       => $request->email,
            'bakiye'      => $request->bakiye ?: 0,
            'parabirimi'  => $request->parabirimi ?: 'TRY',
            'durum'       => $request->durum ?: 1,
            'sifresi'     => $request->sifresi,
            'telefon'     => $request->telefon,
            'postakodu'   => $request->postakodu,
            'ulke'        => $request->ulke,
            'il'          => $request->il,
            'ilce'        => $request->ilce,
            'dt'          => $request->dt,
            'tc'          => $request->tc,
            'spor'        => $request->spor ?: 1,
            'casino'      => $request->casino ?: 1,
            'cekim'       => $request->cekim ?: 1,
            '2factor'     => $request['2factor'] ?: 0,
            'aff'         => $request->aff ?: 0,
            'bayisi'      => $request->bayisi,
            'songirisi'   => $request->songirisi,
            'kayit_ip'    => $request->ip(),
            'kayit_tarih' => now(),
            'cevrim'      => $request->cevrim,
            'songiris'    => $request->songiris,
            'songirisip'  => $request->songirisip
        ]);

        return response()->json(['status' => true, 'message' => 'Kayıt başarılı', 'admin' => $admin]);
    }

    // ADMIN GİRİŞ (LOGIN)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $admin = Admin::where('username', $request->username)
            ->where('password', md5($request->password))
            ->first();

        if (!$admin) {
            return response()->json(['status' => false, 'message' => 'Kullanıcı adı veya şifre yanlış!'], 401);
        }

        // Durum kontrolü - 2 ise banlanmış kullanıcı
        if ($admin->durum == 2) {
            return response()->json(['status' => false, 'message' => 'Hesabınız askıya alınmıştır. Detaylı Bilgi İçin Canlı Desteğe Bağlanınız.'], 403);
        }

        $admin->update([
            'songirisi'  => now(),
            'songirisip' => $request->ip()
        ]);

        return response()->json(['status' => true, 'message' => 'Giriş başarılı', 'admin' => $admin]);
    }

    // ŞİFRE DEĞİŞTİRME
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = session('admin');
        if (!$admin) {
            return response()->json(['status' => false, 'message' => 'Oturum bulunamadı. Lütfen tekrar giriş yapın.'], 401);
        }

        $adminModel = \App\Models\Admin::find($admin->id);
        if (!$adminModel || $adminModel->password !== md5($request->current_password)) {
            return response()->json(['status' => false, 'message' => 'Mevcut şifre yanlış.'], 403);
        }

        $adminModel->password = md5($request->new_password);
        $adminModel->save();
        session(['admin' => $adminModel]);

        return response()->json(['status' => true, 'message' => 'Şifreniz başarıyla değiştirildi.']);
    }
}
