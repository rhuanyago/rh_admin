<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::check() === true) {
            return redirect()->route('home');
        }

        return view('auth.index');
    }

    public function login(Request $request)
    {
        if(in_array('', $request->only('email', 'password'))){
            return back()->with('message', 'Preencha os Campos corretamente!');
        }
        
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return back()->with('message', 'E-mail inválido!');
        }

        $credentials = $request->only('email', 'password');

        // $user = new User();
        // $user->insert([
        //     'name' => 'Rhuan',
        //     'email' => 'rhuan@admin.com.br',
        //     'password' => bcrypt('123456')
        // ]);

        if (!Auth::attempt($credentials)) {
            return back()->with('message', 'Usuário ou senha inválidos');
        }

        $ip = $request->getClientIp();

        $user = $this->authenticated($ip);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    private function authenticated(string $ip)
    {
        $user = User::find(Auth::user()->id);   

        $user->update([
            'last_sign_in_at' => date('Y-m-d H:i:s'),
            'last_sign_in_ip' => $ip
        ]);
    }
}
