@extends('Product::layouts.index')
@section('header')
    Add Purchases
@endsection
@section('dashboard-layout')
    @livewire('add-purchases-component')
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 100; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.newRow'); //Input field wrapper
            var fieldHTML = `
            <div class="row mt-5">
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success">Product</label>
                    <div class="col-sm-9">
                        <select class="form-control" wire:model="product_id[]">
                            <option value="">Select Product</option>
                            @forelse (\Modules\Product\app\Entities\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @empty
                                <option value="">Empty</option>
                            @endforelse
                        </select>
                        @error('product_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Quantity" class="form-control" wire:model='qty[]' />
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Price</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Price" class="form-control" wire:model='price[]' />
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
            `; //New input field html 
            var x = 1; //Initial field counter is 1
            
            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){ 
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
        </script>
@endsection
