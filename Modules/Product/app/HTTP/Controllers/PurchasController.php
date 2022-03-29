<?php

namespace Modules\Product\app\HTTP\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Product\app\Entities\Purchas;

class PurchasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Product::Purchas.indexShow');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product::Purchas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchas  $purchas
     * @return \Illuminate\Http\Response
     */
    public function show(Purchas $purchas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchas  $purchas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchas = Purchas::findOrFail($id);
        return view("Product::Purchas.indexEdit",compact('purchas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchas  $purchas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchas $purchas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchas  $purchas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchas $purchas)
    {
        //
    }
}
