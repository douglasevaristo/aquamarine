<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;

class PostCtrl extends Controller
{
    private $msg_falha_request = null;
    private $msg_criado_sucesso = null;


    

    public function __construct()
    {
        $this->msg_falha_request = [];
        $this->msg_criado_sucesso = 'Novo post criado com sucesso!';
    }
    
    
    
    public function request_nao_valido(Request $request, $id = null)
    {
        $att = $request->all();
        
        $v = Post::validar_campos($att);
        if ($v->fails()) {
            $this->msg_falha_request = $v->getMessageBag()->all();
        }
        
        if ( ! Post::valida_senha($request->get('senha'))) {
            $this->msg_falha_request[] = "Senha muito vuneravel! Não utilize sequencias de letras(abc) ou de números(123).";
        }
        
        return count($this->msg_falha_request) != 0;
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
                ->route('post.show', ['post' => $novoPost->slug])
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
