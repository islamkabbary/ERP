<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $filabell = [
        'unit_price','qty'
    ];

    protected $cast = [
        'qty' => 'integer',
        'unit_price' => 'decimal',
    ];

    /**
     * Get all of the products for the Inventory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'inventory_id','id');
    }
}
