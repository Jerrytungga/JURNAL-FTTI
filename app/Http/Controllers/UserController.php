<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Mengambil semua data pengguna
        return view("users.index", compact("users")); // Mengembalikan view dengan data pengguna
    }
    public function store(Request $request)
    {
        $request->validate([
            "username" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8",
        ]);

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        // Mengarahkan kembali ke route 'users.index'
        return redirect()
            ->route("users.index")
            ->with("success", "Pengguna berhasil ditambahkan!");
    }
}
