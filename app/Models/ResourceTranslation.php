<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'resource_id',
        'locale',
        'title',
        'deskripsi',
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
