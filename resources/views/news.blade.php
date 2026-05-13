@extends('layouts.app',
    [
        'title' => $title ?? 'Новости | AF compressors',
        'description' => $description ?? 'Новости AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <news-page></news-page>
    @include('core.footer')

@endsection
