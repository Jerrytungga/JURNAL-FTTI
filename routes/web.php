<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});

Route::get("/users/create", function () {
    return view("users.create");
})->name("users.create");

Route::post("/users", [UserController::class, "store"])->name("users.store");
Route::get("/users", [UserController::class, "index"])->name("users.index");

Route::get("/users/{id}/edit", [UserController::class, "edit"])->name(
    "users.edit"
);

// Rute untuk memperbarui pengguna
Route::put("/users/{id}", [UserController::class, "update"])->name(
    "users.update"
);

// Rute untuk menyimpan pengguna baru
Route::post("/users", [UserController::class, "store"])->name("users.store");

// Rute untuk menghapus pengguna
Route::delete("/users/{id}", [UserController::class, "destroy"])->name(
    "users.destroy"
);
