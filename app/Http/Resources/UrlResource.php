<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'short' => $this->short,
            'url' => $this->url,
            'created_at' => $this->created_at,
        ];
    }
}
