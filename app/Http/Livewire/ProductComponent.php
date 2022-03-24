<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Product\app\Entities\Product;

class ProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $price, $dis, $product_id, $brand_id, $supplier_id, $category_id, $image, $inventory_id;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'price' => 'required',
            'dis' => 'nullable',
            'brand_id' => 'required|exists:brands,id|max:20',
            'supplier_id' => 'required|exists:suppliers,id|max:20',
            'category_id' => 'required|exists:categories,id|max:20',
            'image' => 'nullable',
        ];
    }

    public function render()
    {
        return view('Product::products.product-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'nullable|string',
            'price' => 'nullable',
            'dis' => 'nullable',
            'brand_id' => 'nullable|exists:brands,id|max:20',
            'supplier_id' => 'nullable|exists:suppliers,id|max:20',
            'category_id' => 'nullable|exists:categories,id|max:20',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->product_id) {
            DB::beginTransaction();
            $product = Product::find($this->product_id);
            $product->name = $this->name;
            if ($this->image) {
                foreach ($product->images as $image) {
                    if (file_exists('storage/' . $image->path)) {
                        unlink('storage/' . $image->path);
                    }
                }
                $product->images()->delete();
                foreach ($this->image as $image) {
                    $product_images = $image->store("Product-images", 'public');
                    $product->images()->create(['path' => $product_images, 'type' => 'image']);
                    DB::commit();
                }
            }
            $product->inventory_id = $this->inventory_id;
            $product->save();
            session()->flash('update', 'Product successfully update.');
            DB::rollback();
        } else {
            DB::beginTransaction();
            $product = new Product();
            $product->name = $this->name;
            $product->price = $this->price;
            $product->dis = $this->dis;
            $product->supplier_id = $this->supplier_id;
            $product->brand_id = $this->brand_id;
            $product->category_id = $this->category_id;
            $product->inventory_id = $this->inventory_id;
            $product->save();
            foreach ($this->image as $image) {
                $product_images = $image->store("Product-images", 'public');
                $product->images()->create(['path' => $product_images, 'type' => 'image']);
            }
            DB::commit();
            session()->flash('create', 'Product successfully create.');
            DB::rollback();
        }
        $this->clear();
    }

    function delete($product_id)
    {
        $product = Product::find($product_id);
        if (count($product->images)) {
            foreach ($product->images as $image) {
                if(file_exists('storage/' . $image->path)){
                    unlink('storage/' . $image->path);
                }
                $image->delete();
            }
        } elseif (count($product->images->pluck('path')) !== 0 && file_exists('storage/' . $product->images->pluck('path'))) {
            unlink('storage/' . $product->images->pluck('path')[0]);
        }
        $product->images()->delete();
        $product->destroy($product_id);
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
        $this->inventory_id = $product->inventory_id;
        // dd($product->images);
        $this->image = $product->images;
    }

    function clear()
    {
        $this->name = null;
        $this->price = null;
        $this->dis = null;
        $this->category_id = null;
        $this->brand_id = null;
        $this->supplier_id = null;
        $this->image = null;
        $this->inventory_id = null;
    }
}
