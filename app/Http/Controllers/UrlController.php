<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlStoreRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Support\Facades\Redis;

class UrlController extends Controller
{
    public function __construct(private UrlService $service)
    {
    }

    public function store(UrlStoreRequest $request)
    {
        $url = $this->service->createUrl($request->url);

        if (! $url) {
            return response()->json(['Failed to create url :(']);
        }

        Redis::set("short:{$url->short}", $url->url);

        return UrlResource::make($url);
    }

    public function redirect(string $short)
    {
        $url = $this->service->getUrl($short);
        
        if (! $url) {
            return response()->json(['Failed to fetch url :(']);
        }

        return response()->json([
            'short' => $short,
            'url' => $url,
        ]);
    }

    public function show(Url $url)
    {
        // bind url by short and return
    }

    public function destroy(Url $url)
    {
        // remove from db and redis
    }
}
