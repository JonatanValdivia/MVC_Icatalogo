<?php
namespace App\Core;

//recebe o model que vai ser utilizado pelo controller
//instancia e retorna a instância pronta para o uso
class Controller{
  //método que faz o instanciamento dos models automaticamente:
                      //O que receberemos por parâmetro
  public function model($model){
    require_once "../App/Models/" . $model . ".php";
    return new $model;
    //Ex: recebemos o nome "produto", essa função irá fazer: buscar dentro de App/Models/ determinada palavra, junto a sua extensão. Depois retornamos uma nova $model instanciada.
  }
//recebe a view que vai ser redenrizada e passa o tamplate
//Passa também os dados para a view
  public function view($view, $data = []){ //view() faz quase a mesma coisa que a model(), porém além de precisar saber qual view será chamada, quando a página for carregada, ex: dentro de controller vamos chamar a página de edição de produto, essa função terá que carregar a view de editar produto. E também podemos, após carregar uma view, passar alguns dados, através de uma array/atributo composto. Por padrão, começam com a lista vazia. Caso não passe nada, será vazio mesmo, caso passe alguma coisa, será agregado os valores/dados.
    require_once "../App/Views/template.php";//-> Quando essa função for chamada, chamamos esse arquivo (../App/Views/template.php), e já 'injetamos' as variáveis passadas como parâmetro $view e $data 
  }

}