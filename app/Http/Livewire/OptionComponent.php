<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Option;

class OptionComponent extends Component
{
    use WithPagination;

    public $key , $value , $option_id , $product_id;

    protected $rules = [
        'key' => 'required|string',
        'value' => 'required|string',
        'product_id' => 'required|exists:products,id',
    ];

    public function render()
    {
        return view('Product::option.option-component');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        if ($this->option_id)
            $option = Option::find($this->option_id);
        else {
            $option = new Option();
            session()->flash('create', 'Option successfully create.');
        }
        $option->key = $this->key;
        $option->value = $this->value;
        $option->product_id = $this->product_id;
        $option->save();
        session()->flash('update', 'Option successfully update.');
        $this->clear();
    }

    function delete($option_id)
    {
        Option::destroy($option_id);
        session()->flash('delete', 'Option successfully delete.');
    }

    function edit($option_id)
    {
        $option = Option::find($option_id);
        $this->option_id = $option->id;
        $this->key = $option->key;
        $this->value = $option->value;
        $this->product_id = $option->product_id;
    }

    function clear()
    {
        $this->key = null;
        $this->value = null;
        $this->product_id = null;
    }
}
