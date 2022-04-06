<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Modules\Product\app\Entities\Brand;

class BrandComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $logo, $brand_id;

    protected $rules = [
        'name' => 'required|max:25',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function render()
    {
        return view('Product::brands.brand-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->brand_id) {
            $brand = Brand::find($this->brand_id);
            $brand->name = $this->name;
            if ($this->logo) {
                unlink('storage/' . $brand->image->path);
                $brand->image()->delete();
                $brand_logo = $this->logo->store("Brands-logos", 'public');
                $brand->image()->create(['path' => $brand_logo, 'type' => 'image']);
            }
            $brand->save();
            session()->flash('update', 'Brand successfully create.');
        } else {
            $brand = new Brand();
            $brand->name = $this->name;
            $brand_logo = $this->logo->store("Brands-logos", 'public');
            $brand->save();
            $brand->image()->create(['path' => $brand_logo, 'type' => 'image']);
            session()->flash('create', 'Brand successfully update.');
        }
        $this->clear();
    }

    function delete($brand_id)
    {
        $brand = Brand::find($brand_id);
        unlink('storage/' . $brand->image->path);
        $brand->image()->delete();
        $brand->destroy($brand_id);
        session()->flash('delete', 'Category successfully delete.');
    }

    function edit($brand_id)
    {
        $brand = Brand::find($brand_id);
        $this->brand_id = $brand->id;
        $this->name = $brand->name;
    }

    function clear()
    {
        $this->name = null;
        $this->logo = null;
    }
}
