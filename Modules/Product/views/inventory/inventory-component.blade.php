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
    <div class="row mt-4 mb-2">
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Unit Price</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control rounded" wire:model='unit_price' />
                </div>
                @error('unit_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Qty</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control rounded" wire:model='qty' />
                </div>
                @error('qty')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
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
        </div>
        <div class="col-md-1">
            <a type="button" wire:click="save" class="btn bg-success btn-block rounded"> Save </a>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">unit price</th>
                            <th scope="col">qty</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\Modules\Product\app\Entities\Inventory::all() as $inventory)
                            <tr class="text-center text-capitalize">
                                <th scope="row">{{ $inventory->id }}</th>
                                {{-- <td>{{ $inventory->products ? $inventory->products->name : null }}</td> --}}
                                <td>{{ $inventory->qty }}</td>
                                <td>{{ $inventory->unit_price }}</td>
                                <td><a class='btn btn-success btn-sm text-light' title='edit  {{ $inventory->key }}'
                                        wire:click='edit({{ $inventory->id }})' role='button'>Edit</a>
                                    <a class='btn btn-danger btn-sm text-light' title='delete  {{ $inventory->key }}'
                                        wire:click='delete({{ $inventory->id }})' role='button'>X</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="9" class="text-success text-center"> There is no Product yet</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
