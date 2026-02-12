<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

<div class="max-w-md mx-auto mt-10 bg-white p-8 border border-gray-300 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center">Criar Nova Conta</h2>

    <form action="{{ route('register.post') }}" method="POST">
        @error('password')
        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
        @enderror

        @error('email')
        <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
        @enderror

        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Nome</label>
            <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">E-mail</label>
            <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Senha</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700">Confirmar Senha</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Registrar</button>
    </form>
</div>
</body>
</html>



















