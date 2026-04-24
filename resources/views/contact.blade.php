@extends('layouts.app',
    [
        'title' => 'Контакты | AF compressors',
        'description' => 'Контакты AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <contact-page></contact-page>
    @include('core.footer')

@endsection
