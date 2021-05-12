<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   

    use AuthenticatesUsers;

    
    protected $redirectTo = RouteServiceProvider::HOME;

   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request)
    {
        $user = auth()->user();
        // si el usuario es admin o cliente
        if ($user->is_admin || $user->is_client)
            return;
        
        // Si el usuario es Soporte
        if (! $user->selected_project_id){
           $user->selected_project_id = $user->projects->first()->id;
           $user->save();
        }
    }

}
