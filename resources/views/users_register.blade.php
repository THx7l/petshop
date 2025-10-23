@extends('layouts.main_layout')

@section('title', 'Register - PetShop')

@section('body-class', 'bg-primary')

@section('styles')
<style>
    .bg-primary {
        background-color: #e6f2ff !important;
    }
    
    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .container-login {
        margin-top: 30px; /* ← ESPAÇAMENTO ADICIONADO AQUI */
    }
</style>
@endsection

@section('navbar')
    <nav class="navbar">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo PetShop" class="logo-small">
        <div class="user-actions">
            <!-- Vazio - sem botões -->
        </div>
    </nav>
@endsection

@section('main-class', '')

@section('content')
<div class="container-login">
    <div class="login-box row g-0">
        <div class="login-image col-md-6">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo PetShop" class="logo-large">
        </div>

        <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
            <h1>CADASTRO</h1>

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label">Usuário:</label>
                    <input type="email" class="form-control" id="username" name="username" placeholder="Digite seu usuário" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme sua senha" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Voltar para Login</a>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection