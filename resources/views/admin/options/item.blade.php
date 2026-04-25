@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Опция'])

    @include('admin.core.sidebar')

    <admin-option></admin-option>
@endsection
