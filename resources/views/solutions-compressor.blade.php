@extends('layouts.app',
    [
        'title' => $title ?? 'Компрессор | AF compressors',
        'description' => $description ?? 'Компрессор AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <solutions-compressor-page
        category-slug="{{ $category }}"
        compressor-slug="{{ $compressor->name_slug }}"
    ></solutions-compressor-page>
    @include('core.footer')

@endsection
