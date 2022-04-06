<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Modules\Product\app\Entities\Purchas;

class ShowPurchasesComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public function render()
    {
        return view('Product::Purchas.show-purchases-component');
    }

    function delete($purchas_id)
    {
        Purchas::destroy($purchas_id);
        session()->flash('delete', 'Purchas successfully delete.');
    }


    // function edit($edit_purchas)
    // {
    //     $cat = Purchas::find($edit_purchas);
    //     $this->main_id = $cat->id;
    //     $this->name = $cat->name;
    //     $this->category_id = $cat->category_id;
    // }
}
