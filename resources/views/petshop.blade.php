@extends('layouts.main_layout')

@section('title', 'Bem-vindo ao Petshop')

@section('body-class', 'bg-light')

@section('styles')
<style>
    .content-spacing {
        margin-top: 40px; /* ← ESPAÇAMENTO ADICIONADO AQUI */
    }
</style>
@endsection

@section('navbar-actions')
    <a href="{{ route('login') }}" class="btn btn-logout">Logout</a>
    <button class="btn btn-edit">Editar Minha Conta</button>
    <button class="btn btn-delete">Excluir Minha Conta</button>
@endsection

@section('content')
<div class="content-spacing"> <!-- ← DIV ADICIONADA AQUI -->
    <section class="welcome-section">
        <h1>Bem-vindo ao Petshop</h1>
        <p>Gerencie seus animais de estimação de forma fácil e rápida</p>
    </section>

    <section class="actions-section">
        <div class="action-card">
            <h3>Cadastrar Animal</h3>
            <p>Adicione um novo animal ao seu perfil</p>
            <button class="btn btn-action">Acessar</button>
        </div>

        <div class="action-card">
            <h3>Ver Meus Animais</h3>
            <p>Visualize todos os seus animais cadastrados</p>
            <button class="btn btn-action">Acessar</button>
        </div>
    </section>
</div>
@endsection