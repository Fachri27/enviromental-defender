<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'artikel_id',
        'locale',
        'title',
        'deskripsi',
        'content',
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class);
    }
}
