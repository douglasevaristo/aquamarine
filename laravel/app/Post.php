<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    static public function valida_senha($senha)
    {
        if ( strlen($senha) < 7 || 40 < strlen($senha) ) {
            return false;
        }

        if (count(preg_grep('/^(.*\D.*){3,}$/iU', [$senha])) == 0) {
            return false;
        }

        return count(preg_grep('/^(.*\d.*){3,}$/iU', [$senha])) > 0;
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
