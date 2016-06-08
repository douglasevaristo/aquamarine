@extends('post/layout')

@section('title', "Novo")

@push('breadcrumb')
    {!! utils::criar_breadcrumb_item('Novo', route('post.create')) !!}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form action="{{ route('post.store') }}" method="POST" role="form" novalidate="">
                {!! csrf_field() !!}
                <legend>Novo Post</legend>
            
                <div class="form-group">
                    <label for="input_titulo" class="required">Título</label>
                    <input type="text" name="titulo" class="form-control" id="input_titulo" required="" />
                </div>
            
                <div class="form-group">
                    <label for="textarea_texto" class="required">Texto</label>
                    <textarea name="texto" id="textarea_texto" class="form-control" rows="4" required=""></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_senha" class="required">Senha</label>
                            <input type="text" name="senha" class="form-control" id="input_senha" required="" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="input_conf_senha" class="required">Confirme a senha</label>
                            <input type="text" name="conf_senha" class="form-control" id="input_conf_senha" required="" />
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>  
        </div>
    </div>
@endsection