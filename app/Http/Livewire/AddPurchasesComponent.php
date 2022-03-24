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
    public $product_name, $price, $qty, $purchas_id, $product_id, $supplier_id, $type, $total;

    protected function rules()
    {
        return [
            'price' => 'required',
            'qty' => 'nullable',
            'type' => 'required|in:cash,installment',
            'supplier_id' => 'required|exists:suppliers,id|max:20',
            'product_id' => 'required|integer|exists:products,id'
        ];
    }

    public function render()
    {
        return view('Product::Purchas.add-purchases-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        dd($this->price);
        DB::beginTransaction();
        $purchas = new Purchas();
        $purchas->type = $this->type;
        $purchas->total = $this->price * $this->qty;
        $purchas->user_id = Auth::id();
        $purchas->supplier_id = $this->supplier_id;
        $purchas->save();

        $purchas_detalis = new PurchasDetails();
        $purchas_detalis->purchas_id = $purchas->id;
        $purchas_detalis->price = $this->price;
        $purchas_detalis->qty = $this->qty;
        $purchas_detalis->product_id = $this->product_id;
        $purchas_detalis->product_name = Product::find($this->product_id)->name;
        $purchas_detalis->save();
        event(new addPurshesInInventoryEvent($purchas,$purchas_detalis));
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
