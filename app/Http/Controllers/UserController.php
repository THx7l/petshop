<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('users_login'); // MUDEI: estava 'users_login'
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('users_login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:12',
            ],
            [
                'text_username.required' => 'O campo de e-mail é obrigatório',
                'text_username.email' => 'O campo de e-mail deve conter um endereço válido',
                'text_password.required' => 'A senha é obrigatória',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)
            ->whereNull('deleted_at')
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'Username ou password incorretos.');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'Username ou password incorretos.');
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        // REDIRECIONA PARA PETSHOP
        return redirect()->route('petshop');
    }

    public function register()
    {
        return view('users_register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ], [
            'username.required' => 'O e-mail é obrigatório',
            'username.email' => 'Digite um e-mail válido',
            'username.unique' => 'Este e-mail já está cadastrado',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
            'password.confirmed' => 'A confirmação da senha não coincide',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');
    }

    public function destroy()
    {
        $userId = session('user.id');
        
        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'Sessão expirada. Faça login novamente.');
        }

        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Usuário não encontrado.');
        }

        $user->deleted_at = now();
        $user->save();
        
        session()->forget('user');

        return redirect()->route('login')
            ->with('success', 'Sua conta foi excluída com sucesso.');
    }

    public function petshop()
    {
        $users = User::all();
        return view('petshop', ['users' => $users]);
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users_edit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required|email',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user = User::findOrFail($id);
    $user->username = $request->username;

    // só atualiza a senha se o campo não estiver vazio
    if ($request->filled('password')) {
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
    }

    $user->save();

    return redirect()->route('petshop')->with('success', 'Usuário atualizado com sucesso!');
}
    // REMOVA ESTES MÉTODOS DUPLICADOS OU NÃO UTILIZADOS:
    // public function petshop() - REMOVER
    // public function edit() - REMOVER  
    // public function update() - REMOVER
}