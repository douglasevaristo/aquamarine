<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class PostCtrl extends Controller
{
    private $msg_falha_request = null;
    private $msg_criado_sucesso = null;
    private $TEMPO_LOGIN = null;


    

    public function __construct()
    {
        $this->TEMPO_LOGIN = 5 * 60; /* em segundos */
        $this->msg_falha_request = [];
        $this->msg_falha_auth_edit = [];
        $this->msg_criado_sucesso = 'Novo post criado com sucesso!';
    }
    
    
    
    private function request_nao_valido(Request $request, $id = null)
    {
        $att = $request->all();
        
        $v = Post::validar_campos($att);
        if ($v->fails()) {
            $this->msg_falha_request = $v->getMessageBag()->all();
        }
        
        if ( ! Post::valida_senha($request->get('senha'))) {
            $this->msg_falha_request[] = "Senha muito vuneravel! Não utilize sequencias de letras(abc) ou de números(123). Utilize pelo menus 1 caracter especial(.!@-_;...)";
        }
        
        return count($this->msg_falha_request) != 0;
    }

    private function validar_auth_edit($id)
    {
        $editableSession = session('editable_valido');
        if ($editableSession) {
            if ($editableSession['id'] != $id) {
                $this->msg_falha_auth_edit[] = 'Senha incorreta. eu vi o que você fez, estou observando ( ͠° ͟ʖ ͡°)';
                return false;
            }

            if ($editableSession['quando'] > time() + $this->TEMPO_LOGIN) {
                $this->msg_falha_auth_edit[] = 'Tempo expirou! Entre com a senha novamente.';
                return false;
            }

            $post = Post::find($id);

            if (is_null($post)) {
                $this->msg_falha_auth_edit[] = 'Post invalido.';
                return false;
            }

            return $post;

        } else {
            $this->msg_falha_auth_edit[] = 'Senha incorreta.';
            return false;
        }
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPosts = Post::all();
        return view('post.index')->with('allPosts', $allPosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if ($this->request_nao_valido($request)) {
            return redirect(null, 400)
                    ->route('post.create')
                    ->with('problema', $this->msg_falha_request)
                    ->withInput();
        }
        
        $novoPost = Post::criar_de($request->all());
        $novoPost->save();
        
        return redirect(null, 201)
                ->route('post.show', $novoPost->slug)
                ->with('sucesso', [$this->msg_criado_sucesso]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('post/show')->with('post', $post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth_edit($id, Request $request)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return back()->with('problema', ['Post invalido!']);
        }

        if ( ! $post->verifica_senha($request->get('senha')) ) {
            return back()->with('problema', ['Senha esta incorreta.']);
        }

        session()->flash('editable_valido', [
            'id' => $id,
            'quando' => time()
        ]);

        return redirect(null, 200)
                ->route('post.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valido = $this->validar_auth_edit($id);

        //reafirmar o session()

        if ( $valido ) {
            dd(session());
            return view('post/update')->with('post', $valido);
        } else {
            return back()
                ->with('problema', $this->msg_falha_auth_edit);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
