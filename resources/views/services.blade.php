@extends('layouts.app',
    [
        'title' => $title ?? 'Услуги | AF compressors',
        'description' => $description ?? 'Услуги AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <services-page></services-page>
    @include('core.footer')

@endsection
