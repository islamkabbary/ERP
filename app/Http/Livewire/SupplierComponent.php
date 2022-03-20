<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Supplier;

class SupplierComponent extends Component
{
    use WithPagination;

    public $name , $company_name , $email , $addres , $phone ;
    public $supplier_id;

    protected function rules()
    {
        return [
            'name'=> 'required|string',
            'company_name' => 'required',
            'email'=> 'required|unique:suppliers,email',
            'addres' => 'required',
            'phone' => 'required|unique:suppliers,phone|max:20',
        ];
    }

    public function render()
    {
        return view('Product::suppliers.supplier-component');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email'=> 'nullable|unique:suppliers,email',
            'phone' => 'nullable|unique:suppliers,phone|max:20',
            'name'=> 'nullable|string',
            'company_name' => 'nullable',
            'addres' => 'nullable',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->supplier_id)
            $supplier = Supplier::find($this->supplier_id);
        else {
            $supplier = new Supplier();
            session()->flash('create', 'Supplier successfully create.');
        }
        $supplier->name = $this->name;
        $supplier->company_name = $this->company_name;
        $supplier->email = $this->email;
        $supplier->addres = $this->addres;
        $supplier->phone = $this->phone;
        $supplier->save();
        session()->flash('update', 'Supplier successfully update.');
        $this->clear();
    }

    function delete($supplier_id)
    {
        Supplier::destroy($supplier_id);
        session()->flash('delete', 'Supplier successfully delete.');
    }

    function edit($supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        $this->supplier_id = $supplier->id;
        $this->name = $supplier->name;
        $this->company_name = $supplier->company_name;
        $this->email = $supplier->email;
        $this->addres = $supplier->addres;
        $this->phone = $supplier->phone;
    }

    function clear()
    {
        $this->name = null;
        $this->company_name = null;
        $this->email = null;
        $this->addres = null;
        $this->phone = null;
    }
}
