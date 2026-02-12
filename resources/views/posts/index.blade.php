<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal de Notícias - Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Portal de Notícias</h1>
            @auth
                <a href="{{ route('posts.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Nova Postagem</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        Sair
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Fazer Login</a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Fazer Cadastro</a>
            @endauth
        </div>

        <form action="{{ route('posts.index') }}" method="GET" class="mb-8 bg-white p-4 rounded shadow flex gap-4">
            <div class="flex-1">
                <select name="category_id" class="w-full border p-2 rounded">
                    <option value="">Todas as Categorias</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                        {{ $category->name }}
                      </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded">Filtrar</button>
            <a href="{{ route('posts.index') }}" class="py-2 text-gray-500 text-sm flex items-center">Limpar</a>
        </form>
        
        <div class="grid gap-6">
            @foreach($posts as $post)
                <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
                    <h2 class="text-xl font-bold text-gray-800">{{ $post->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $post->summary }}</p>
                    
                    <div class="mt-4 flex justify-between items-center border-t pt-4">
                        <div class="text-sm text-gray-400">
                            Categoria: <span class="font-semibold">{{ $post->category->name }}</span> | 
                            Autor: <span class="font-semibold">{{ $post->user->name }}</span>
                        </div>

                        <div class="flex gap-3 text-sm">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:underline font-medium">Ler mais</a>
                            
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
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->appends(request()->input())->links() }} 
        </div>
    </div>
</body>
</html>