<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Postagem - Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
        
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT') {{-- OBRIGATÓRIO PARA UPDATE --}}
        
        <input type="text" name="title" value="{{ $post->title }}" class="border p-2 w-full">
        {{-- Repita os outros campos com value="{{ $post->campo }}" --}}
        
        <button type="submit" class="bg-blue-500 text-white p-2">Atualizar</button>
    </form>

    </div>
</body>
</html>

