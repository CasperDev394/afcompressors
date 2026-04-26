@extends('layouts.app',
    [
        'title' => 'Безмасляные поршневые компрессоры | AF compressors',
        'description' => 'Безмасляные поршневые компрессоры AF compressors'
    ]
)

@section('content')

    @include('core.header')
    <solutions-page></solutions-page>
    @include('core.footer')

@endsection
