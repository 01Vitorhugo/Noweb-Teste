<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
   
    public function listPosts(array $filters)
    {
        return Post::query()
            // Filtro por Título 
            ->when(isset($filters['title']), function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['title'] . '%');
            })
            // Filtro por Categoria
            ->when(isset($filters['category_id']), function ($query) use ($filters) {
                $query->where('category_id', $filters['category_id']);
            })
            // Filtro por Tag
            ->when(isset($filters['tag']), function ($query) use ($filters) {
                $query->where('tag', 'like', '%' . $filters['tag'] . '%');
            })
            ->latest() // Ordena pelos mais recentes
            ->paginate(10); // Paginação de 10 em 10
    }

    public function createPost(array $data)
    {
        $data['user_id'] = Auth::id() ?? $data['user_id'];
        return Post::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }
}