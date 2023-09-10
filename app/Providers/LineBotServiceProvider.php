<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineBotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(LINEBot::class, function ($app) {
            return new LINEBot(
                new CurlHTTPClient(env('LINE_BOT_CHANNEL_TOKEN')),
                ['channelSecret' => env('LINE_BOT_CHANNEL_SECRET')]
            );
        });
    }
}
