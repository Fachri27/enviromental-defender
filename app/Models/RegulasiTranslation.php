<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulasiTranslation extends Model
{
    use HasFactory;
     protected $fillable = [
        'regulasi_id',
        'locale',
        'title',
        'deskripsi',
    ];

    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class);
    }
}
