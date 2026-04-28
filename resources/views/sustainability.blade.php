@extends('layouts.app',
    [
        'title' => $title ?? 'Устойчивое развитие | AF compressors',
        'description' => $description ?? 'Устойчивое развитие AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <sustainability-page></sustainability-page>
    @include('core.footer')

@endsection
