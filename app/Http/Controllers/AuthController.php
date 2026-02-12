<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{

    public function showLogin() 
    {
        return view('auth.login');
    }

    /* Cadastro de usuário */
    public function showRegister()
{
    return view('auth.register'); 
}

public function register(RegisterRequest $request)
{
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    auth()->login($user);

    // Gera o token Bearer  
    $token = $user->createToken('auth_token')->plainTextToken;

    // Se for uma requisição de API 
    if ($request->wantsJson()) {
        return response()->json([
            'message'      => 'Usuário criado com sucesso!',
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], 201);
    }

    // Se for pelo navegador, redireciona para os posts já logado
    return redirect()->route('posts.index')->with('success', 'Bem-vindo, ' . $user->name);
}

   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
        return $request->wantsJson() 
            ? response()->json(['message' => 'Credenciais inválidas'], 401) 
            : back()->withErrors(['email' => 'As credenciais informadas não coincidem com nossos registros.']);
    }

    $request->session()->regenerate();

    $user = Auth::user();
    $token = $user->createToken('auth_token')->plainTextToken;

    if (!$request->wantsJson()) {
        return redirect()->intended('posts'); 
    }

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
}

public function logout(Request $request)
{
    // 1. Logout para Web (Sessão)
    Auth::logout();

    // Invalida a sessão atual no servidor e gera um novo token CSRF
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 2. Logout para API (Sanctum) - Se houver um usuário autenticado via Token
    if ($request->user()) {
        $request->user()->currentAccessToken()->delete();
    }

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Logoff realizado com sucesso!']);
    }

    return redirect()->route('posts.index')->with('success', 'Você saiu do sistema.');
}

}   