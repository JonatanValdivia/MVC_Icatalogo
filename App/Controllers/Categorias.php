<?php
session_start();

use App\Core\Controller;

class Categorias extends Controller{
  
  public function index(){
    $categoriaModel = $this->model("Categoria"); //Fazemos a instância de Model de Categoria
    //Dentro desse model, temos: a função de listar as categorias, exibí-las na tela, então, fazemos:
    $dados = $categoriaModel->listarCategorias(); //Fazemos a instância dessa função

    //Mostramos em qual view deve ser renderizado a página
    $this->view('categorias/index', $dados);//passamos junto a index, os dados.
  }

  public function create(){
    //Tem que devolver o que será digitado no formulário
    $this->view("categorias/create");
    
  }

  public function store(){
    echo "Implementar a inserção aqui";
    //Validar os campos (pegar a função da validação já criada no outro projeto)
    $erros = $this->validarCampos();
    //Instanciar o model
    $categoriaModel = $this->model("Categoria");
    //atribuir a descrição do $_POST ao model->descricao
    $categoriaModel->descricao = $_POST["descricao"];
    //Chamar a função inserir
    if($categoriaModel->inserir()){
      $_SESSION["mensagem"] = "Categoria cadastrada com sucesso!";
    }else{
      $_SESSION["mensagem"] = "Problemas ao cadastrar categoria";
    }
    header("location: /categorias");
    //Verificar se deu tudo certo, e enviar uma mensagem
  }

  public function edit($id){

    $categoriaModel = $this->model("Categoria");

    $categoriaModel = $categoriaModel->buscarPorId($id);
    if ($categoriaModel) {
        $this->view("categorias/edit", $categoriaModel);
    } else {
        $_SESSION["mensagem"] = "Problemas ao buscar categoria";
        header("location: /categorias");
    }
  }

  public function update($id){
    $categoriaModel = $this->model("Categoria");
    $categoriaModel->id = $id;
    $categoriaModel->descricao = $_POST['descricao'];//Passamos o novo value que está na input para Model/Categoria/atualizar(), cujo recebe determiando valor
    if($categoriaModel->atualizar()){
      $_SESSION["mensagem"] = "Categoria editada com sucesso";
    }else{
      $_SESSION["mensagem"] = "Problemas ao editar categoria";
    }
    header("location: /categorias");
  }

  public function destroy($id){
    $categoriaModel = $this->model("Categoria");
    $categoriaModel->id = $id;
    if ($categoriaModel->deletar()) {
      $_SESSION["mensagem"] = "Categoria deletada com sucesso";
    } else {
      $_SESSION["mensagem"] = "Problemas ao deletar categoria";
    }

  header("location: /categorias");

  }

  private function validarCampos(){
      
    if(!isset($_POST["descricao"]) || $_POST["descricao"] == ""){
      $erros[] = "O campo descrição é obrigatório!";  
    }
    return $erros;
  }

}