<?php

namespace App\Core; //Onde ela está

class Router{
    private $controller;//Parâmetro que recebe o controle que será usado
    private $method;//parâmetro que recebe qual o metodo desse controle que será usado
    private $params;//representa os parâmetros que podem ser usados na URL. Ex: o id do produto que será editado

    //Construtor:  algo que será executado quando nossa classe for instanciada
    function __construct(){
        
        //pegar a url que está sendo acessada
        $url = $this->parseURL();//-> $url recebe o instanciamento de parseURL, cujo retorna o explode da URL (a URL dividida)

        //Se já existe um controller (arquivo) com este nome (a posição um da nossa URL sempre é o controller)
        if(file_exists("../App/Controllers/" . $url[1] . ".php")){
            //Se o controller passado pela URL realmente existir, pode-se pegá-lo através do atributo/variável privado controller, o qual usaremos e redirecionaremos 
            $this->controller = $url[1];//$this-> Refere-se ao objeto atual
            unset($url[1]);//Após isso, damos um unset
        //Se estiver vazio:
        }elseif(empty($url[1])){
            //Passamos para $controller o controller padrão: produtos, que é a listagem de produtos 
            $this->controller = "produtos";
        //Se não estiver vazio, significa que o usuário colocou alguma coisa, cuja está incorreta e é inexistente, então exibimos a mensagem de erro:
        }else{
            //Fazendo chamada ao arquivo: Views/erros/404.php
            $this->controller = "erro404";
        }
        //Vamos instanciar o controler que temos ali em cima. Ex: se vier lá no 1º if: categorias, irá concatenar aqui em baixo
        require_once "../App/Controllers/" . $this->controller . ".php";
        //Colocamos dentro de $this->controller, uma nova $this->controller.
        $this->controller = new $this->controller;

        //verificar se o método da url existe dentro do controller
        if(isset($url[2])){
          //Se dentro da variável controller existe a $url[2], no caso, se existe o método
            if(method_exists($this->controller, $url[2])){ //Sempre dentro da url[2], tem o método
            //Caso exista esse método, $method recebe a $url[2]
                $this->method = $url[2];
                //E já que utilizamos a url[2], damos um unset
                unset($url[2]);
                //damos um unset também na $url[0], que é 0 nosso domínio
                unset($url[0]);
            }else{

            }
            //se não houver o controller, então o method redireciona para a raiz
        }else{
            $this->method = "index";
          }

        //pegamos apenas os valores dos parametros da url (posição [3] em diante, pois os params sempre estarão na posição três em diante)
                        //Tem ainda alguma coisa na $url? Se sim, pegamos apenas os valores dessa array (sem ser as posições), ou se não estiver preenchida, retornamos-a vazia.
        $this->params = $url ? array_values($url) : [];
    //Após isso, fazemos: a chamada desse método e desse controller e dos parametros
        call_user_func_array([$this->controller, $this->method], $this->params);
        
    }

    //retorna o controller, o método e os params da url em um vetor
    private function parseURL(){
        //explode seria ou serve para 'separar' ou 'dividir' a nossa URL. Seria para dividir o controle do método. O exemplo está na Public/index
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }

}