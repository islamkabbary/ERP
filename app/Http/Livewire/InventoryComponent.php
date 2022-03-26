<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Inventory;

class InventoryComponent extends Component
{
    use WithPagination;

    protected $listeners = ['newPurshes'];
    public $unit_price, $qty, $product_id, $inventory_id;

    protected function rules()
    {
        return [
            'unit_price' => 'required|between:0,99.99',
            'qty' => 'required|integer',
            'product_id' => 'required|integer|exists:products,id',
        ];
    }

    public function render()
    {
        return view('Product::inventory.inventory-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'unit_price' => 'nullable|between:0,99.99',
            'qty' => 'nullable|integer',
            'product_id' => 'nullable|integer|exists:products,id',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->inventory_id)
            $inventory = Inventory::find($this->inventory_id);
        else {
            $inventory = new Inventory();
            session()->flash('create', 'Inventory successfully create.');
        }
        $inventory->qty = $this->qty;
        $inventory->unit_price = $this->unit_price;
        $inventory->product_id = $this->product_id;
        $inventory->save();
        session()->flash('update', 'Inventory successfully update.');
        $this->clear();
    }

    function delete($inventory_id)
    {
        Inventory::destroy($inventory_id);
        session()->flash('delete', 'Inventory successfully delete.');
    }

    function edit($inventory_id)
    {
        $inventory = Inventory::find($inventory_id);
        $this->inventory_id = $inventory->id;
        $this->qty = $inventory->qty;
        $this->unit_price = $inventory->unit_price;
        $this->product_id = $inventory->product_id;
    }

    function clear()
    {
        $this->unit_price = null;
        $this->qty = null;
        $this->product_id = null;
    }
}
