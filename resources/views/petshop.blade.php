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
            <button class="btn btn-action" onclick="abrirFormulario('cadastrarAnimalForm')">Acessar</button>
        </div>

        <div class="action-card">
            <h3>Ver Meus Animais</h3>
            <p>Visualize todos os seus animais cadastrados</p>
            <button class="btn btn-action" onclick="abrirFormulario('verAnimaisForm')">Acessar</button>
        </div>
    </section>
</div>

<!-- Popup para Cadastrar Animal -->
<div class="form-popup" id="cadastrarAnimalForm">
    <h3>Cadastrar Animal</h3>
    <form>
        <div class="form-group">
            <label for="nomeAnimal">Nome do Animal:</label>
            <input type="text" id="nomeAnimal" name="nomeAnimal" required>
        </div>
        <div class="form-group">
            <label for="tipoAnimal">Tipo:</label>
            <select id="tipoAnimal" name="tipoAnimal" required>
                <option value="">Selecione...</option>
                <option value="cachorro">Cachorro</option>
                <option value="gato">Gato</option>
                <option value="outro">Outro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="idadeAnimal">Idade:</label>
            <input type="number" id="idadeAnimal" name="idadeAnimal" min="0" required>
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-cancel" onclick="fecharFormulario('cadastrarAnimalForm')">Cancelar</button>
            <button type="submit" class="btn btn-submit">Cadastrar</button>
        </div>
    </form>
</div>

<!-- Popup para Ver Animais -->
<div class="form-popup" id="verAnimaisForm">
    <h3>Meus Animais</h3>
    <div style="text-align: center; padding: 20px;">
        <p style="font-size: 16px; color: #7f8c8d;">Não existem animais cadastrados</p>
        <div class="form-actions" style="margin-top: 20px;">
            <button type="button" class="btn btn-cancel" onclick="fecharFormulario('verAnimaisForm')">Fechar</button>
        </div>
    </div>
</div>

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
        
        btnListAccounts.addEventListener('click', function() {
            accountsModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
        
        closeModal.addEventListener('click', function() {
            accountsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
    });

    function abrirFormulario(formId) {
        document.getElementById(formId).style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function fecharFormulario(formId) {
        document.getElementById(formId).style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Fechar popup clicando fora dele
    document.addEventListener('click', function(event) {
        const forms = document.querySelectorAll('.form-popup');
        forms.forEach(form => {
            if (event.target === form) {
                fecharFormulario(form.id);
            }
        });
    });
</script>
@endsection