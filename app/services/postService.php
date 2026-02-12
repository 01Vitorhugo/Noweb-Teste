<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{

public function createPost(array $data)
{
    // Respeita o user_id que veio do Controller se o Auth::id() falhar
    $data['user_id'] = Auth::id() ?? $data['user_id'];

    return Post::create($data);
}
    /**
     * Lógica para atualizar uma postagem.
     */
    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }
}

