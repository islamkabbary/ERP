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
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label text-success">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Brand Name" wire:model='name' />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group row">
                <label class="ml-3 col-form-label text-success">Logo</label>
                <div class="button_outer btn_upload bg-success cursor-pointer btn_upload">
                    <input type="file" wire:model='logo'>Upload Image
                </div>
                @error('logo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <a type="button" wire:click="save" class="btn btn-success col-sm-2"> Save </a>
        </div>
    </div>
    <div class="row page-title-header">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Logo</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\Modules\Product\app\Entities\Brand::all() as $brand)
                                <tr class="text-center">
                                    <th scope="row">{{ $brand->id }}</th>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        <img width="50" src="{{ url('storage/' . $brand->image->path) }}"
                                            class="img-fluid" alt="Brand Logo">
                                    <td><a class='btn btn-success btn-sm text-light' title='edit  {{ $brand->name }}'
                                            wire:click='edit({{ $brand->id }})' role='button'>Edit</a>
                                        <a class='btn btn-danger btn-sm text-light'
                                            title='delete  {{ $brand->name }}'
                                            wire:click='delete({{ $brand->id }})' role='button'>X</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="5" class="text-success text-center"> There is no Brand yet</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
