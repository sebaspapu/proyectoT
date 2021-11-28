<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionsController extends Controller
{
    public function create(){

        return view('auth.login');
    }
    
    public function store(){
        if(auth()->attempt(request(['email','password'])) == false){
            return back()->withErrors([
                'message' => 'El correo o la contraseña son incorrectos, por favor intente de nuevo',
            ]);
        }
        else {
            if (auth()->user()->role =='admin') {
                return redirect()->route('admin.index');
            }else{
                if (auth()->user()->role =='coordinator') {
                    return redirect()->route('coordinator.index');
                }else {
                        return redirect()->to('/');
                      }
                
                }
            }
         }

    public function destroy(){
        auth()->logout();
        return redirect()->to('/');
    }


}
