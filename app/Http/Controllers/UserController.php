<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    
    public function login()
    {

        return view('users_login');

    }

    public function logout()
    {

        return view('login');

        // Remover o usuário da sessão
        // session()->forget('user');
        // Redirecionar para a tela de login
        // return redirect()->route('login');

    }

    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:12',
            ],
            [
                //Mensagem para text_username
                'text_username.required' => 'O campo de e-mail é obrigatório',
                'text_username.email' => 'O campo de e-mail deve conter um endereço válido',

                //Mensagem para text_password
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
                ->withInput() //dados inseridos permaneçam
                ->with('login_error', 'Username ou password incorretos.');
        }

        if (!password_verify($password, $user->password)) {
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

        return redirect()->route('petshop');

    }

    public function registerSubmit(Request $request)
    {
        // Ver a validação do username e email TALVEZ TROCAR
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

        try {
            // Criar novo usuário
            $user = new User();
            $user->username = $request->username;
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            $user->created_at = now();
            $user->updated_at = now();
            $user->save();

            // Redirecionar com mensagem de sucesso
            return redirect()->route('login')
                ->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar usuário. Tente novamente.');
        }
    }


    public function petshop()
    {
        $users = User::all();
        return view('petshop', ['users' => $users]);
    }

    public function register()
    {

        return view('users_register');

    }

    public function destroy()
{
    // Obter o usuário da sessão
    $userId = session('user.id');
    
    if (!$userId) {
        return redirect()->route('login')
            ->with('error', 'Sessão expirada. Faça login novamente.');
    }

    try {
        // Encontrar o usuário
        $user = User::find($userId);
        
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Usuário não encontrado.');
        }

        // Soft delete do usuário
        $user->deleted_at = now();
        $user->save();

        // Limpar a sessão
        session()->forget('user');

        // Redirecionar para a tela de login com mensagem de sucesso
        return redirect()->route('login')
            ->with('success', 'Sua conta foi excluída com sucesso.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erro ao excluir a conta. Tente novamente.');
    }
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

}