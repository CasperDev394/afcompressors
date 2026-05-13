@extends('layouts.admin-app')

@section('content')

    @include('admin.core.header', ['h1'=>'Новости'])

    @include('admin.core.sidebar')

    <admin-news-list></admin-news-list>
@endsection
