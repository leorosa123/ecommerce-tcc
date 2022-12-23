<?php

include_once "./mvc/model/connect_bd.php";

class Produtos{

   

    /* funcão retorna o id do respectivo produto salvo na base de dados */
    /* posso retornar um array com os seguintes dados (id, nome_produto, valor, imagem) pelo fetch_object */
    public function search_product($nome){
        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("newtec-eco");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT categoria FROM produtos where categoria='".$nome."'");
            $execute_select = $abrir_conect->query($sql);
            $id_prodt = $execute_select->fetch_object();
            if ($execute_select != null){
                $abrir_conect ->close();
                return $id_prodt->categoria;
            }else{
                $abrir_conect -> close();
                return false;
            }
        }
    }


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