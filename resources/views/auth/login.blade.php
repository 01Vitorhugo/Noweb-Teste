<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 mb-4 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">E-mail</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700">Senha</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Entrar</button>
        </form>
    </div>
</body>
</html>