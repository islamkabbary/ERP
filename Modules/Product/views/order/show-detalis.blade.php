@extends('Product::layouts.index')
@section('header')
    show Order Detalis
@endsection
@section('dashboard-layout')
    @livewire('show-order-detalis-component',['show_detalis'=>$order])
@endsection
