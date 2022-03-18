<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path',
        'type',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
