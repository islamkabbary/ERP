@extends('Product::layouts.index')
@section('header')
    All products in stock
@endsection
@section('dashboard-layout')
    @livewire('inventory-component')
@endsection
