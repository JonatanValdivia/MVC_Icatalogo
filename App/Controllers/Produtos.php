<?php

use App\Core\Controller; //Estamos usando a classe Controller, que está em App que está em Core

//Pegamos uma herança da classe Controller e passamos-a para Produtos.

//Podemos ter sete métodos dentro de Controller, dois deles é o index e a view
class Produtos extends Controller{
  //lista todos os produtos
  public function index(){ 
                  //Recebe a instância dessa classe (index()), cujo instanciamento é da classe Produto 
    $produtoModel = $this->model("Produto");
    //OBS: dentro do Model de Produto, temos a função: listarTodos(), então como a $produtoModel é uma instância da Model de Produto, podemos usar a função dessa classe.
    //Porém, recebemos esses dados dentro de uma variável ($dados), ou seja, $dados recebe toda a listagem de produtos. 
    $dados = $produtoModel->listarTodos();
    //Qual a view que essa classe tem que renderizar (Views/produtos/index), junto a todos os produtos listados. Ou seja: temos a classe com a função de listar todos os produtos (Model/Produto.php), instanciamos essa classe aqui na classe Produtos que recebe a herança de Controller (cuja classe está em: Core/Controller.php), que faz o instanciamento automático de Models e Views. Por fim, essa classe instancia a view de produtos/index, cujo arquivo redenriza os produtos listados
    $this->view("produtos/index", $dados);

    //Isso por si só ainda não está funcionando, pois temos que criar um "roterizador", um conceito de rotas 
  }
}