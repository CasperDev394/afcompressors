@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Инфо'])

    @include('admin.core.sidebar')

    <admin-info></admin-info>
@endsection
