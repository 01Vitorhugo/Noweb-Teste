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
        @method('PUT') 

        <label class="block text-gray-700">Título</label>
        <input type="text" name="title" value="{{ $post->title }}" class="border p-2 w-full  ">

        <label class="block text-gray-700">Categoria</label>
                    <select name="category_id" class="w-full border p-2 rounded">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>

        <label class="block text-gray-700">Tag</label>
        <input type="text" name="tag" value="{{ $post->tag }}" class="border p-2 w-full">

        <label class="block text-gray-700">Resumo</label>
        <input type="text" name="summary" value="{{ $post->summary }}" class="border p-2 w-full">

        <label class="block text-gray-700">Conteúdo Completo</label>
        <textarea name="content" class="w-full border p-2 rounded" rows="5">{{ $post->content }}</textarea>
        
        
        <button type="submit" class="bg-blue-500 text-white p-2">Atualizar</button>
        <a href="{{ route('posts.index') }}" class="ml-4 text-gray-500">Cancelar</a>
    </form>

    </div>
</body>
</html>

