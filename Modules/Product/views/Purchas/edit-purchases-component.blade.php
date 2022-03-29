<div>
    @if (session()->has('create'))
        <div class="alert alert-success text-center">
            {{ session('create') }}
        </div>
    @elseif (session()->has('delete'))
        <div class="alert alert-danger text-center">
            {{ session('delete') }}
        </div>
    @elseif (session()->has('update'))
        <div class="alert alert-warning text-center">
            {{ session('update') }}
        </div>
    @endif
    @foreach ($purchas->purchasDetails as $key => $value)
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success">Product</label>
                    <div class="col-sm-9">
                        <select class="form-control" wire:model.lazy="product_id.{{ $key }}">
                            <option value="">{{ $value->product_name }}</option>
                            @forelse (\Modules\Product\app\Entities\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @empty
                                <option value="">Empty</option>
                            @endforelse
                        </select>
                        @error('product_id.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Quantity" class="form-control" wire:model.lazy='qty.{{ $key }}' value="{{ $value->qty }}" />
                        @error('qty.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Price</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Price" class="form-control" wire:model.lazy='Price.{{ $key }}'
                            value="{{ $value->price }}" />
                        @error('price.'.$key)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">Remove</button>
            </div>
        </div>
    @endforeach
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
            <div class="col-lg-3">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Price</label>
                    <div class="col-sm-9">
                        <input type="number" placeholder="Price" class="form-control"
                            wire:model.lazy='price.{{ $value }}' />
                        @error('price.' . $value)
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{ $key }})">Remove</button>
            </div>
        </div>
    @endforeach
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Type</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="type">
                        <option value="">{{ $purchas->type }}</option>
                        <option value="{{ 'cash' }}">{{ 'Cash' }}</option>
                        <option value="{{ 'installment' }}">{{ 'Installment' }}</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        @if ($purchas->type == 'installment')
            <div class="col-lg-4">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-success text-capitalize">Cash</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" value="{{ $purchas->cash }}">
                        @error('cash')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Supplier</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="supplier_id">
                        <option value="">{{ $purchas->supplier->name }}</option>
                        @forelse (\Modules\Product\app\Entities\Supplier::all() as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @empty
                            <option value="">Empty</option>
                        @endforelse
                    </select>
                    @error('supplier_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-2">
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-success"></div>
                <div class="col-lg-9 form-group">
                    <a type="button" class="btn btn-success btn-block add_button"
                        wire:click.prevent="add({{ $i }})">Add product</a>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-2">
            <div class="form-group row">
                <div class="col-sm-3 col-form-label text-success"></div>
                <div class="col-lg-9 form-group">
                    <a type="button" wire:click.prevent="save()" class="btn btn-success btn-block">Save</a>
                </div>
            </div>
        </div>
    </div>
</div>
