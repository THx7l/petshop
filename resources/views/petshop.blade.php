@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Meus Pets</h2>

    {{-- Formulário AJAX --}}
    <div class="card mb-4">
        <div class="card-body">
            <form id="formCreatePet">
                @csrf

                <div class="mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Espécie</label>
                    <input type="text" name="especie" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Raça</label>
                    <input type="text" name="raca" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Pet</button>
            </form>
        </div>
    </div>

    {{-- LISTAGEM --}}
    <h4>Lista de Pets</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Espécie</th>
                <th>Raça</th>
            </tr>
        </thead>
        <tbody id="petsTableBody">

            @foreach ($pets as $pet)
                <tr>
                    <td>{{ $pet->nome }}</td>
                    <td>{{ $pet->especie }}</td>
                    <td>{{ $pet->raca }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection


{{-- 
==================================================
🟦  SCRIPT AJAX PARA CADASTRAR PETS
==================================================
--}}
@section('scripts')
<script>
document.getElementById('formCreatePet').addEventListener('submit', function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('pets.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        if (data.status === "success") {

            // Adicionar nova linha na tabela
            document.getElementById('petsTableBody').innerHTML += `
                <tr>
                    <td>${data.pet.nome}</td>
                    <td>${data.pet.especie}</td>
                    <td>${data.pet.raca ?? ''}</td>
                </tr>
            `;

            // Limpar formulário
            document.getElementById('formCreatePet').reset();
        }
    })
    .catch(error => console.error("Erro:", error));
});
</script>
@endsection
