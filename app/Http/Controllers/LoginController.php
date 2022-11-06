<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function store(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = isset($request->remember) ? filter_var($request->remember, FILTER_VALIDATE_BOOLEAN) : false;

        $status = 401;
        $response = [
            'error' => 'Proses masuk gagal!. Silahkan coba kembali.',
        ];

        if (Auth::attempt($credentials, $remember)) {
            $status = 200;
            $token = $request->user()->createToken('access_token')->plainTextToken; 
            $response = [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'remember' => $remember,
            ];
        }

        return response()->json($response, $status);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function destroy(Request $request)
    {
    	$request->user()->tokens()->where('tokenable_id', Auth::user()->id)->delete();
        
        Auth::logout();  
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return back();
    }
}
