@extends('Product::layouts.index')
@section('header')
    Add Purchases
@endsection
@section('dashboard-layout')
    @livewire('add-purchases-component')
@endsection
@section('script')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        function disable(select_val, input_id) {
            var e = document.getElementById(select_val);
            var strUser = e.options[e.selectedIndex].value;
            if (strUser === "installment") {
                $("#display").css("visibility", "unset");
            } else {
                $("#display").css("visibility", "hidden");
            }
        }

        $("#roro").click(function() {
            console.log('roro');
        });
    </script> --}}
    <script>
        // add row
        $("#addRow").click(function() {
            var html = '';
            html = `
            <div class="row mt-5">
        <div class="col-lg-4">
            {{-- Product Name --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Product</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model="product_id">
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
            {{-- End Name Product --}}
        </div>
        <div class="col-lg-4">
            {{-- Quantity --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize">Quantity</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="Quantity" class="form-control" wire:model='qty' />
                    @error('qty')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Quantity --}}
        </div>
        <div class="col-lg-4">
            {{-- Price --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize">Price</label>
                <div class="col-sm-9" id="islam">
                    <input type="number" placeholder="Price" class="form-control" wire:model='price' />
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Price --}}
        </div>
        </div>`
            $('#newRow').append(html);
        });
    </script>
@endsection
