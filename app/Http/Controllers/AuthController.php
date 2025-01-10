<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        if(Auth::user()) {
            return redirect()->intended('dashboard');
        }
       return view('login');

    }

    public function proses(Request $req){
        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $kredensial = $req->only('username', 'password');
        try {
            if(Auth::attempt($kredensial)){
                $req->session()->regenerate();
                $user = Auth::user();

                if($user) {
                return redirect()->intended('dashboard');
        }
    }
            return redirect()->route('login')->with('message', 'Username atau password salah');
        } catch (\Throwable $th) {
            return redirect()->back()->with('message', 'Terjadi kesalahan: ' . $th->getMessage());
            // 6. Jika terjadi error pada sistem, kembalikan ke halaman login dengan pesan error
        }
    }


  function logout(Request $request){
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('login');
  }
}
