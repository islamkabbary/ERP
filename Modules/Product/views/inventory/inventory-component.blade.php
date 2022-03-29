<div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center text-capitalize">
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">qty</th>
                            <th scope="col">unit price</th>
                            {{-- <th scope="col">&nbsp;</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\Modules\Product\app\Entities\Inventory::all() as $inventory)
                            <tr class="text-center text-capitalize">
                                <th scope="row">{{ $inventory->id }}</th>
                                <td>{{ $inventory->products->pop()->name}}</td>
                                <td>{{ $inventory->qty }}</td>
                                <td>{{ $inventory->unit_price }}</td>
                                {{-- <td><a class='btn btn-success btn-sm text-light' title='edit  {{ $inventory->key }}'
                                        wire:click='edit({{ $inventory->id }})' role='button'>Edit</a>
                                    <a class='btn btn-danger btn-sm text-light' title='delete  {{ $inventory->key }}'
                                        wire:click='delete({{ $inventory->id }})' role='button'>X</a>
                                </td> --}}
                            </tr>
                        @empty
                            <td colspan="10" class="text-success text-center"> There is no Product yet</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
