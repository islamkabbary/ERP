<?php

namespace App\Http\Livewire;

use App\Events\removeProductOrderInInInventoryEvent;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Product\app\Entities\Order;
use Modules\Product\app\Entities\Product;
use Modules\Product\app\Entities\OrderDetails;

class CreateOrderComponent extends Component
{
    public $product_name, $order_id, $customer_id, $type, $cash, $product_id, $qty ,$total;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;

    protected $rules = [
        'product_id.0' => 'required|integer|exists:products,id',
        'qty.0' => 'required',
        'product_id.*' => 'required|integer|exists:products,id',
        'qty.*' => 'required',
        'type' => 'required|in:cash,installment',
        'cash' => 'required_if:type,installment',
        'customer_id' => 'required_if:type,installment',
    ];

    protected $messages = [
        'product_id.0.required' => 'The product field is required.',
        'customer_id.0.required' => 'The customer field is required.',
        'qty.0.required' => 'The qty field is required.',
        'product_id.*.required' => 'The product field is required.',
        'qty.*.required' => 'The qty field is required.',
    ];

    public function render()
    {
        return view('Product::order.create-order-component');
    }

    public function updated($propertyName)
    {
        $this->type;
        $this->validateOnly($propertyName);
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;

        array_push($this->inputs, $i);
    }
    public function remove($i)
    {
        unset($this->product_id[$i+1]);
        unset($this->qty[$i+1]);
        unset($this->inputs[$i]);
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        $order = new Order();
        $order->type = $this->type;
        $order->user_id = Auth::id();
        $order->customer_id = $this->customer_id;
        $total = [];
        $prices = [];
        foreach($this->product_id as $key => $value){
            $prices[] += Product::find($value)->price;
        }
        for ($i = 0; $i < count($prices); $i++) {
            $total[] += $prices[$i] * $this->qty[$i];
        }
        $order->total = array_sum($total);
        if ($this->type == "cash") {
            $order->cash = $order->total;
        } elseif($this->type == "installment" && $this->cash < $order->total) {
            $order->cash = $this->cash;
            $order->installment = $order->total - $order->cash;
        }elseif($this->type == "installment" && $this->cash >= $order->total)
        {
            $order->type = 'cash';
            $order->cash = $order->total;
        }
        $order->save();
        foreach ($this->product_id as $key => $value) {
            $order_detalis = new OrderDetails();
            $order_detalis->order_id = $order->id;
            $order_detalis->qty = $this->qty[$key];
            $order_detalis->product_id = $this->product_id[$key];
            $order_detalis->price = Product::find($this->product_id[$key])->price;
            $order_detalis->total_product = $this->qty[$key] * Product::find($this->product_id[$key])->price;
            $order_detalis->product_name = Product::find($this->product_id[$key])->name;
            $order_detalis->save();
            $ev = event(new removeProductOrderInInInventoryEvent($order_detalis));
            if($ev[0] == 'not enough'){
                session()->flash('Not Enough', 'Quantity Not Enough');
                DB::rollback();
            }
            elseif($ev[0] == 'no product'){
                session()->flash('No Product', 'Product Not Found');
                DB::rollback();
            }
            else{
                $this->inputs = [];
                DB::commit();
                $this->clear();
                session()->flash('create', 'Order successfully create.');
                return redirect()->to('dashboard/show-order-details/'.$order->id);
            }
        }
    }

    function clear()
    {
        $this->type = null;
        $this->customer_id = null;
        $this->qty = null;
        $this->product_id = null;
        $this->cash = null;
        $this->customer_id = null;
    }
}
