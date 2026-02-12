<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class UpdatePostsTitle extends Command
{
    // O nome do comando que você vai digitar no terminal
    protected $signature = 'posts:update-title {newTitle}';

    // A descrição que aparece no php artisan list
    protected $description = 'Altera o título de todas as postagens';

    public function handle()
    {
        // Pega o parâmetro que o usuário digitou
        $newTitle = $this->argument('newTitle');

        // Atualiza todos os registros no banco
        $count = Post::count();
        Post::query()->update(['title' => $newTitle]);

        $this->info("Sucesso! O título de {$count} postagens foi alterado para: {$newTitle}");
    }
}
