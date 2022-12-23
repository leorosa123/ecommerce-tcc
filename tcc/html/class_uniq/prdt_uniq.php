<?php

include_once "../mvc/model/connect_bd.php";

class Produtos{

    /* não esta funcionando pois falta params */
    /* essa função deve listar todos os produtos através de um for na página html/products*/
    public function Listar(){
        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("newtec-eco");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT * FROM produtos");
            $execute_select = $abrir_conect->query($sql);
            if ($execute_select != null){
                $abrir_conect ->close();
                return $execute_select;
            }else{
                $abrir_conect -> close();
                return [];
            }
        }
    }


    public function listar_elementos($categoria){
        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("newtec-eco");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT id_produto, nome_produto, valor_produto, path_produto FROM produtos where categoria='".$categoria."'");
            $execute_select = $abrir_conect->query($sql);
            if ($execute_select != null){
                $abrir_conect ->close();
                return $execute_select;
            }else{
                $abrir_conect -> close();
                return false;
            }
        }



    }



}

?>