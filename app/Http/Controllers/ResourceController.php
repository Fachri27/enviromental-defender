<?php

namespace App\Http\Controllers;

use App\Helpers\SchemaHelper;
use App\Models\Artikel;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function indexHome($locale)
    {
        $resources = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('type', 'database')
            ->where('status', 'publish')
            ->get();

        return view('front.home', compact('resources', 'locale'));
    }
    
    public function showData($locale)
    {
        $resources = Resource::with(['translations' => function ($q) use ($locale) {
            $q->where('locale', $locale);
        }])
            ->where('type', 'database')
            ->where('status', 'publish')
            ->get();
        
        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Resources'),
            'description' => __('Situs ini didedikasikan untuk peningkatan keselamatan Pembela Lingkungan. Memuat database ancaman terhadap Pembela Lingkungan, dan berbagai informasi yang relevan dengan perbaikan keselamatannya.'),
            'image' => asset('images/new3.png'),
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

        return view('front.resources.database', compact('resources', 'locale', 'schema'));
    }

    public function showReport($locale)
    {
        $resource = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('type', 'report')
            ->where('status', 'publish')
            ->get();

        // Title & description manual (karena ini bukan 1 artikel)
        $meta = [
            'title' => __('Resources'),
            'description' => __('Situs ini didedikasikan untuk peningkatan keselamatan Pembela Lingkungan. Memuat database ancaman terhadap Pembela Lingkungan, dan berbagai informasi yang relevan dengan perbaikan keselamatannya.'),
            'image' => asset('images/new3.png'),
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

        return view('front.resources.report', compact('resource', 'locale', 'schema'));
    }

    public function preview($locale, $slug) {
        //buat preview
        $page = Artikel::with('translations')
            // ->where('page_type', $page_type)
            ->where('slug', $slug)
            ->firstOrFail();
        
        return view('front.artikel.page-action', compact('page'));
    }
}
