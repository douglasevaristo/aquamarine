<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class PaginasCtrl extends Controller {

    /**
     * Mostra a view home
     *
     * @return \Illuminate\Http\Response
     */
    public function home() {
        return view('home');
    }

    /**
     * Mostra a view sobre
     *
     * @return \Illuminate\Http\Response
     */
    public function sobre() {
        return view('sobre');
    }

    /**
     * Mostra a view contato
     *
     * @return \Illuminate\Http\Response
     */
    public function contato() {
        return view('contato');
    }

}
