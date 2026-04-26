@extends('layouts.app',
    [
        'title' => $title ?? 'Решения | AF compressors',
        'description' => $description ?? 'Решения AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <solutions-category-page category-slug="{{ $category }}"></solutions-category-page>
    @include('core.footer')

@endsection
