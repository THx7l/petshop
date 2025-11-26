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
            <button class="btn btn-action" onclick="abrirFormulario('cadastrarAnimalForm')">Acessar</button>
        </div>

        <div class="action-card">
            <h3>Ver Meus Animais</h3>
            <p>Visualize todos os seus animais cadastrados</p>
            <button class="btn btn-action">Acessar</button>
            <button class="btn btn-action" onclick="abrirFormulario('verAnimaisForm')">Acessar</button>
        </div>
    </section>
</div>

<!-- Popup para Cadastrar Animal -->
<div class="form-popup" id="cadastrarAnimalForm">
    <h3>Cadastrar Animal</h3>
    <form id="formCadastrarAnimal" method="POST" action="{{ route('pets.store') }}">
        @csrf
        <div class="form-group">
            <label for="pet_name">Nome do Animal:</label>
            <input type="text" id="pet_name" name="pet_name" required>
        </div>
        <div class="form-group">
            <label for="pet_type">Tipo:</label>
            <select id="pet_type" name="pet_type" required>
                <option value="">Selecione...</option>
                <option value="cachorro">Cachorro</option>
                <option value="gato">Gato</option>
                <option value="pássaro">Pássaro</option>
                <option value="peixe">Peixe</option>
                <option value="outro">Outro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pet_gender">Sexo:</label>
            <select id="pet_gender" name="pet_gender" required>
                <option value="">Selecione...</option>
                <option value="macho">Macho</option>
                <option value="fêmea">Fêmea</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pet_age">Idade (anos):</label>
            <input type="number" id="pet_age" name="pet_age" min="0" max="50" required>
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
    <div id="listaAnimais">
        @if(isset($pets) && $pets->count() > 0)
            @foreach($pets as $pet)
                <div class="account-item">
                    <div class="account-info">
                        <h3>{{ $pet->pet_name }}</h3>
                        <p>Tipo: {{ ucfirst($pet->pet_type) }} | Sexo: {{ ucfirst($pet->pet_gender) }} | Idade: {{ $pet->pet_age }} anos</p>
                    </div>
                    <div class="account-actions">
                        <button class="btn btn-delete btn-small" onclick="excluirAnimal({{ $pet->id }})">Excluir</button>
                    </div>
                </div>
            @endforeach
        @else
            <div style="text-align: center; padding: 20px;">
                <p style="font-size: 16px; color: #7f8c8d;">Não existem animais cadastrados</p>
            </div>
        @endif
    </div>
    <div class="form-actions" style="margin-top: 20px;">
        <button type="button" class="btn btn-cancel" onclick="fecharFormulario('verAnimaisForm')">Fechar</button>
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
        const formCadastrarAnimal = document.getElementById('formCadastrarAnimal');
        
        btnListAccounts.addEventListener('click', function() {
            accountsModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
        
        closeModal.addEventListener('click', function() {
            accountsModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
        
        // Submissão do formulário de cadastro de animal
        if (formCadastrarAnimal) {
            formCadastrarAnimal.addEventListener('submit', function(e) {
                e.preventDefault();
                cadastrarAnimal(this);
            });
        }
    });

    function abrirFormulario(formId) {
        document.getElementById(formId).style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function fecharFormulario(formId) {
        document.getElementById(formId).style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function cadastrarAnimal(form) {
        const formData = new FormData(form);
        
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Animal cadastrado com sucesso!');
                fecharFormulario('cadastrarAnimalForm');
                form.reset();
                // Recarregar a página para atualizar a lista
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao cadastrar animal.');
        });
    }

    function excluirAnimal(petId) {
        if (!confirm('Tem certeza que deseja excluir este animal?')) {
            return;
        }
        
        fetch(`/pets/${petId}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Animal excluído com sucesso!');
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao excluir animal.');
        });
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