<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegulasiController;
use App\Http\Controllers\ResourceController;
use App\Livewire\Admin\RegulasiForm;
use App\Livewire\Admin\RegulasiTable;
use App\Livewire\Admin\ResourceForm;
use App\Livewire\Admin\ResourceTable;
use App\Livewire\ArtikelForm;
use App\Livewire\ArtikelTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/id'); // default ke Indonesia
});

Route::group([
    'prefix' => '{locale}',
    'middleware' => ['setlocale'],
    'where' => ['locale' => 'en|id'],
], function () {

    Route::get('/', [ArtikelController::class, 'indexHome'])->name('home.index');

    //about
    Route::get('page/about/environmental', function () {
        return view('front.about.enviromental');
    })->name('about.enviromental');
    
    Route::get('page/about/situs', function () {
        return view('front.about.situs');
    })->name('about.situs');


    //resources
    Route::get('page/resource/database', [ResourceController::class, 'showData'])->name('database.index');
    Route::get('page/resource/report', [ResourceController::class, 'showReport'])->name('report.index');
    Route::get('page/resource/regulasi', [RegulasiController::class, 'index'])->name('regulasi.index');

    //artikel
    Route::get('page/cases', [ArtikelController::class, 'showCases'])->name('cases.index');
    Route::get('page/action', [ArtikelController::class, 'showAction'])->name('action.index');
    Route::get('page/alerta', [ArtikelController::class, 'showAlerta'])->name('alerta.index');
    Route::get('/news/{slug}', [ArtikelController::class, 'preview'])->name('artikel.page');
});

Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    // resources
    Route::get('/resource', ResourceTable::class)->name('resource.index');
    Route::get('/resource/create', ResourceForm::class)->name('resource.create');
    Route::get('/resource/{resourceId}/edit', ResourceForm::class)->name('resource.edit');

    // artikel
    Route::get('/artikel', ArtikelTable::class)->name('artikel.index');
    Route::get('/artikel/create', ArtikelForm::class)->name('artikel.create');
    Route::get('/artikel/{artikelId}/edit', ArtikelForm::class)->name('artikel.edit');

    // regulasi
    Route::get('/regulasi', RegulasiTable::class)->name('regulasi.index.v2');
    Route::get('/regulasi/create', RegulasiForm::class)->name('regulasi.create');
    Route::get('/regulasi/{regulasiId}/edit', RegulasiForm::class)->name('regulasi.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

require __DIR__.'/auth.php';