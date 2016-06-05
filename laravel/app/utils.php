<?php

namespace App;

class utils
{
    static public function nome_mes($num_mes) {
        $num_mes = (int) $num_mes;
        switch ($num_mes) {
            case 1:
                $return = 'Janeiro';
                break;
            
            case 2:
                $return = 'Fevereiro';
                break;
            
            case 3:
                $return = 'Março';
                break;
            
            case 4:
                $return = 'Abril';
                break;
            
            case 5:
                $return = 'Maio';
                break;
            
            case 6:
                $return = 'Junho';
                break;
            
            case 7:
                $return = 'Julho';
                break;
            
            case 8:
                $return = 'Agosto';
                break;
            
            case 9:
                $return = 'Setembro';
                break;
            
            case 10:
                $return = 'Outubro';
                break;
            
            case 11:
                $return = 'Novembro';
                break;
            
            case 12:
                $return = 'Dezembro';
                break;
            
            default:
                $return = 'MES_INVALIDO';
                break;
        }

        return $return;
    }

    static public function criar_navbar_item($nome, $rota)
    {
        $url = route($rota);
        $estaActivo = url()->current() == $url ? "class=\"active\"" : "";
        return "<li $estaActivo><a href=\"$url\">$nome</a></li>";
    }

    static public function data_str($data = null, $formato = 'jmY')
    {
        if (is_null($data)) {
            $data = date('Y-m-d H:i:s');
        }

        $time = strtotime($data);
        if ($time === false) {
            return false;
        }

        $formato = explode('m', $formato);

        $strs = [];
        foreach ($formato as $f) {
            $strs[] = date($f, $time);
        }

        if (count($strs)) {
            $glue = self::nome_mes(date('m', $time));
        } else {
            $glue = '';
        }

        return implode($glue, $strs);
    }
}
