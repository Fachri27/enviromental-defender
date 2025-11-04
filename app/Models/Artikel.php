<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'type',
        'status',
        'image',
        'user_id',
        'published_at',
    ];

    /**
     * Relasi ke ArtikelTranslation (1 → N)
     */
    public function translations()
    {
        return $this->hasMany(ArtikelTranslation::class);
    }

    /**
     * Ambil translation berdasarkan locale aktif.
     */
    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->hasOne(ArtikelTranslation::class)->where('locale', $locale);
    }

    /**
     * Helper supaya bisa langsung $artikel->title / $artikel->content
     */
    public function getTitleAttribute()
    {
        return $this->translation?->title;
    }

    public function getDeskripsiAttribute()
    {
        return $this->translation?->deskripsi;
    }

    public function getContentAttribute()
    {
        return $this->translation?->content;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
