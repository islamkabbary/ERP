<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'price', 'qty', 'total_product', 'product_id', 'purchas_id'
    ];

    protected $cast = [
        'product_id' => 'integer',
        'purchas_id' => 'integer',
        'qty' => 'integer',
        'price' => 'decimal',
    ];

    /**
     * Get the purchas that owns the PurchasDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchas(): BelongsTo
    {
        return $this->belongsTo(Purchas::class);
    }
}
