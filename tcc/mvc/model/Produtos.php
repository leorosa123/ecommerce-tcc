<?php

include_once "../model/connect_bd.php";

class Produtos{
    
    public function Listar(){
        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT nome_produto, valor_produto, img_produto FROM produtos");
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


    public function search_product($nome){
        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT id_produto FROM produtos where nome_produto='".$nome."'");
            $execute_select = $abrir_conect->query($sql);
            if ($execute_select != null){
                $abrir_conect ->close();
                return true;
            }else{
                $abrir_conect -> close();
                return false;
            }
        }
    }


}

?>