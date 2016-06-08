@extends('layout/main')

@section('body')

    <ol class="breadcrumb">
        <li>
            <a href="{{ route('home') }}">Home</a>
        </li>
        
        {!! utils::criar_breadcrumb_item('Posts', route('post.index')) !!}
        
        @stack('breadcrumb')
    </ol>

    <div class="container-fluid">
        @yield('content')
    </div>

@endsection