<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function temaOscuro()
    {

            if (Auth::check()) {

                cookie()->queue('tema', 'dark');
     
    
                return redirect()->route('home');
            
            }
            return redirect()->route('welcome');
        
    }

    public function temaClaro()
    {

            if (Auth::check()) {

               
       
                cookie()->queue('tema', 'light');

                return redirect()->route('home');
            }
            return redirect()->route('welcome');
        
    }

}
