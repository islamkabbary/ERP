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
                            @forelse (\Modules\Product\app\Entities\Customer::all() as $custmor)
                                <tr class="text-center">
                                    <th scope="row">{{ $custmor->id }}</th>
                                    <td>{{ $custmor->name }}</td>
                                    <td>{{ $custmor->email }}</td>
                                    <td>{{ $custmor->phone }}</td>
                                    <td>{{ $custmor->addres }}</td>
                                    <td>{{ $custmor->company_name }}</td>
                                    <td><a class='btn btn-success btn-sm text-light'
                                            title='edit  {{ $custmor->name }}'
                                            wire:click='edit({{ $custmor->id }})' role='button'>Edit</a>
                                        <a class='btn btn-danger btn-sm text-light'
                                            title='delete  {{ $custmor->name }}'
                                            wire:click='delete({{ $custmor->id }})' role='button'>X</a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6" class="text-success text-center"> There is no Customer yet</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
