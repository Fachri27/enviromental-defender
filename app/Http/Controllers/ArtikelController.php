<?php

namespace App\Http\Controllers;

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
                $query->whereHas('translations', function($q) use ($locale, $search) {
                    $q->where('locale', $locale)
                        ->where(function($q2) use ($search){
                            $q2->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->where('status', 'publish');

        $resources = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->when($search, function ($query, $search) use ($locale) {
                $query->whereHas('translations', function($q) use ($locale, $search) {
                    $q->where('locale', $locale)
                        ->where(function($q2) use ($search){
                            $q2->where('title', 'like', "%{$search}%");
                        });
                });
            })
            ->where('status', 'publish');

        
        $databases = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('type', 'database')
            ->where('status', 'publish')
            ->get();

        

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

        return view('front.artikel.cases', compact('cases', 'locale'));
    }

    public function showAction($locale)
    {
        $actions = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('status', 'publish')
            ->where('type', 'action')
            ->get();

        return view('front.artikel.action', compact('actions', 'locale'));
    }

    public function showAlerta($locale)
    {
        $alerta = Artikel::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('status', 'publish')
            ->where('type', 'alerta')
            ->get();

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
    
        if($artikel->type === 'action') {
            return view('front.artikel.page-action', compact('artikel'));
        } 
        elseif ($artikel->type === 'case') {
            return view('front.artikel.page-case', compact('artikel'));
        }
        else {
            return view('front.artikel.page-alerta', compact('artikel'));
        }
    }
}
