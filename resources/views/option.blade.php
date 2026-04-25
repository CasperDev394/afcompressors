@extends('layouts.app',
    [
        'title' => $title ?? 'Опция | AF compressors',
        'description' => $description ?? 'Опция AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <option-page option-slug="{{ $option->name_slug }}"></option-page>
    @include('core.footer')

@endsection
