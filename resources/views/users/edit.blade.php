<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengguna</title>
</head>
<body>
    <h1>Edit Pengguna</h1>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="username">Username:</label>
        <input type="text" name="username" value="{{ $user->username }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label for="password">Password (kosongkan jika tidak ingin mengubah):</label>
        <input type="password" name="password">

        <button type="submit">Perbarui</button>
    </form>
    <a href="{{ route('users.index') }}">Kembali ke Daftar Pengguna</a>
</body>
</html>
