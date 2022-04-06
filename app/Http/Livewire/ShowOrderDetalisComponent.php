<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Product\app\Entities\Order;

class ShowOrderDetalisComponent extends Component
{
    public $show_detalis;
    
    public function render()
    {
        $order = Order::find($this->show_detalis)->first();
        return view('Product::order.show-order-detalis-component')->with(compact("order"));
    }
}
