<div>
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
                                <th scope="col">addres</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\Modules\Product\app\Entities\Purchas::all() as $purchas)
                                <tr class="text-center text-capitalize">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                        {{-- <td>{{ $purchas->purchasDetails }}</td> --}}
                                         {{-- <td>\Modules\Product\app\Entities\PurchasDetails::where('purchas_id',$purchas->id)->first() </td> --}}
                                            
                                        {{-- <td>{{ $pur->pluck }}</td> --}}
                                        {{-- {{ $pur->qty }}
                                         {{ $pur->total_product }}</td> --}}
                                       
                                        <td>{{\Modules\Product\app\Entities\PurchasDetails::get()}}</td>
                                    {{-- <td><a class='btn btn-success btn-sm text-light'
                                            title='edit  {{ $purchas->product_name }}'
                                            href="/dashboard/edit-purchases/{{ $purchas->purchas_id }}" role='button'>Edit</a>
                                        <a class='btn btn-danger btn-sm text-light'
                                            title='delete  {{ $purchas->product_name }}'
                                            wire:click='delete({{ $purchas->purchas_id }})' role='button'>X</a>
                                    </td> --}}
                                </tr>
                            @empty
                                <td colspan="9" class="text-success text-center"> There is no Purchas yet</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
