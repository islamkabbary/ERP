@extends('Product::layouts.index')
@section('header')
    Show Purchases
@endsection
@section('dashboard-layout')
    @livewire('show-purchases-component')
@endsection
