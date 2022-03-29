<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchas extends Model
{
    use HasFactory;

    protected $fillable = [
        'total', 'cash', 'installment', 'type', 'supplier_id', 'user_id'
    ];

    protected $cast = [
        'supplier_id' => 'integer',
        'user_id' => 'integer',
        'total' => 'decimal',
        'installment' => 'decimal',
        'cash' => 'decimal',
    ];

    /**
     * Get all of the PurchasDetails for the Purchas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchasDetails(): HasMany
    {
        return $this->hasMany(PurchasDetails::class);
    }

    /**
     * Get the supplier that owns the Purchas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
