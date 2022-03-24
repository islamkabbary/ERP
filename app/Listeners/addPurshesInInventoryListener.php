<?php

namespace App\Listeners;

use App\Events\addPurshesInInventoryEvent;
use Modules\Product\app\Entities\Inventory;
use Modules\Product\app\Entities\Product;

class addPurshesInInventoryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(addPurshesInInventoryEvent $event)
    {
        try {
            $pro = Product::findOrFail($event->purchas_detalis->product_id);
            $inv = Inventory::where('id', $pro->inventory_id)->first();
            if ($inv) {
                $inv->unit_price = ($inv->unit_price + $event->purchas_detalis->price) / 2;
                $inv->qty = $inv->qty + $event->purchas_detalis->qty;
                $inv->save();
            } else {
                $productInInventory = new Inventory();
                $productInInventory->unit_price    = $event->purchas_detalis->price;
                $productInInventory->qty    = $event->purchas_detalis->qty;
                $productInInventory->save();
                $pro->inventory_id = $productInInventory->id;
                $pro->save();
            }
        } catch (\Throwable $th) {
            //
        }
    }
}
