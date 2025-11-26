<?php

namespace App\Http\Controllers;

use App\Models\Pets;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $userId = session('user.id');
        $pets = Pets::where('user_id', $userId)->get();
        
        // Obter todos os usuários para o modal
        $users = \App\Models\User::all();

        return view('petshop', compact('pets', 'users'));
    }

    public function store(Request $request)
    {
        if (!session()->has('user')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = session('user.id');

        $pet = Pets::create([
            'pet_name' => $request->pet_name,
            'pet_type' => $request->pet_type,
            'pet_gender' => $request->pet_gender,
            'pet_age' => $request->pet_age,
            'user_id' => $userId
        ]);

        return response()->json([
            'success' => true, 
            'pet' => $pet
        ]);
    }

    public function destroy($id)
    {
        if (!session()->has('user')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $userId = session('user.id');
        $pet = Pets::where('user_id', $userId)->findOrFail($id);
        $pet->delete();

        return response()->json(['success' => true]);
    }
}