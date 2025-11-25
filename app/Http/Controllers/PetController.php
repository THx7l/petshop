<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    // Exibe a view com os pets do usuário logado
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $userId = session('user.id');

        $pets = Pet::where('user_id', $userId)->get();

        return view('petshop', compact('pets'));
    }

    // Cadastrar pet
    public function store(Request $request)
    {
        $userId = session('user.id');

        Pet::create([
            'nome' => $request->nome,
            'especie' => $request->especie,
            'raca' => $request->raca,
            'user_id' => $userId
        ]);

        return response()->json(['success' => true]);
    }

    // Deletar pet
    public function destroy($id)
    {
        $userId = session('user.id');

        $pet = Pet::where('user_id', $userId)->findOrFail($id);
        $pet->delete();

        return response()->json(['success' => true]);
    }
}
