<?php
//Isolando a classe MODEL
//O namespace deve sempre corresponder a estrutura de pasta que a classe se encontra
namespace App\Core; 

  class Model {
    //utilizando o padrão de projeto singleton -> muito utilizado pois ele representa uma classe que só pode ser instanciada uma vez. 
    private static $conexao;
    //O que é um método ou atributo estatico dentro de uma classe? R: um método ou atributo static é aquele que não precisa instanciar antes de usar o método, mas pode-se acessar diretamente. Então não podemos mais usar o $this->, já que o mesmo faz instanciamento. Temos que utilizar o self::$variável
    // Self = estamos pegando o próprio atributo/método/classe
    // :: = acesso a um atributo

    //Recortamos a função
    //Obs: esse método deve ser público
    public static function getConn(){
        //se a conexão não estiver setada, conexão recebe: o host. o port, o nome do database, o root, e a senha:   
        //Antes de usar o static: 
                //$this->conexao -> temos que informar que $conexao é desta(getConn()) classe
        if(!isset(self::$conexao)){
            self::$conexao = new \PDO("mysql:host=localhost;port=3306;dbname=icatalogo;", "root", "bcd127");
        }
        //retornamos a conexão, assim que ela estiver setada. E sempre que estiver setada, a conexão é retornada.
        return self::$conexao;
    }

}
