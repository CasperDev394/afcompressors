@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Компрессор'])

    @include('admin.core.sidebar')

    <admin-compressor></admin-compressor>
@endsection
