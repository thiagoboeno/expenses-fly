![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Expenses Fly - API

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

Caso queira utilizar via postman ou ter acesso ao "doc" da API, basta acessar os passos dentro do README da psta postman e fazer a exportação da collection do projeto!


### Estrutura

- Autenticação: Laravel Sanctum
- Notifications (Redefinir Senha/Criar Despesa)
- Policy Usuarios (isOwnerUser - Verificar se o usuário autenticado é o proprietário da conta - show,update,delete)
- Policy Despesas (isExpenseOwnerUser - Verificar se o usuário autenticado é o mesmo que é prorietário da despesa - show,update,delete)
- Seeders e Factories (Usuários e Despesas)
- Form Requests
- Response Provider (macro para criar uma estrutura base para as respostas em json com as mensagens de feedback das requisições da aplicação)
- Resources


### Mailer

Para enviar todos os emails foi utilizado o Mailtrap (envio e captura dos emails enviados no desenvolvimento), porém com isso todos os emails estão sendo interceptados, caso queira que sejam enviados de fato para a caixa de mensagem, mude no .env, as variaveis abaixo para o sistema de sua preferência.

```
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=b8f728871ef587
MAIL_PASSWORD=b028b04f55fedb
```


### Queue

Ao criar uma Despesa, é criado na fila um job, para que seja disparado de forma assíncrona, a ser executado para enviar um email ao usuário vinculado a despesa, de que a mesma foi criada com sucesso!

Para realizar o envio do email, execute o comando "php artisan queue:work", que ocorrerá o disparo de todas as notificações em fila por ordem de cadastro.


### Teste

Basta rodar o comando "./vendor/bin/phpunit" e os testes serão executados com base no "".env.testing".
