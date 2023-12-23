<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Facades\Redis;
use Throwable;

class UrlService
{
    public function createUrl(string $rawUrl): ?Url
    {
        $short = $this->generateShort();
        $maxAttempts = (int) config('takhfifan.max_short_url_generation_attempts');
        $attempts = 0;
        $url = null;

        while ($attempts <= $maxAttempts) {
            try {
                $url = Url::create([
                    'short' => $short,
                    'url' => $rawUrl,
                ]);

                break;
            } catch (Throwable) {

            }

            $attempts++;
        }

        return $url;
    }

    public function getUrl(string $short): ?string
    {
        $url = Redis::get("short:{$short}");

        if (! $url) {
            $url = Url::where('short', $short)->first()?->url;
        }

        return $url;
    }

    private function generateShort(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, 5);

        return $randomString;
    }
}