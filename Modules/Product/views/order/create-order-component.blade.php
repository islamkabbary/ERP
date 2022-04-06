<div>
    @if (session()->has('create'))
        <div class="alert alert-success text-center">
            {{ session('create') }}
        </div>
    @elseif (session()->has('delete'))
        <div class="alert alert-danger text-center">
            {{ session('delete') }}
        </div>
    @elseif (session()->has('Not Enough'))
        <div class="alert alert-danger text-center">
            {{ session('Not Enough') }}
        </div>
    @elseif (session()->has('No Product'))
        <div class="alert alert-danger text-center">
            {{ session('No Product') }}
        </div>
    @elseif (session()->has('update'))
        <div class="alert alert-warning text-center">
            {{ session('update') }}
        </div>
    @endif
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Product</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="product_id.0">
                        <option value="">Select Product</option>
                        @forelse (\Modules\Product\app\Entities\Product::all() as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @empty
                            <option value="">Empty</option>
                        @endforelse
                    </select>
                    @error('product_id.0')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize">Quantity</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="Quantity" class="form-control" wire:model.lazy="qty.0" />
                    @error('qty.0')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Type</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="type">
                        <option value="">Select Type</option>
                        <option value="{{ 'cash' }}">{{ 'Cash' }}</option>
                        <option value="{{ 'installment' }}">{{ 'Installment' }}</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @if ($type == 'installment')
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Cash</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" wire:model="cash">
                        @error('cash')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Custmor</label>
                    <div class="col-sm-9">
                        <select class="form-control" wire:model.lazy="customer_id">
                            <option value="">Select Custmor</option>
                            @forelse (\Modules\Product\app\Entities\Customer::all() as $custmor)
                                <option value="{{ $custmor->id }}">{{ $custmor->name }}</option>
                            @empty
                                <option value="">Empty</option>
                            @endforelse
                        </select>
                        @error('customer_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    @endif
    @foreach ($inputs as $key => $value)
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success">Product</label>
                    <div class="col-sm-9">
                        <select class="form-control" wire:model.lazy="product_id.{{ $value }}">
                            <option value="">Select Product</option>
                            @forelse (\Modules\Product\app\Entities\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @empty
                                <option value="">Empty</option>
                            @endforelse
                        </select>
                        @error('product_id.' . $value)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Quantity" class="form-control"
                            wire:model.lazy='qty.{{ $value }}' />
                        @error('qty.' . $value)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-danger ml-3 btn-sm"
                    wire:click.prevent="remove({{ $key }})">Remove</button>
            </div>
        </div>
    @endforeach
    <div class="row mt-5">
        <div class="col-lg-3"></div>
        <div class="col-lg-2 ml-4">
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-success"></div>
                <div class="col-lg-9 form-group">
                    <a type="button" class="btn btn-success btn-block add_button"
                        wire:click.prevent="add({{ $i }})">Add product</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2">
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-success"></div>
                <div class="col-lg-9 form-group">
                    <a type="button" wire:click.prevent="save()" class="btn btn-success btn-block">Save</a>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-2">
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-success"></div>
                <div class="col-lg-9 form-group">
                    <a type="button" wire:click.prevent="save()" class="btn btn-success btn-block">{{$total}} </a>
                </div>
            </div>
        </div> --}}
    </div>
    {{-- <div class="card mt-50 mb-50">
        <div class="col d-flex"><span class="text-muted justify-center" id="orderno">order #546924</span></div>
        <div class="title mx-auto"> Thank you for your order! </div>
        <div class="main">
            <div class="row row-main">
                <div class="col-6">
                    <div class="row d-flex">
                        <p><b>iPhone XR</b></p>
                    </div>
                    <div class="row d-flex">
                        <p class="text-muted">128GB White</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <p><b>$599</b></p>
                </div>
            </div>
            <hr>
            <div class="total">
                <div class="row">
                    <div class="col"> <b> Total:</b> </div>
                    <div class="col d-flex justify-content-end"> <b>$847.95</b> </div>
                </div> 
            </div>
        </div>
    </div> --}}
</div>
