<?php

namespace Modules\Product\app\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $filaballe = ['name','price','dis','category_id','supplier_id','brand_id'];

    protected $cast = [
        'category_id' => 'integer',
        'supplier_id' => 'integer',
        'brand_id' => 'integer'
    ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the inventory that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class,'id','inventory_id');
    }
    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    
    /**
     * Get the supplier that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get all of the option for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function option(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class,'imageable');
    }

    /**
     * The purchass that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(Purchas::class, 'purchas_details', 'purchas_id', 'product_id');
    }

    /**
     * The orders that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(orders::class, 'order_details', 'order_id', 'product_id');
    }
}
