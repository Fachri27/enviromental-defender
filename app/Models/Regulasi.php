<?php

namespace App\Models;

use App\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'link'
    ];

    public function translations()
    {
        return $this->hasMany(RegulasiTranslation::class);
    }
}
