<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSeoMeta
{
    public function getSeoData(string $locale = 'id')
    {
        $translation = $this->translations->where('locale', $locale)->first();

        return [
            'title' => $translation->title ?? ($this->title ?? config('app.name')),
            'description' => $translation->meta_description ?? Str::limit(strip_tags($translation->deskripsi ?? $translation->content ?? ''), 160),
            'image' => isset($this->image) ? asset('storage/' . $this->image) : asset('images/logo.png'),
            'type' => 'article',
        ];
    }
}
