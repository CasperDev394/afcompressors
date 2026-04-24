@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Компрессоры'])

    @include('admin.core.sidebar')

    <admin-compressors></admin-compressors>
@endsection
