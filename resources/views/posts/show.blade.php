<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Posts - Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
        <p class="text-sm text-gray-500 mb-4">Postado por: {{ $post->user->name }} | Categoria: {{ $post->category->name }} | Tags: {{ $post->tag }}</p>
        <div class="mt-4 leading-relaxed">
            {{ $post->content }}
        </div>
        <a href="{{ route('posts.index') }}" class="mt-6 inline-block text-blue-600">← Voltar para a lista</a>

    @can('update', $post)
        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600 hover:underline font-medium ml-2">Editar</a>
    @endcan

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Excluir esta notícia?')">
    @csrf
        @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline font-medium ml-2">Deletar</button>
        </form>
    @endcan
    </div>
    
</body>
</html>