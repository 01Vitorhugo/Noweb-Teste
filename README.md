<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## 🚀 Tecnologias e Padrões
* **Framework:** Laravel 11
* **Linguagem:** PHP 8.2+
* **Frontend:** Tailwind CSS & Blade
* **Arquitetura:** * **Service Layer:** Lógica de negócio desacoplada dos Controllers.
* **Policies:** Controle de permissões (apenas o autor edita/deleta sua postagem).
* **Migrations & Seeders:** Banco de dados estruturado e pronto para teste.


## 🛠️ Como Executar o Projeto

1. **Clone o repositório:**
    Abra o terminal e execute:

   ```bash
   git clone [https://github.com/01Vitorhugo/Noweb-Teste.git](https://github.com/01Vitorhugo/Noweb-Teste.git)
   cd Noweb-Teste



2. **Instale as dependências:**
    Instale os pacotes do PHP e compile os assets do Frontend:

    # Dependências do Laravel
    composer install

    # Dependências de Estilização (Tailwind CSS)
    npm install && npm run build



3. **Configure o Ambiente:**
    Crie o arquivo de configuração e gere a chave de segurança:

    # Copia o arquivo de exemplo
    cp .env.example .env

    # Gere a chave da aplicação
    php artisan key:generate



4. **Prepare o Banco de Dados:**
    Crie as tabelas e popule-as com os dados de teste (usuários e categorias):

    php artisan migrate:fresh --seed



5. **Inicie o servidor:**
    Com tudo configurado, suba o servidor local:

    php artisan serve

    Acesse em seu navegador: http://localhost:8000



