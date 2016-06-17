<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeDirectiveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('inSessionEcho', function ($args){
            $args = "array{$args}";
            $var = '$__BladeDirectiveServiceProvider__'.\App\utils::gerar_int_unique();
            $php = "\n<?php \n";
            $php .= "   $var = $args;\n";
//            $php .= "   var_dump(session({$var}[0]));\n";
            $php .= "   if(session({$var}[0])) {\n";
            $php .= "       if(in_array({$var}[1], session({$var}[0]))) {\n";
            $php .= "           echo {$var}[2];\n";
            $php .= "      }\n";
            $php .= "   }\n";
            $php .= "?>";
            return $php;
        });

        Blade::directive('ifOld', function ($input){
            $args = "array{$args}";
            $var = '$__BladeDirectiveServiceProvider__'.\App\utils::gerar_int_unique();
            $php = "\n<?php \n";
            $php .= "   $var = $args;\n";
//            $php .= "   var_dump(session({$var}[0]));\n";
            $php .= "   if(session({$var}[0])) {\n";
            $php .= "       if(in_array({$var}[1], session({$var}[0]))) {\n";
            $php .= "           echo {$var}[2];\n";
            $php .= "      }\n";
            $php .= "   }\n";
            $php .= "?>";
            return $php;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
