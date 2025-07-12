<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\CasinoOyun;

class HomeController extends Controller
{
    public function index()
    {
        $carouselItems = Slider::orderBy('sira')->get(['gorsel', 'url', 'sira'])->map(function ($item) {
            return [
                'gorsel' => $item->gorsel,
                'url' => $item->url,
                'sira' => $item->sira,
            ];
        });

        $lastWinners = Transaction::with(['user', 'game.provider'])
            ->where('type', 'win')
            ->where('amount', '>=', 500)
            ->orderByDesc('id')
            ->limit(4000)
            ->get()
            ->map(function ($t) {
                $admin = $t->user;
                $game = $t->game;
                Log::info('TransactionID: ' . $t->id . ' | gameid: ' . $t->gameid . ' | Game: ' . json_encode($game));

                // Game null ise default değerler kullan
                if (!$game) {
                    return [
                        'amount' => $t->amount,
                        'gameid' => $t->gameid,
                        'user_id' => $t->user_id,
                        'username' => $admin ? $admin->name : 'Buluanamadı',
                        'gameName' => $t->gamename ?? 'Bilinmeyen Oyun',
                        'game_name' => $t->gamename ?? 'Bilinmeyen Oyun',
                        'gameImage' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="64" height="64" xmlns="http://www.w3.org/2000/svg"><rect width="64" height="64" fill="#333"/><text x="32" y="37" text-anchor="middle" fill="#00ff88" font-size="12" font-family="Arial">GAME</text></svg>'),
                        'cover' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="64" height="64" xmlns="http://www.w3.org/2000/svg"><rect width="64" height="64" fill="#333"/><text x="32" y="37" text-anchor="middle" fill="#00ff88" font-size="12" font-family="Arial">GAME</text></svg>'),
                        'provider' => 'Bilinmeyen Provider',
                    ];
                }

                return [
                    'amount' => $t->amount,
                    'gameid' => $t->gameid,
                    'user_id' => $t->user_id,
                    'username' => $admin ? $admin->name : 'Buluanamadı',
                    'gameName' => $game->game_name,
                    'game_name' => $game->game_name,
                    'gameImage' => $game->cover,
                    'cover' => $game->cover,
                    'provider' => $game->provider ? $game->provider->name : 'Bilinmeyen Provider',
                ];
            });

        // Oyunlar için Eloquent ile sorgu
        $excludedList = [73, 72, 55, 56, 54, 29, 30, 31, 32, 33, 7, 8, 9, 3, 58, 90, 102, 69, 95, 83, 63, 76, 28, 67, 68, 91, 5];
        $allGames = \App\Models\Game::with('provider')
            ->whereNotIn('provider_id', $excludedList)
            ->orderBy('game_name', 'asc')
            ->get()
            ->map(function ($game) {
                return [
                    'game_id' => $game->game_id,
                    'game_code' => $game->game_code,
                    'game_name' => $game->game_name,
                    'cover' => $game->cover,
                    'provider_id' => $game->provider_id,
                    'turnuva' => $game->turnuva,
                    'jackpot' => $game->jackpot,
                    'freespin' => $game->freespin,
                    'drop' => $game->drop,
                    'populer' => $game->populer,
                    'eniyi' => $game->eniyi,
                    'megaways' => $game->megaways,
                    'provider_name' => $game->provider ? $game->provider->name : null,
                    'category' => $game->game_type ? ucfirst($game->game_type) : 'Diğer',
                ];
            });

        // Canlı Casino oyunları için Eloquent ile sorgu
        $liveCasinoGames = \App\Models\CanliCasino::orderBy('sira', 'asc')->get()->map(function ($game) {
            $cover = $game->gorsel ?? null;
            if ($cover && !str_starts_with($cover, 'http') && !str_starts_with($cover, '/images/')) {
                $cover = '/images/' . ltrim($cover, '/');
            }
            return [
                'id' => $game->id,
                'cover' => $cover,
                'url' => $game->url,
                'sira' => $game->sira,
                'name' => 'Live Casino Game ' . $game->id, // Geçici isim
                'category' => 'Live Casino' // Geçici kategori
            ];
        });

        $casinoOyunlari = CasinoOyun::orderBy('sira', 'asc')->get()->map(function ($oyun) {
            return [
                'gorsel' => $oyun->gorsel,
                'url' => $oyun->url,
                'sira' => $oyun->sira,
            ];
        });


        //SELECT * FROM oyunlar ORDER BY sira ASC Oyun modelinden verileri çekiyoruz
        $oyunlar = \App\Models\Oyun::orderBy('sira', 'asc')->get()->map(function ($oyun) {
            return [
                'gorsel' => $oyun->gorsel,
                'url' => $oyun->url,
                'sira' => $oyun->sira,
            ];
        });

        return Inertia::render('Home', [
            'carouselItems' => $carouselItems,
            'lastWinners' => $lastWinners,
            'allGames' => $allGames,
            'liveCasinoGames' => $liveCasinoGames,
            'casinoOyunlari' => $casinoOyunlari,
            'oyunlar' => $oyunlar,
        ]);
    }
}
