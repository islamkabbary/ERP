<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\app\Entities\Customer;

class CustomerComponent extends Component
{
    use WithPagination;

    public $name , $company_name , $email , $adress , $phone ;
    public $customer_id;

    protected function rules()
    {
        return [
            'name'=> 'required|string',
            'company_name' => 'required',
            'email'=> 'required|unique:customers,email',
            'adress' => 'required',
            'phone' => 'required|unique:customers,phone|max:20',
        ];
    }

    public function render()
    {
        return view('Product::customers.customer-component');
    }
       
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email'=> 'nullable|unique:customers,email',
            'phone' => 'nullable|unique:customers,phone|max:20',
            'name'=> 'nullable|string',
            'company_name' => 'nullable',
            'adress' => 'nullable',
        ]);
    }

    public function save()
    {
        $this->validate();
        if ($this->customer_id)
            $customer = Customer::find($this->customer_id);
        else {
            $customer = new Customer();
            session()->flash('create', 'Custmor successfully create.');
        }
        $customer->name = $this->name;
        $customer->company_name = $this->company_name;
        $customer->email = $this->email;
        $customer->adress = $this->adress;
        $customer->phone = $this->phone;
        $customer->save();
        session()->flash('update', 'Custmor successfully update.');
        $this->clear();
    }

    function delete($customer)
    {
        Customer::destroy($customer);
        session()->flash('delete', 'Custmor successfully delete.');
    }

    function edit($customer_id)
    {
        $custmor = Customer::find($customer_id);
        $this->customer_id = $custmor->id;
        $this->name = $custmor->name;
        $this->company_name = $custmor->company_name;
        $this->email = $custmor->email;
        $this->adress = $custmor->adress;
        $this->phone = $custmor->phone;
    }

    function clear()
    {
        $this->name = null;
        $this->company_name = null;
        $this->email = null;
        $this->adress = null;
        $this->phone = null;
    }
}

