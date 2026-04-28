@extends('layouts.app',
    [
        'title' => $title ?? 'Наша компания | AF compressors',
        'description' => $description ?? 'Наша компания AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <our-company-page></our-company-page>
    @include('core.footer')

@endsection
