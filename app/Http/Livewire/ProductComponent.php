<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Product;

class ProductComponent extends Component
{
    use WithPagination;

    public $name , $price , $dis , $product_id ,$brand_id , $supplier_id ,$category_id;

    protected function rules()
    {
        return [
            'name'=> 'required|string',
            'price' => 'required',
            'dis'=> 'nullable',
            'brand_id' => 'required|exists:brands,id|max:20',
            'supplier_id' => 'required|exists:suppliers,id|max:20',
            'category_id' => 'required|exists:categories,id|max:20',
        ];
    }

    public function render()
    {
        return view('Product::products.product-component');
    }
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name'=> 'nullable|string',
            'price' => 'nullable',
            'dis'=> 'nullable',
            'brand_id' => 'nullable|exists:brands,id|max:20',
            'supplier_id' => 'nullable|exists:suppliers,id|max:20',
            'category_id' => 'nullable|exists:categories,id|max:20',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->product_id)
            $product = Product::find($this->product_id);
        else {
            $product = new Product();
            session()->flash('create', 'Product successfully create.');
        }
        $product->name = $this->name;
        $product->price = $this->price;
        $product->dis = $this->dis;
        $product->supplier_id = $this->supplier_id;
        $product->brand_id = $this->brand_id;
        $product->category_id = $this->category_id;
        $product->save();
        session()->flash('update', 'Product successfully update.');
        $this->clear();
    }

    function delete($product_id)
    {
        Product::destroy($product_id);
        session()->flash('delete', 'Product successfully delete.');
    }

    function edit($product_id)
    {
        $product = Product::find($product_id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->dis = $product->dis;
        $this->supplier_id = $product->supplier_id;
        $this->brand_id = $product->brand_id;
        $this->category_id = $product->category_id;
    }

    function clear()
    {
        $this->name = null;
        $this->price = null;
        $this->dis = null;
        $this->category_id = null;
        $this->brand_id = null;
        $this->supplier_id = null;
    }
}

