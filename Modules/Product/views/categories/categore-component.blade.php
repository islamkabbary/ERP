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
        <div class="col-sm-3">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success text-capitalize">Name</label>
                <div class="col-sm-9">
                    <input placeholder="Category Name" type="text" class="form-control rounded" wire:model='name' />
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label rounded text-success text-capitalize">Sub Category</label>
                <div class="col-sm-9">
                    <select class="form-control" wire:model="category_id">
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
        </div>
        <div class="col-sm-2">
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
                            <th scope="col">Name</th>
                            <th scope="col">Category_id</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\Modules\Product\app\Entities\Category::all() as $cat)
                            <tr class="text-center">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->parent ? $cat->parent->name : null}}</td>
                                <td><a class='btn btn-success btn-sm text-light' title='edit  {{ $cat->name }}'
                                        wire:click='edit({{ $cat->id }})' role='button'>Edit</a>
                                    <a class='btn btn-danger btn-sm text-light' title='delete  {{ $cat->name }}'
                                        wire:click='delete({{ $cat->id }})' role='button'>X</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="4" class="text-success text-center"> There is no Category yet</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
