### Requisitos

- php 8.1 >=
- laravel 10.0>=
- composer >= 2.5
- mysql >= 8

## Design Patterns usados

- Repository
- Service
- MVC
- Front controller

###        * Preparando o ambiente *

#### Ambiente *SEM* docker

`git clone https://github.com/v3ronez/app_facilita_teste` → clonar o repositório do projeto

Fazer o setup das configurações de conexão com o banco no arquivo .env (seguir o exemplo)

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SEU_DB_NAME
DB_USERNAME=SEU_DB_USER
DB_PASSWORD=SEU_DB_PASSWORD
```
`php artisan key:generate.` → gerar a key do laravel

`php artisan migrate && php artisan db:seed` -> vai executar as migrates e os seeders do projeto

`npm/pnpm run dev` -> iniciar o vite

`php artisan serve` -> iniciar o servidor web

Usuários de teste
> Admin : veronez.dev@gmail.com / secret123
> Comum : teste@teste.com / secret123

#### Ambiente *COM* docker

`git clone https://github.com/v3ronez/app_facilita_teste` → clonar o repositório do projetório projeto

Fazer o setup das configurações de conexão com o banco no arquivo .env (seguir o exemplo)

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=app_facilita
DB_USERNAME=root
DB_PASSWORD=root
```

`docker compose up -d` → criar o container

`docker exec laravel-app php artisan key:generate` → gerar a key do laravel

`docker exec laravel-app php artisan migrate` → rodar as migrates

`docker exec laravel-app php artisan db:seed` → rodar as seed

`docker exec laravel-app pnpm run dev` → inicializar o vite

`docker compose down` → destruir o container

Usuários de teste
> Admin : veronez.dev@gmail.com / secret123
> Comum : teste@teste.com / secret123


*Problemas com a instalação? DM instagram/@v3ronez | v3ronez.dev@gmail.com*
