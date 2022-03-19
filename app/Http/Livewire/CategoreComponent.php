<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Category;

class CategoreComponent extends Component
{
    use WithPagination;

    public $name, $category_id, $main_id;

    protected $rules = [
        'name' => 'string',
        'category_id' => 'nullable',
    ];

    public function render()
    {
        return view('Product::categories.categore-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        if ($this->main_id)
            $cat = Category::find($this->main_id);
        else {
            $cat = new Category();
            session()->flash('create', 'Category successfully create.');
        }
        $cat->name = $this->name;
        $cat->category_id = $this->category_id;
        $cat->save();
        session()->flash('update', 'Category successfully update.');
        $this->clear();
    }

    function delete($main_id)
    {
        Category::destroy($main_id);
        session()->flash('delete', 'Category successfully delete.');
    }

    function edit($main_id)
    {
        $cat = Category::find($main_id);
        $this->main_id = $cat->id;
        $this->name = $cat->name;
        $this->category_id = $cat->category_id;
    }

    function clear()
    {
        $this->name = null;
        $this->logo = null;
    }
}
