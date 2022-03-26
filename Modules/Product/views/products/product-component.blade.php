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
    <div class="row mt-4">
        <div class="col-lg-3">
            {{-- Name --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize">Name</label>
                <div class="col-sm-9">
                    <input type="text" placeholder="Name" class="form-control" wire:model.lazy='name' />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Name --}}
            {{-- Price --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize mt-3">Price</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="Price" class="form-control mt-3" wire:model.lazy='price' />
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Price --}}
        </div>
        <div class="col-lg-4">
            {{-- Brand --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Brand</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="brand_id">
                        <option value="">Select Brand</option>
                        @forelse (\Modules\Product\app\Entities\Brand::all() as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @empty
                            <option value="">Empty</option>
                        @endforelse
                    </select>
                    @error('brand_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Brand --}}
            {{-- Category --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize mt-3">Category</label>
                <div class="col-sm-9">
                    <select class="form-control mt-3" wire:model.lazy="category_id">
                        <option value="">Select Category</option>
                        @forelse (\Modules\Product\app\Entities\Category::all() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @empty
                            <option value="">Empty</option>
                        @endforelse
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Category --}}
        </div>
        <div class="col-lg-4">
            {{-- Supplier --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Supplier</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model.lazy="supplier_id">
                        <option value="">Select Supplier</option>
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
            {{-- End Supplier --}}
            {{-- Description --}}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize mt-3">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control" wire:model.lazy='dis'></textarea>
                    @error('dis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Description --}}
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Images</label>
                <div class="button_outer_pro btn_upload bg-success cursor-pointer">
                    <input type="file" wire:model.lazy='image' multiple>Upload Image
                </div>
                <div class="col-form-label ml-5">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-3 form-group">
            <a type="button" wire:click="save" class="btn btn-success btn-block">Save</a>
        </div>
    </div>
    <div class="row page-title-header">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-xl table-hover table-responsive-xl">
                        <thead>
                            <tr class="text-center text-capitalize">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">price</th>
                                <th scope="col">Description</th>
                                <th scope="col">category_id</th>
                                <th scope="col">brand_id</th>
                                <th scope="col">supplier_id</th>
                                <th colspan="1">images</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\Modules\Product\app\Entities\Product::all() as $product)
                                <tr class="text-center text-capitalize">
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->dis }}</td>
                                    <td>{{ $product->category ? $product->category->name : null }}</td>
                                    <td>{{ $product->brand ? $product->brand->name : null }}</td>
                                    <td>{{ $product->supplier ? $product->supplier->name : null }}</td>
                                    {{-- {{-- @foreach ($product->images as $image) --}}
                                    {{-- {{dd(count($product->images)!=0)}} --}}
                                    <td>
                                        <img width="50"
                                            src={{ count($product->images) != 0 ? url('storage/' . $product->images->pluck('path')) : '-' }}
                                            class="img-fluid" alt="Product Logo">
                                        {{-- <img width="50" src="{{ url('storage/' . $image->path) }}"
                                                class="img-fluid" alt="Product Logo"> --}}
                                    <td>
                                        {{-- @endforeach --}}
                                    <td><a class='btn btn-success btn-sm text-light'
                                            title='edit  {{ $product->name }}'
                                            wire:click='edit({{ $product->id }})' role='button'>Edit</a>
                                        <a class='btn btn-danger btn-sm text-light'
                                            title='delete  {{ $product->name }}'
                                            wire:click='delete({{ $product->id }})' role='button'>X</a>
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
</div>
