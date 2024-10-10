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

    public function edit($id)
    {
        $user = User::findOrFail($id); // Mengambil pengguna berdasarkan ID
        return view("users.edit", compact("user")); // Mengembalikan view edit dengan data pengguna
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "username" => "required|string|max:255",
            "email" =>
                "required|string|email|max:255|unique:users,email," . $id,
            "password" => "nullable|string|min:8",
        ]);

        $user = User::findOrFail($id); // Mengambil pengguna berdasarkan ID
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->filled("password")) {
            $user->password = bcrypt($request->password); // Hanya update password jika diisi
        }

        $user->save(); // Menyimpan perubahan

        return redirect()
            ->route("users.index")
            ->with("success", "Pengguna berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Mengambil pengguna berdasarkan ID
        $user->delete(); // Menghapus pengguna

        return redirect()
            ->route("users.index")
            ->with("success", "Pengguna berhasil dihapus!"); // Mengarahkan kembali dengan pesan sukses
    }
}
