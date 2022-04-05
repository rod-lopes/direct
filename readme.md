# PROJETO DIRECT

![](http://www.sosfinancas.com.br/direct/demo/static/logo_login.png)


### Objetivo

Este projeto visa a construção de uma plataforma de gerenciamento web de contêners baseado em dados fictícios,



### Configuração

Para o correto uso da ferramenta, devemos realizar os ajustes nos seguintes arquivos:

#### config.php

```html
<?php 

//VARIAVEIS GLOBAIS
$nome_sistema = "DIRECT Terminal Portuário";
//EMAIL ACESSO TELA ADMINISTRAÇÃO
$email_adm = 'exemplo@exemplo.com.br';


$telefone_sistema = "(13) XXXXX-XXXX";
$rodape = "Sistema Desenvolvido por Rodrigo Basso Lopes";

/*
//VARIAVEIS PARA O BANCO LOCAL
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'direct';
*/

//ACESSO AO SEU SERVDOR
$servidor = 'localhost';
$usuario = ''; //NOME DE USUÁRIO DO BANCO DE DADOS
$senha = ''; // SENHA DO BANCO DE DADOS
$banco = ''; // NOME DO BANCO DE DADOS

 ?>
```


#### Fim
