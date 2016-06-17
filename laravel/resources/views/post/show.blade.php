@extends('post/layout')

<?php

    $title = "Post";
    $title .= !empty($post) ? ' - ' . $post->titulo : '';
    
?>

@section('title', $title)

@push('breadcrumb')
    {!! utils::criar_breadcrumb_item('Post', route('post.create')) !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">@include('post/mensagens')</div>
    </div>
    @if (!empty($post))
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="pull-right">
                    <div id="editar_form_btn">
                        <button type="button" class="btn btn-default" id="editar_btn">
                            Editar
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </button>
                       <!--adicionar o input para a senha-->
                    </div>
                    
                </div>
                <h1>{{$post->titulo}}</h1>
                <hr>
                <p>{{$post->texto}}</p>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="alert alert-warning">
                    <strong>Oops!</strong> Esse post não existe
                </div>
            </div>
        </div>
    @endif
    
@endsection