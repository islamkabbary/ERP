@extends('Product::layouts.index')
@section('header')
    Edit Purchases
@endsection
@section('dashboard-layout')
    @livewire('edit-purchases-component',['edit_purchas'=>$purchas])
@endsection
