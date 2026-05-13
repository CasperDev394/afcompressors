@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Новость'])

    @include('admin.core.sidebar')

    <admin-news-item></admin-news-item>
@endsection
