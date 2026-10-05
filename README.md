# Sistema de Gestão de Brinquedos

Este projeto é um CRUD simples em PHP e MySQL para cadastrar, listar, editar e excluir brinquedos.

## Requisitos

- XAMPP
- PHP
- MySQL
- Navegador

## Como criar o banco

1. Abra o phpMyAdmin.
2. Crie um banco chamado `gestao_brinquedos`.
3. Execute o arquivo `banco.sql`.

## Configuração da conexão

O arquivo `config/database.php` já está configurado com:

```php
$host = 'localhost';
$db_name = 'gestao_brinquedos';
$user = 'root';
$password = '';
```

Se o seu MySQL tiver outra senha, ajuste lá.

## Como executar

1. Coloque a pasta do projeto dentro da pasta `htdocs` do XAMPP.
2. Inicie o Apache e o MySQL.
3. Abra no navegador:

http://localhost:8080/davi_f_freitas/Atividade-Recupera-o-Sistema-de-Gest-o-de-Brinquedos/

## Estrutura do projeto
 
 config
 database.php

css
 style.css

 index.php
 cadastrar.php
 salvar.php
 editar.php
 atualizar.php
 excluir.php
 banco.sql
 README.md
 .gitignore


## Como testar o CRUD

### Cadastrar
- clique em "Cadastrar brinquedo"
- preencha os dados
- envie o formulário

### Listar
- a página inicial mostra todos os brinquedos

### Editar
- clique em "Editar"
- altere os dados
- salve novamente

### Excluir
- clique em "Excluir"
- confirme a exclusão

## Observações

- Usamos Prepared Statements nas consultas.
- Há validação básica de nome, preço e estoque.
- O sistema mostra mensagens simples para usuário.
