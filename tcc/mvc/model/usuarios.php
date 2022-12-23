<?php

include_once "./mvc/model/connect_bd.php";

/*Passar como argumento o Banco de dados */

class Usuario{

    /* função inserir já está funcionando */

    public function insert_user($user_user, $email_user, $senha_user){
        $start_conexao = new BD_connect();
        $conexao_on =   $start_conexao->connect_BD("newtec-eco");

        $senha_user = md5($senha_user);


        $sql_ =  $sql = ("SELECT id_user from usuarios where email_user ='".$email_user."'");
        $execute = $conexao_on->query($sql);
        $execute_object = $execute->fetch_object();

        if ($execute_object->id_user > 0){
            return false;
        }else{
            if ($conexao_on->connect_errno){
                echo "ocorreu um erro de conexão";
            }else{
                $sql = ("INSERT INTO usuarios (user_user, senha_user, email_user) VALUES ('".$user_user."', '".$senha_user."', '".$email_user."')");
    
                $teste = $conexao_on->query($sql);
        
                if ($teste){
                    $conexao_on->close();
                    return true;
                }else{
                    $conexao_on->close();
                    return false;
                }
            }
        }

        
    }


     /* função logar já está funcionando */
    public function logar_user($user_user, $senha_user){
        $start_conexao = new BD_connect();
        $conexao_on =   $start_conexao->connect_BD("newtec-eco");

        $senha_us = md5($senha_user);

        if ($conexao_on->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT senha_user from usuarios where user_user ='".$user_user."'");

            $execute_select = $conexao_on->query($sql);
            $array = $execute_select->fetch_object();
            try{
                if ($array->senha_user == $senha_us){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                return false;
            }
          
        }
    }



     /* função atualizar senha já está funcionando */

    public function update_senha($new_senha, $email_user){
        $start_conexao = new BD_connect();
        $conexao_on =   $start_conexao->connect_BD("newtec-eco");

        $sql_ =  $sql = ("SELECT id_user from usuarios where email_user ='".$email_user."'");
        $execute = $conexao_on->query($sql);
        $execute_object = $execute->fetch_object();

        if ($execute_object->id_user > 0){
            if ($conexao_on->connect_errno){
                echo "ocorreu um erro de conexão";
            }else{

                $new_senha = md5($new_senha);

                $sql = ("UPDATE usuarios set senha_user='".$new_senha."' WHERE  email_user='".$email_user."'");
                
    
                $teste = $conexao_on->query($sql);
        
                if ($teste){
                    $conexao_on->close();
                    return true;
                }else{
                    $conexao_on->close();
                    return false;
                }
            }
        }else{
            $conexao_on->close();
            return false;
        }
    }
}

?>