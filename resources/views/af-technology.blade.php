@extends('layouts.app',
    [
        'title' => 'Технология AF | AF compressors',
        'description' => 'Технология AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <a-f-technology-page></a-f-technology-page>
    @include('core.footer')

@endsection
