
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Expenses Fly

Expenses Fly é uma aplicação API REST em Laravel que visa a autenticação do usuário e o cadastro das despesas do mesmo.

### Instalação
- Copiar o arquivo .env.example para .env dentro da raiz do projeto.
- Ao colocar o .env, lembre-se de mudar o usuário e senha do seu banco de dados, e caso necessário o host também.
- Executar o comando "composer install" para instalar as dependencias do projeto.
- Executar o comando "php artisan migrate" para criar as tabelas da aplicação (caso não tenha a tabela expenses-fly em seu MySql, basta selecionar a opção "Yes" que aparecerá, que o banco será criado).
- Opicional: Executar o comando "php artisan db:seed" para rodar as Factories/Seeders da aplicação e popular o banco com dados ficticios de Usuários e Despesas.
- Executar o comando "php artisan serve" para rodar a aplicação na porta 8080 e deixá-la disponivel para uso local.

### Ambiente Utilizado
- Ubuntu 22.04 - WSL
- Php 8.2
- MySql Server 8.0.35
- Mailtrap (envio e captura dos emails enviados no desenvolvimento)

### Rotas

Todas as rotas disponíveis da aplicação e os parametros necessários para realizá-las estão especificados dentro na aplicação na rota /doc, onde tudo está devidamente documentado.

Caso queira utilizar via postman "aqui" disponibilizamos a exportação da collection do projeto!

### Estrutura
- Autenticação: Laravel Sanctum
- Notifications (Redefinir Senha/Criar Despesa)
- Policy Usuarios (isOwnerUser - Verificar se o usuário autenticado é o proprietário da conta - show,update,delete)
- Policy Despesas (isExpenseOwnerUser - Verificar se o usuário autenticado é o mesmo que é prorietário da despesa - show,update,delete)
- Seeders e Factories (Usuários e Despesas)
- Form Requests
- Response Provider (macro para criar uma estrutura base para as respostas em json com as mensagens de feedback das requisições da aplicação)
- Resources

### Queue

Ao criar uma Despesa, é criado na fila um job, para que seja disparado de forma assíncrona, a ser executado para enviar um email ao usuário vinculado a despesa, de que a mesma foi criada com sucesso!

Para realizar o envio do email, execute o comando "php artisan queue:work", que ocorrerá o disparo de todas as notificações em fila por ordem de cadastro.

