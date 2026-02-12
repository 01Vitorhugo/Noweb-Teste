<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Postagem - Noweb</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Criar Nova Notícia</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Título</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700">Categoria</label>
                    <select name="category_id" class="w-full border p-2 rounded">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700">Tag</label>
                    <input type="text" name="tag" class="w-full border p-2 rounded" placeholder="ex: laravel">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Resumo</label>
                <textarea name="summary" class="w-full border p-2 rounded" rows="2"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Conteúdo Completo</label>
                <textarea name="content" class="w-full border p-2 rounded" rows="5"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('posts.index') }}" class="px-4 py-2 text-gray-500">Cancelar</a>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Salvar Postagem</button>
            </div>
        </form>
    </div>
</body>
</html>