<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $filablle = [
        'name','email','addres','phone','company_name'
    ];
}
