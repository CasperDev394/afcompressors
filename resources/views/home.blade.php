@extends('layouts.app',
    [
        'title' => $title,
        'description' => $description
    ]
)

@section('content')

    @include('core.header')
    <home home-h1="{{ $siteSettings->home_h1 }}"></home>
    @include('core.footer')

@endsection
