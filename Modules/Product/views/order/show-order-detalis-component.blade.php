<div>
    {{-- {{$order->orderDetalis}} --}}
    <div class="card mt-50 mb-50">
        {{-- <div class="col d-flex"><span class="text-muted justify-center" id="orderno">order #546924</span></div> --}}
        <div class="title mx-auto"> Thank you for your order! </div>
        <div class="main">
            @foreach ($order->orderDetalis as $o)
            {{-- {{$o}} --}}
            <div class="row row-main">
                <div class="col-6">
                    <div class="row d-flex">
                        <p><b>{{$o->product_name}}</b></p>
                    </div>
                    <div class="row d-flex">
                        <p class="text-muted">Qty : {{$o->qty}}</p>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end">
                    <p><b>{{$o->total_product}}</b></p>
                </div>
            </div>
            @endforeach
            <hr>
            <div class="total">
                <div class="row">
                    <div class="col"> <b> Total:</b> </div>
                    <div class="col d-flex justify-content-end"> <b>{{$order->total}}</b> </div>
                </div> 
            </div>
        </div>
    </div>
</div>
