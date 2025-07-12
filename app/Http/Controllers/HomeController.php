<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Transaction;
use App\Models\CasinoOyun;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->getHomeData();
        Log::info('Controller data being sent:', $data);
        return Inertia::render('HomeSelector', $data);
    }

    private function getHomeData()
    {
        $carouselItems = Slider::orderBy('sira')->get(['gorsel', 'url', 'sira'])->map(fn($item) => [
            'gorsel' => $item->gorsel,
            'url' => $item->url,
            'sira' => $item->sira,
        ]);

        $lastWinners = Transaction::with(['user', 'game.provider'])
            ->where('type', 'win')
            ->where('amount', '>=', 500)
            ->orderByDesc('id')
            ->limit(4000)
            ->get()
            ->map(function ($t) {
                $admin = $t->user;
                $game = $t->game;

                if (!$game) {
                    $svg = base64_encode('<svg width="64" height="64" xmlns="http://www.w3.org/2000/svg"><rect width="64" height="64" fill="#333"/><text x="32" y="37" text-anchor="middle" fill="#00ff88" font-size="12" font-family="Arial">GAME</text></svg>');
                    return [
                        'amount' => $t->amount,
                        'gameid' => $t->gameid,
                        'user_id' => $t->user_id,
                        'username' => $admin ? $admin->name : 'Bulunamadı',
                        'gameName' => $t->gamename ?? 'Bilinmeyen Oyun',
                        'game_name' => $t->gamename ?? 'Bilinmeyen Oyun',
                        'gameImage' => 'data:image/svg+xml;base64,' . $svg,
                        'cover' => 'data:image/svg+xml;base64,' . $svg,
                        'provider' => 'Bilinmeyen Provider',
                    ];
                }

                return [
                    'amount' => $t->amount,
                    'gameid' => $t->gameid,
                    'user_id' => $t->user_id,
                    'username' => $admin ? $admin->name : 'Bulunamadı',
                    'gameName' => $game->game_name,
                    'game_name' => $game->game_name,
                    'gameImage' => $game->cover,
                    'cover' => $game->cover,
                    'provider' => $game->provider ? $game->provider->name : 'Bilinmeyen Provider',
                ];
            });

        $excludedList = [73, 72, 55, 56, 54, 29, 30, 31, 32, 33, 7, 8, 9, 3, 58, 90, 102, 69, 95, 83, 63, 76, 28, 67, 68, 91, 5];

        $allGames = \App\Models\Game::with('provider')
            ->whereNotIn('provider_id', $excludedList)
            ->orderBy('game_name', 'asc')
            ->get()
            ->map(fn($game) => [
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
            ]);

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
                'name' => 'Live Casino Game ' . $game->id,
                'category' => 'Live Casino'
            ];
        });

        $casinoOyunlari = CasinoOyun::orderBy('sira', 'asc')->get()->map(fn($oyun) => [
            'gorsel' => $oyun->gorsel,
            'url' => $oyun->url,
            'sira' => $oyun->sira,
        ]);

        $oyunlar = \App\Models\Oyun::orderBy('sira', 'asc')->get()->map(fn($oyun) => [
            'gorsel' => $oyun->gorsel,
            'url' => $oyun->url,
            'sira' => $oyun->sira,
        ]);

        return compact('carouselItems', 'lastWinners', 'allGames', 'liveCasinoGames', 'casinoOyunlari', 'oyunlar');
    }
}
