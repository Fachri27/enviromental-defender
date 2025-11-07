<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelper;
use App\Models\Artikel;
use App\Models\Resource;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function indexHome(Request $request, $locale)
    {
        $search = $request->input('search');
        $baseQuery = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->when($search, function ($query, $search) use ($locale) {
                $query->whereHas('translations', function ($q) use ($locale, $search) {
                    $q->where('locale', $locale)
                        ->where(function ($q2) use ($search) {
                            $q2->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->where('status', 'publish');

        $resources = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->when($search, function ($query, $search) use ($locale) {
                $query->whereHas('translations', function ($q) use ($locale, $search) {
                    $q->where('locale', $locale)
                        ->where(function ($q2) use ($search) {
                            $q2->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->where('status', 'publish');

        $databases = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('type', 'database')
            ->where(
                'status', 'publish')
            ->get();

        $meta = [
            'title' => __('Enviromental Defender'),
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

        // Ambil 1 artikel terbaru per type
        $action = (clone $baseQuery)->where('type', 'action')->latest('published_at')->first();
        $report = (clone $resources)->where('type', 'report')->latest('start_date')->first();
        $case = (clone $baseQuery)->where('type', 'case')->latest('published_at')->first();

        return view('front.home', compact('action', 'report', 'case', 'databases', 'search'));
    }

    public function showCases($locale)
    {
        $cases = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('status', 'publish')
            ->where('type', 'case')
            ->get();

        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Cases'),
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

        return view('front.artikel.cases', compact('cases', 'locale', 'schema'));
    }

    public function showAction($locale)
    {
        $actions = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('status', 'publish')
            ->where('type', 'action')
            ->get();

        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Actions'),
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

        return view('front.artikel.action', compact('actions', 'locale', 'schema'));
    }

    public function showAlerta($locale)
    {
        $alerta = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('status', 'publish')
            ->where('type', 'alerta')
            ->get();

        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Alerta'),
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

        return view('front.artikel.alerta', compact('alerta', 'locale'));
    }

    public function preview($locale, $slug)
    {
        $artikel = Artikel::with(relations: ['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        // ambil data SEO otomatis dari model
        $meta = $artikel->getSeoData($locale);

        seo()->setLocale($locale)
            ->set('title', ['id' => $meta['title'], 'en' => $meta['title']])
            ->set('description', ['id' => $meta['description'], 'en' => $meta['description']])
            ->set('image', $meta['image'])
            ->set('type', $meta['type']);

        $schema = SchemaHelper::article(
            $meta['title'],
            $meta['description'],
            $meta['image'],
            $artikel->author->name ?? 'Environmental Defender',
        );

        if ($artikel->type === 'action') {
            return view('front.artikel.page-action', compact('artikel'));
        } elseif ($artikel->type === 'case') {
            return view('front.artikel.page-case', compact('artikel'));
        } else {
            return view('front.artikel.page-alerta', compact('artikel'));
        }
    }
}
