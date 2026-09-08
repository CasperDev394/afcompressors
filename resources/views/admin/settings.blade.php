@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1' => 'Настройки'])

    @include('admin.core.sidebar')

    <admin-site-settings></admin-site-settings>
@endsection
