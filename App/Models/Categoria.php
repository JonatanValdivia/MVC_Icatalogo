<?php
//Primeiro devemos fazer a conexão com o banco de dados
use App\Core\Model;

class Categoria{
  //Declaramos aqui as variáveis que utilizaremos alguma hora
  public $id;
  public $descricao;
  
  public function listarCategorias(){
    //Agora pegamos o SQL que utilizamos no icatalogo estruturado, no caso, esse:
    /*$sqlSelect = "SELECT * FROM tbl_categoria;";
     $resultado = mysqli_query($conexao, $sqlSelect) or die(mysqli_error($conexao));
     
     E aplicamos algumas alterações:
     */

    $sqlSelect = "SELECT * FROM tbl_categoria;";

    $stmt = Model::getConn()->prepare($sqlSelect);
    $stmt->execute();
    //Se a linha retornada for maior que zero (se houver uma linha, basicamente), então faça:
    if($stmt->rowCount() > 0){
      $resultado = $stmt->fetchAll(\PDO::FETCH_OBJ);//transformar tudo em um array de objetos
      return $resultado;//Retornamos esse array
    }else{//Se não houver nenhuma linha, então retorna um array vazio
      return [];
    }
  }

  public function inserir(){
    //Declaramos o sql, com um ponto de bind "?"
    $sql = " INSERT INTO tbl_categoria (descricao) VALUES (?) ";
    //Preparamos a instância para inserir
    $stmt = Model::getConn()->prepare($sql);
    //Substirui o primeiro "?" pela variável descrição
    $stmt->bindValue(1, $this->descricao);
    if($stmt->execute()){
      //Executamos, se der certo, então atribui o id inserido na classe 
        $this->id = Model::getConn()->lastInsertId();
        //E retorna a própria classe
        return $this;
    }else{
      //Se der errado retorna falso
        return false;
    }
  }

  public function buscarPorId($id){

      $sql = " SELECT * FROM tbl_categoria WHERE id = ? ";
      $stmt = Model::getConn()->prepare($sql);
      $stmt->bindValue(1, $id);

      if($stmt->execute()){
          $categoria = $stmt->fetch(PDO::FETCH_OBJ);

          if(!$categoria){
              return false;
          }

          $this->id = $categoria->id;
          $this->descricao = $categoria->descricao;

          return $this;
      }else{
          return false;
      }
  }

  public function atualizar(){
     $sql = "UPDATE tbl_categoria SET descricao = ? WHERE id = ?";

     $stmt = Model::getConn()->prepare($sql);
     $stmt->bindValue(1, $this->descricao);
     $stmt->bindValue(2, $this->id);

     return $stmt->execute();
    
  }

    public function deletar(){
      $sql = " DELETE FROM tbl_categoria WHERE id = ? ";
      $stmt = Model::getConn()->prepare($sql);
      $stmt->bindValue(1, $this->id);

      return $stmt->execute();
  }

}