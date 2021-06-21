<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  //Aplicando a psr-4 - autoload de nossas classes
  require("../vendor/autoload.php");
  $app = new \App\Core\Router();
  //Essa variável faz o instanciamento da função construtora (que pega a URL e verifica o que há lá dentro);
  //Devemos também fazer um redirecionamento, senão dará erro, então devemos colocar um .htaccess dentro do arquivo PUBLIC

  








  //Exemplo de $_SERVER -> recuperar a url e a URI:
  //echo "<P style='float: rigth'>"
  //. //SERVER_NAME: Recupera a 'mvc.icatalogo.com.br' 
  //$_SERVER["SERVER_NAME"] . 
  //REQUEST_URI: Recupera o complemento, seriam as requisições: '/produtos/algumaCoisa
  //$_SERVER["REQUEST_URI"];

  //$url = "mvc.icatalogo.com.br/produtos/ksc";
              //O separador
  //print_r(explode("/", $url));
  //O que é retornado:
  //Array ( [0] => mvc.icatalogo.com.br [1] => produtos [2] => ksc )
  
  // //require("./App/Models/produto.php");
  // //Instanciando uma variável: 
  // $produto = new \App\Models\Produto();
  // //A classe produto, que está no arquivo Models tem a função pública de listagem de todos os produtos do mysql.
  // //Atribuímos a variável produtos, produto com a atribuiçao da função de listar todos os produtos
  // $produtos = $produto->listarTodos();

  // //Percorrer todos os produtos 
  // foreach($produtos as $produto){
  //   echo $produto->descricao;
  // }

  // // $produto->descricao = " Calça Jeans Masculina";

  // // echo $produto->descricao;
  