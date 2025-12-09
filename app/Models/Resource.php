<?php

namespace App\Models;

use App\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    // use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'slug',
        'type',
        'status',
        'image',
        'file_type',
        'start_date',
        'end_date',
        'user_id',
    ];

    /**
     * Relasi ke ResourceTranslation (1 → N)
     */
    public function translations()
    {
        return $this->hasMany(ResourceTranslation::class);
    }

    /**
     * Ambil translation berdasarkan locale saat ini.
     */
    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->hasOne(ResourceTranslation::class)->where('locale', $locale);
    }

    /**
     * Helper untuk akses langsung, misal $resource->title
     */
    public function getTitleAttribute()
    {
        return $this->translation?->title;
    }

    public function getDeskripsiAttribute()
    {
        return $this->translation?->deskripsi;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
