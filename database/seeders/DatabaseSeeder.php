<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Cria 5 categorias primeiro
    $categories = \App\Models\Category::factory(5)->create();

    // Cria o seu usuário de teste (para você logar no Postman)
    $user = \App\Models\User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@teste.com',
        'password' => bcrypt('password123'),
    ]);

    // Cria 10 posts para o seu usuário e 10 aleatórios
    \App\Models\Post::factory(10)->create(['user_id' => $user->id]);
    \App\Models\Post::factory(10)->create();
}
}
