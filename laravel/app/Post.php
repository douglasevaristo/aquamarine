<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    static public function criar_de($campos)
    {
        $novo = new self;
        if(! $novo->set_senha($campos['senha'])) {
            return null;
        }
        $novo->titulo = $campos['titulo'];
        $novo->slug = $campos['slug'];
        $novo->texto = $campos['texto'];
        
        return $novo;
    }

    static public function valida_senha($senha)
    {
        if ( strlen($senha) < 7 || 40 < strlen($senha) ) {
            return false;
        }

        if (count(preg_grep('/^(.*\D.*){3,}$/iU', [$senha])) == 0) {
            return false;
        }
        
        for ($i = 2; $i < strlen($senha); $i += 2) {
            $anterior = $senha[$i-2];
            if  (
                    ($anterior == $senha[$i-1] && $anterior == $senha[$i])
                 ||
                    (++$anterior == $senha[$i-1] && ++$anterior == $senha[$i])
                ) {
                return false;
            }
        }

        return count(preg_grep('/^(.*\d.*){3,}$/iU', [$senha])) > 0;
    }
    
    static public function validar_campos($inputs, $edit_id = null) {
        $messages = [
            'alpha_dash' => 'O :attribute deve conter apenas letras(A-z), numeros(0-9), e os caracteres "_-"',
            'required' => 'O :attribute é obrigatorio.',
            'titulo.required' => 'O título é obrigatorio.',
            'conf_senha.required' => 'A confirmação da senha é obrigatorio.',
            'senha.required' => 'A senha é obrigatorio.',
            'same' => 'A confirmação da senha deve ser igual a senha.',
            'between' => 'A :attribute tem que ter entre :min e :max caracteres',
            'unique' => 'O :attribute já esta sendo usado.',
            'max' => 'O :attribute deve ter no maximo :max caracteres',
            'min' => 'O :attribute deve ter no minimo :min caracteres',
        ];
        
        $rule_slug = 'required|max:99|alpha_dash|unique:posts,slug';
        if (!is_null($edit_id)) {
            $rule_slug .= ",$edit_id";
        }

        $rules = [
            'titulo' => 'required|max:255',
            'texto' => 'required|min:10',
            'slug' => $rule_slug,
            'senha' => 'required|between:10,40',
            'conf_senha' => 'required|same:senha',
        ];

        return validator($inputs, $rules, $messages);
    }

    public function set_senha($senha)
    {
        if ($this->valida_senha($senha)) {
            $this->senha = bcrypt($senha);
            return true;
        } else {
            return false;
        }
    }

    public function get_texto($length = '', $sufixo = '')
    {
        $texto = $this->texto;
        if ($length != '' && strlen($texto) > $length) {
            $texto = substr($texto, 0, $length) . $sufixo;
        }

        return $texto;
    }

    public function get_data_criado($format = 'j \d\e m \d\e Y')
    {
        return utils::data_str($this->created_at, $format);
    }
}
