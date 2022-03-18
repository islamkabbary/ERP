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
    <div class="row page-title-header">
        <div class="col-lg-5">
            <form wire:submit.prevent="save">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wire:model='name' />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="col-sm-3 col-form-label mt-4">Logo</label>
                    <div class="button_outer bg-success cursor-pointer">
                        <div class="btn_upload col-sm-9">
                            <input type="file" wire:model='logo'>Upload Image
                        </div>
                    </div>
                    @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <a type="button" wire:click="save" class="btn btn-success col-sm-5 mt-3 ml-5"> Save </a>
            </form>
        </div>
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Logo</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\Modules\Product\app\Entities\Brand::all() as $brand)
                                <tr>
                                    <th scope="row">{{ $brand->id }}</th>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        <img width="50" src="{{ url('storage/' . $brand->image->path) }}" class="img-fluid"
                                            alt="">
                                            {{-- {{$brand->image}} --}}
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
