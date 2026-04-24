@extends('layouts.app')

@section('head_scripts')
    <meta name="robots" content="noindex, nofollow"/>
@endsection

@section('content')

    @include('core.header')

    <div class="pt-0">
        <div class="min-h-[80vh] bg-zinc-900 text-white">
            <form method="POST" action="{{Config::get('app.url')}}/login">
                @csrf
                <Login></Login>
            </form>
        </div>
    </div>

    @include('core.footer')

@endsection
