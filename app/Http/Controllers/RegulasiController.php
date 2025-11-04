<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;


class RegulasiController extends Controller
{
    public function index($locale)
    {
        $regulasi = Regulasi::with(['translations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->get();

        return view('front.resources.regulasi', compact('regulasi', 'locale'));
    }
}
