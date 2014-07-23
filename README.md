PHP-PDO-MYSQL
=============

Usando PDO-PHP e tratando dados Insert,Update,Select,Delete


INSERT
----------
```php

$dados  = array();
$tabela = null;
$db     = null;

//DEFININDO DADOS PARA INSERT.
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
$objExecq = new Executaq($db);
$objExecq->dados = $dados;
$objExecq->tabela = $tabela;
$Iresult = $objExecq->insert($objExecq->dados, $objExecq->tabela);
print_r($objExecq->getMsg);
        
```
