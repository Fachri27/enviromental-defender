<?php

namespace App\Http\Controllers;

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

        return view('front.resources.database', compact('resources', 'locale'));
    }

    public function showReport($locale)
    {
        $resources = Resource::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])
            ->where('type', 'report')
            ->where('status', 'publish')
            ->get();

        return view('front.resources.report', compact('resources', 'locale'));
    }
}
