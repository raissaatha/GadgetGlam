<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // register
    public function rindex(){
        $data ['title'] = 'Register';

        return view('auth.register', $data);
    }

    public function rstore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $validatedData['password'] = bcrypt( $validatedData['password']);
        $ValidatedData['level'] = 'user';
        $ValidatedData['verify'] = 0;

        User::create($validatedData);
                
        return redirect('/login')->with('success', 'Registration Successfull');
    }

    // login
    public function lindex(){
        $data ['title'] = 'Login';

        return view('auth.login', $data);
    }

    public function login(Request $request){
        $credentials = $request -> validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->verify === 0 ){
                Auth::logout();
                return redirect()->intended('/');
            }
            if(auth()->user()->level == 'admin')
            return redirect()->intended('/transaksi');
            else
            return redirect()->intended('/');
        }

        return back()->with('loginError','Login Gagal! Silahkan coba lagi');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
