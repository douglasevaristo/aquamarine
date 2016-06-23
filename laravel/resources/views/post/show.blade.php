@extends('post/layout')

<?php

    $title = "Post";
    $title .= !empty($post) ? ' - ' . $post->titulo : '';
    
?>

@section('title', $title)

@section('styles')
    <style type="text/css">
        #input_senha {
            width: 180px;
            box-sizing: border-box;
            padding: 4px 40px 4px 15px;
            color: #555;
        }

        #input_submit {
            border: none;
            width: 40px;
            position: absolute;
            right: 0;
            top: 0;
        }

        #input_submit,
        #input_senha,
        #editar_btn {
            height: 34px;
            border: none;
            background-color: rgba(0,0,0,0);
        }

        #input_senha:focus {
            border-color: #3e3e82;
            box-shadow: inset 0 0 2px 0 rgba(62,62,130,.75), 0 0 12px 1px rgba(62,62,130,.75);
        }

        #input_submit:focus,
        #input_senha:focus {
            outline: 0;
        }

        #editar_form_btn {
            border: 1px solid #7b7bc5;
            border-radius: 4px;
            transition: all .3s linear;
        }

        #form {
            position: relative;
        }

        .spaceable {
            white-space: pre-wrap;
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript">
        (
            function ($) {
                $('#editar_btn').click(function(event) {
                    $('#editar').hide(250);
                    $('#form').show(250);
                    $('#input_senha').focus();
                });
            }
        )(jQuery);
    </script>
@endsection

@push('breadcrumb')
    {!! utils::criar_breadcrumb_item('Post', route('post.create')) !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-offset-5 col-md-14">@include('post/mensagens')</div>
    </div>
    @if (!empty($post))

        <div class="row">
            <div class="col-md-offset-3 col-md-18">
                <div class="pull-right">
                    <div id="editar_form_btn">
                        <div id="editar">
                            <button type="button" class="btn btn-default" id="editar_btn">
                                Editar
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div id="form" style="display: none">
                            <form action="{{ route('post.auth.edit', $post->id) }}" method="POST">
                                {!! csrf_field() !!}
                                <input type="password" name="senha" id="input_senha" required="required" title="Senha utilizada no cadastro.">
                                <button type="submit" id="input_submit"><i class="fa fa-key" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <h1>{{$post->titulo}}</h1>
                <hr>
                <p class="spaceable">{{$post->texto}}</p>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-offset-5 col-md-14">
                <div class="alert alert-warning">
                    <strong>Oops!</strong> Esse post não existe
                </div>
            </div>
        </div>
    @endif
    
@endsection