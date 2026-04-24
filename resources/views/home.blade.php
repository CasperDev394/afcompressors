@extends('layouts.app',
    [
        'title' => 'AF compressors',
        'description' => 'AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <home></home>
    @include('core.footer')

@endsection
