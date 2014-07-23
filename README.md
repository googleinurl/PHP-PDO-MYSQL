PHP-PDO-MYSQL
=============

Usando PDO-PHP e tratando dados Insert,Update,Select,Delete


[+] INSERT:
----------
```php

$dados  = array();
$tabela = null;
$db     = null;

/*
DEFININDO DADOS PARA INSERT.
Ex:dados[NOME_DO_CAMPO_BANCO] = valor_inserir; 
O campos que serão criados do array dados,
Correspondem aos campos do banco de dados.
*/

$dados['numero_serie'] = 1;
$dados['id_operacao'] = 12312321;
$dados['supervisor'] = 2;
$dados['data_entrega'] = '10/01/2010';
$dados['data_devolucao'] = date('Y-m-d H:i:s');
$dados['ramal'] = 1010;
$dados['id_status'] = 1;
$dados['data_cadastro'] = date('Y-m-d H:i:s');
$dados['obs'] = 'ola isso é um teste';

//DEFININDO DADOS BANCO DE DADOS. 
$tabela = 'cliente';
$db     = 'banco_vendas';

//SETANDO VALORES INSERT NO OBJETO E EXECUTANDO.
require_once 'Executaq.class.php';
$objExecq = new Executaq($db);
$objExecq->dados = $dados;
$objExecq->tabela = $tabela;
$Iresult = $objExecq->insert($objExecq->dados, $objExecq->tabela); // TRUE OR FALSE
print_r($objExecq->getMsg);
```

[+] SELECT:
----------
```php
$dados  = array();
$sql    = null;
$db     = null;

/*
DEFININDO DADOS PARA SELECT.
Ex:dados[NOME_DO_CAMPO_BANCO] = 'valor_pesquisar'; 
O campos que serão criados do array dados,
Correspondem aos campos do banco de dados e sua ordem.
*/

$dados['data_inicio'] = '01/01/2001';
$dados['data_fim'] = '01/01/2014';

//DEFININDO DADOS BANCO DE DADOS. 
$tabela = 'cliente';
$db     = 'banco_vendas';

//SETANDO VALORES SELECT NO OBJETO E EXECUTANDO.
require_once 'Executaq.class.php';
$sql = "SELECT * FROM {$tabela} where seu_campo_data BETWEEN :data_inicio AND :data_fim";
$objExecq = new Executaq($db);
$objExecq->sql = $sql;
$objExecq->dados = $dados;
print_r($objExecq->select($objExecq->sql, $objExecq->dados));
```
[+] Exemplos de select:
---------
```php
$tabela = 'cliente';

//Ex - 01
$dados['id_operacao'] = 5;
$select = "SELECT * FROM {$tabela} where id_operacao=:id_operacao and id_status=1";

//Ex - 02
$dados['id_status'] = 1;
$select = "SELECT * FROM {$tabela} where id_operacao=1 and id_status=:id_status";

//Ex - 03
$dados['id_operacao'] = 5;
$dados['id_status'] = 1;
$select = "SELECT * FROM {$tabela} where id_operacao=:id_operacao and id_status=:id_status";
```
[+] UPDATE:
---------
```php
$dados  = array();
$sql    = null;
$db     = null;

/*
DEFININDO DADOS PARA UPDATE.
Ex:dados[NOME_DO_CAMPO_BANCO] = 'valor_pesquisar'; 
O campos que serão criados do array dados,
Correspondem aos campos do banco de dados e sua ordem.
*/

$dados['nome_cliente'] = 'Novo nome do cliente teste';
$dados['id_cliente'] = 1;

//DEFININDO DADOS BANCO DE DADOS. 
$tabela = 'cliente';
$db     = 'banco_vendas';

//SETANDO VALORES UPDATE NO OBJETO E EXECUTANDO.
require_once 'Executaq.class.php';
$sql = "UPDATE {$tabela} SET nome_cliente=:nome_cliente where id_cliente=:id_cliente";
$objExecq = new Executaq($db);
$objExecq->dados = $dados;
$objExecq->sql = $sql;
$Uresult = $objExecq->update($objExecq->sql, $objExecq->dados); // TRUE OR FALSE
print_r($objExecq->getMsg);
```
[+] Exemplos de update:
---------
```php
$tabela = 'cliente';

//Ex - 01
$dados['nome_cliente'] = 'Novo nome do cliente teste';
$dados['id_operacao'] = 5;
$dados['id_cliente'] = 1;
$update = "UPDATE {$tabela} SET nome_cliente=:nome_cliente,id_operacao=:id_operacao where id_cliente=:id_cliente;";

//Ex - 02
$dados['nome_cliente'] = 'Novo nome do cliente teste';
$dados['id_operacao'] = 5;
$dados['id_cliente'] = 1;
$update = "UPDATE {$tabela} SET nome_cliente=:nome_cliente,id_operacao=:id_operacao where id_cliente=:id_cliente and id_status = 1 limit 1;";
```
[+] DELETE:
---------
```php
$dados  = array();
$sql    = null;
$db     = null;

/*
DEFININDO DADOS PARA DELETE.
Ex:dados[NOME_DO_CAMPO_BANCO] = 'valor_deletar'; 
O campos que serão criados do array dados,
Correspondem aos campos do banco de dados e sua ordem.
*/

$dados['nome_cliente'] = 'NOME CLIENTE';
$dados['id_cliente'] = 1;

//DEFININDO DADOS BANCO DE DADOS. 
$tabela = 'cliente';
$db     = 'banco_vendas';

//SETANDO VALORES DELETE NO OBJETO E EXECUTANDO.
require_once 'Executaq.class.php';
$sql = "DELETE FROM {$tabela} where nome_cliente=:nome_cliente AND id_cliente=:id_cliente";
$objExecq = new Executaq($db);
$objExecq->dados = $dados;
$objExecq->sql = $sql;
$Dresult = $objExecq->delete($objExecq->sql, $objExecq->dados); // TRUE OR FALSE
print_r($objExecq->getMsg);
```
