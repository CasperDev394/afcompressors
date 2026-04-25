@extends('layouts.app',
    [
        'title' => $title ?? 'Опции | AF compressors',
        'description' => $description ?? 'Опции AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <options-page></options-page>
    @include('core.footer')

@endsection
