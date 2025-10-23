@extends('layouts.main_layout')

@section('title', 'Bem-vindo ao Petshop')

@section('body-class', 'bg-light')

@section('styles')
<style>
    .content-spacing {
        margin-top: 40px;
    }
</style>
@endsection

@section('navbar-actions')
    <a href="{{ route('login') }}" class="btn btn-logout">Logout</a>
    <a href="{{ route('users.edit', session('user.id')) }}" class="btn btn-edit">Editar Minha Conta</a>
    <button class="btn btn-list" id="btnListAccounts">Listar as contas</button>
    <form action="{{ route('users.delete') }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')">Excluir Minha Conta</button>
    </form>
@endsection

@section('content')
<div class="content-spacing">
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

<!-- MODAL PARA LISTAR CONTAS -->
<div class="modal-overlay" id="accountsModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Lista de Contas</h2>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="table-container">
                <table class="accounts-table">
                    <thead>
                        <tr>
                            <th class="id-column">ID</th>
                            <th class="username-column">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="id-column">{{ $user->id }}</td>
                            <td class="username-column">{{ $user->username }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnListAccounts = document.getElementById('btnListAccounts');
        const accountsModal = document.getElementById('accountsModal');
        const closeModal = document.getElementById('closeModal');
        
        // Abrir modal
        btnListAccounts.addEventListener('click', function() {
            accountsModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
        
        // Fechar modal
        closeModal.addEventListener('click', function() {
            accountsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
    });
</script>
@endsection