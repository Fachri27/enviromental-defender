<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelper;
use App\Models\Regulasi;


class RegulasiController extends Controller
{
    public function index($locale)
    {
        $regulasi = Regulasi::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();

        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Resources'),
            'description' => __('Situs ini didedikasikan untuk peningkatan keselamatan Pembela Lingkungan. Memuat database ancaman terhadap Pembela Lingkungan, dan berbagai informasi yang relevan dengan perbaikan keselamatannya.'),
            'image' => asset('images/logo.png'),
            'type' => 'article',
        ];

        seo()->setLocale($locale)
            ->set('title', ['id' => $meta['title'], 'en' => $meta['title']])
            ->set('description', ['id' => $meta['description'], 'en' => $meta['description']])
            ->set('image', $meta['image'])
            ->set('type', $meta['type']);

        $schema = SchemaHelper::article(
            $meta['title'],
            $meta['description'],
            $meta['image'],
            'Environmental Defender',
        );

        return view('front.resources.regulasi', compact('regulasi', 'locale', 'schema'));
    }
}
