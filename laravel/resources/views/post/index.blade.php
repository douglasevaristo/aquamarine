@extends('layout/main')

@section('title', " - Posts")

@section('styles')

    <style type="text/css">
        .qypgj-btn-add {
            background-color: #AD9EBF;
            color: white;
            float: right;
        }
        h1 span {
            color: #AD9EBF;
            letter-spacing: .35em;
        }

        h1 {
            padding: 0 .35em;
        }

        blockquote {
            border-left-color: #AD9EBF;
        }

        .qypgj-btn-editar {
            background-color: #7EA6AA;
            color: white;
            float: right;
        }
    </style>

@endsection

@section('body')

    <div class="container-fluid">
        <h1><span>Posts</span>
        <a type="button" class="btn btn-default btn-lg qypgj-btn-add">Novo</a>
        </h1>

        <hr>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach($allPosts as $post)
                    <div class="row">
                        <div class="col-md-12">
                            <blockquote>
                                <p class="lead">
                                    {{ $post->titulo }}
                                    <a type="button" class="btn btn-default qypgj-btn-editar">Visualizar</a>
                                </p>
                                <p>{{ $post->texto}}</p>
                                <footer>criado em {{ $post->created_at }}</footer>
                            </blockquote>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        <blockquote>
                            <p class="lead">
                                TITLE
                                <a type="button" class="btn btn-default qypgj-btn-editar">Visualizar</a>
                            </p>
                            <p>A única área que eu acho, que vai exigir muita atenção nossa, e aí eu já aventei a hipótese de até criar um ministério. É na área de... Na área... Eu diria assim, como uma espécie de analogia com o que acontece na área agrícola. Primeiro eu queria cumprim...</p>
                            <footer>criado em 2016, 05 de Junho</footer>
                        </blockquote>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection