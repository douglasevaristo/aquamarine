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
                                    <a href="{{ route('post.show', $post->id) }}" type="button" class="btn btn-default qypgj-btn-editar">Visualizar</a>
                                </p>
                                <p>{{ $post->get_texto('255', '....') }}</p>
                                <footer>criado em {{ $post->get_data_criado() }}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection