@extends('layouts.app',
    [
        'title' => $title ?? 'Продажа запчастей | AF compressors',
        'description' => $description ?? 'Продажа запчастей AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <spare-parts-page></spare-parts-page>
    @include('core.footer')

@endsection
