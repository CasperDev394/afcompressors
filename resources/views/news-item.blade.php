@extends('layouts.app',
    [
        'title' => $title ?? 'Новость | AF compressors',
        'description' => $description ?? 'Новость AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <news-item-page news-slug="{{ $news->name_slug }}"></news-item-page>
    @include('core.footer')

@endsection
