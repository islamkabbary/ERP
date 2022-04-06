<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Redirect;
use Modules\Product\app\Entities\Product;
use Modules\Product\app\Entities\Inventory;
use App\Events\removeProductOrderInInInventoryEvent;

class removeProductOrderInInInventoryListener
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
    public function handle(removeProductOrderInInInventoryEvent $event)
    {
        $pro = Product::findOrFail($event->order_detalis->product_id);
        $inv = Inventory::where('id', $pro->inventory_id)->first();
        if($inv && $event->order_detalis->qty < $inv->qty)
        {
            $inv->qty = $inv->qty - $event->order_detalis->qty;
            $inv->save();
        }
        elseif($inv && $event->order_detalis->qty == $inv->qty){
            $inv->qty = 0;
            $inv->unit_price = 0;
            $inv->save();
        }
        elseif($inv && $event->order_detalis->qty > $inv->qty)
        {
            $inv->unit_price = 0;   
            return "not enough";
        }
        else
        {
            return "no product";
        }
    }
}
