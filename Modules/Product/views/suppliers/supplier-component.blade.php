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
                <label class="col-sm-4 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model='name' />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Name --}}
            {{-- Phone --}}
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Phone</label>
                <div class="col-sm-8">
                    <input type="tel" class="form-control" wire:model='phone' />
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Phone --}}
        </div>
        <div class="col-lg-4">
            {{-- Email --}}
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" wire:model='email' />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Email --}}
            {{-- Company Name --}}
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Company Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model='company_name' />
                    @error('company_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- End Company Name --}}
        </div>
        <div class="col-lg-3">
            {{-- Adress --}}
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Address</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" wire:model='addres' />
                    @error('addres')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <a type="button" wire:click="save" class="btn btn-success btn-block mt-3">Save</a>
                </div>
            </div>
            {{-- End Adress --}}
        </div>
    </div>
    <div class="row page-title-header">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center text-capitalize">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">email</th>
                                <th scope="col">phone</th>
                                <th scope="col">addres</th>
                                <th scope="col">company_name</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\Modules\Product\app\Entities\Supplier::all() as $supplier)
                                <tr class="text-center text-capitalize">
                                    <th scope="row">{{ $supplier->id }}</th>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->addres}}</td>
                                    <td>{{ $supplier->company_name }}</td>
                                    <td><a class='btn btn-success btn-sm text-light'
                                            title='edit  {{ $supplier->name }}'
                                            wire:click='edit({{ $supplier->id }})' role='button'>Edit</a>
                                        <a class='btn btn-danger btn-sm text-light'
                                            title='delete  {{ $supplier->name }}'
                                            wire:click='delete({{ $supplier->id }})' role='button'>X</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6" class="text-success text-center"> There is no Supplier yet</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
