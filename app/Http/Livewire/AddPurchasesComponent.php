<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Events\addPurshesInInventoryEvent;
use Modules\Product\app\Entities\Product;
use Modules\Product\app\Entities\Purchas;
use Modules\Product\app\Entities\PurchasDetails;

class AddPurchasesComponent extends Component
{
    public $product_name, $purchas_id, $supplier_id, $type, $total, $cash, $product_id,$price,$qty;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;

    protected $rules = [
            'price.0' => 'required',
            'qty.0' => 'required',
            'product_id.0' => 'required|integer|exists:products,id',
            'price.*' => 'required',
            'qty.*' => 'required',
            'product_id.*' => 'required|integer|exists:products,id',
            'type' => 'required|in:cash,installment',
            'supplier_id' => 'required|exists:suppliers,id|max:20',
        ];

    protected $messages = [
        'product_id.0.required' => 'The product id field is required.',
        'price.0.required' => 'The price field is required.',
        'qty.0.required' => 'The qty field is required.',
        'product_id.*.required' => 'The product id field is required.',
        'price.*.required' => 'The price field is required.',
        'qty.*.required' => 'The qty field is required.',
    ];

    public function render()
    {
        return view('Product::Purchas.add-purchases-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'cash' => 'required'
        ]);
        $this->type;
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function save()
    {
        $this->validate();
        DB::beginTransaction();
        $purchas = new Purchas();
        $purchas->type = $this->type;
        $purchas->user_id = Auth::id();
        $purchas->supplier_id = $this->supplier_id;
        // $purchas->total = $total_price * $total_qty;
        // dd($total_price);
        // if($this->type == "cash"){
        //     $purchas->cash = $total_price * $total_qty;
        // }
        // else{
        //     $purchas->cash = $this->cash;
        //     $purchas->installment = ($total_price * $total_qty) - $purchas->cash;
        // }
        $purchas->save();

        foreach ($this->product_id as $key => $value) {
            $purchas_detalis = new PurchasDetails();
            $purchas_detalis->purchas_id = $purchas->id;
            $purchas_detalis->product_id = $this->product_id[$key];
            $purchas_detalis->price = $this->price[$key];
            $purchas_detalis->qty = $this->qty[$key];
            $purchas_detalis->product_name = Product::find($this->product_id[$key])->name;
            $purchas_detalis->save();
            event(new addPurshesInInventoryEvent($purchas_detalis));
        }
        $this->inputs = [];
        DB::commit();
        session()->flash('create', 'Purchas successfully create.');
        DB::rollback();
        $this->clear();
    }

    function clear()
    {
        $this->type = null;
        $this->supplier_id = null;
        $this->qty = null;
        $this->price = null;
        $this->product_id = null;
    }
}
