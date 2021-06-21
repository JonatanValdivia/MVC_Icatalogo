<?php

//namespace App\Models; //-> A classe produto está dentro desses arquivos

//Precisamos dizer que iremos usar o Model, que está dentro de Core, que está dentro de App. Seia como o import em java.
use App\Core\Model; //-> classe que tem a conexao com o banco de dados.
  
class Produto {
    public $id;
    public $descricao;
    public $peso;
    public $quantidade;
    public $cor;
    public $tamanho;
    public $valor;
    public $desconto;
    public $imagem;
    private $conexao;


    //Função para conexão com o banco de dados:
    //Deve-se ter uma classe que faça determinada função: de conexão com o banco de dados
    //Então, deixamos tal função na pasta CORE, que seria o coração do software
    // private function getConn(){
    //     $conexao = new PDO("mysql:host=localhost;port=3306;dbname=icatalogo;", "root", "bcd127");
    //     return $conexao;
    // }

    public function listarTodos(){
        $sql = " SELECT p.*, c.descricao as categoria FROM tbl_produto p                 INNER JOIN tbl_categoria c ON p.categoria_id = c.id ORDER BY p.id DESC ";
        //$stmt = $this->getConn()->prepare($sql); -> antes de passar o getConn para static. Depois:
        $stmt = Model::getConn()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){            //Atributo da classe PDO que é um atributo fixo e constante, ao mesmo tempo estático, e para acessar tal atributo utilizamos os "::" = "dois pontinhos"
            $resultado = $stmt->fetchAll(\PDO::FETCH_OBJ);//Obtemos todos os resultados através de fetch_obj, que são os objetos
            return $resultado;
        }else{
            return [];
        }
    }
}