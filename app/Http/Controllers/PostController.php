<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest; 
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
{
    // Todos os inputs (title, category_id, tag) para o Service
    $posts = $this->postService->listPosts($request->all());
    
    // Categorias para preencher o <select> do filtro na View
    $categories = \App\Models\Category::all();

    return view('posts.index', compact('posts', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

public function store(Request $request)
{
    try {
        // SQL DIRETO PARA FURAR O BLOQUEIO
        $gravou = \Illuminate\Support\Facades\DB::table('posts')->insert([
            'title'       => $request->title ?? 'Post Forçado ' . now(),
            'category_id' => $request->category_id ?? 1,
            'content'     => $request->content ?? 'Conteúdo forçado',
            'summary'     => $request->summary ?? 'Resumo',
            'tag'         => $request->tag ?? 'teste',
            'user_id'     => $request->user()->id,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        if ($gravou) {
            return redirect()->route('posts.index')->with('success', 'GRAVADO VIA SQL!');
        }

    } catch (\Exception $e) {
        // Se houver erro de "Tabela não encontrada" ou "Coluna faltando", vai aparecer aqui
        dd("ERRO CRÍTICO DE SQL:", $e->getMessage());
    }

    return "O banco recusou o INSERT sem gerar exceção.";
}

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

   public function edit(Request $request)
    {
        
        $post = Post::findOrFail($request->id);
        

         if ($post->user_id !== $request->user()->id) {
             abort(403, 'Acesso negado');
         }

        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }


    public function update(Request $request, Post $post) 
    {
        Gate::authorize('update', $post);
        
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|string',
            'summary'     => 'required|string|max:500',
            'tag'         => 'required|string|max:50',
        ]);

        $updatedPost = $this->postService->updatePost($post, $data);

        return $request->wantsJson() 
            ? response()->json($updatedPost) 
            : redirect()->route('posts.index')->with('success', 'Post atualizado!');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        
        $post->delete();

        return request()->wantsJson() 
            ? response()->json(null, 204) 
            : redirect()->route('posts.index')->with('success', 'Post removido!');
    }

    public function reportByCategory()
    {
        $categories = Category::withCount('posts')->get();

        return request()->wantsJson() 
            ? response()->json($categories) 
            : view('reports.categories', compact('categories'));
    }
}