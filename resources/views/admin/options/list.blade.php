@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Опции'])

    @include('admin.core.sidebar')

    <admin-options></admin-options>
@endsection
