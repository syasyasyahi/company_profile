<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Console\View\Components\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Hapus cache terkait user (jika ada)
        Cache::forget('user_' . $user->id);

        // Log out user dari Laravel
        Auth::logout();

        // Hapus user dari database
        $user->delete();

        // Flush session biar semua data bersih
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Anda sudah logout dan data dihapus');
    }

}
