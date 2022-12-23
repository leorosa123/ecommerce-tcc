<?php

use PHPMailer\PHPMailer\PHPMailer;

include_once "../mvc/model/connect_bd.php";

include_once "../mvc/model/src/PHPMailer.php";
include_once "../mvc/model/src/SMTP.php";
include_once "../mvc/model/src/Exception.php";

class Vendas{

    public function realizar_venda($user){

        $connect_on = new BD_connect();
        $abrir_conect = $connect_on->connect_BD("newtec-eco");
        if ($abrir_conect->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $compra = md5(uniqid());
            $sql = ("INSERT INTO vendas (user_comprador, num_compra) VALUES ('".$user."', '".$compra."')");
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



class Email{
   
    public function enviar_email($user){
        $mail = new PHPMailer(true);
        $user_adm = "newtececo@gmail.com";
       

        $start_conexao = new BD_connect();
        $conexao_on =   $start_conexao->connect_BD("newtec-eco");

        if ($conexao_on->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT email_user from usuarios where user_user ='".$user."'");

            $execute_select = $conexao_on->query($sql);
            $array = $execute_select->fetch_object();
            try{
                if (strlen($array->email_user)> 0){
                    try{

                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = $user_adm;
                        $mail->Password = "erxumjdmhptfrmsk";
                        $mail -> Port = 587;
            
                        $mail->setFrom($user_adm);
                        $mail->addAddress($array->email_user);
            
                        $mail->isHTML(true);
                        $mail->Subject = "Pedido de compra -NewTec";
                        $mail->Body = "
                            <h2>Olá, ".$user." </h2>
                            <hr>
                            <p>Seu pedido de compra foi realizado com sucesso!!</p>
                            <p>Método de compra: PIX (Automatico)!!</p>
                            <p>Para Concluir a sua compra envie-nos o comprovante pelo whatsapp da loja ou pelo email!!</p>
                            <p>Nossa chave: (499.523.666.52)</p>

                            <br>
                            <p>Atensiosamente, Equipe Newtec-ECO</p>
                        ";
            
                        if ($mail->send()){
                            return true;
                        }else{
                            return false;
                        }
                    }catch(Exception $e){
                        return false;
                    }
                }else{
                    return false;
                }
            }catch(Exception $e){
                return false;
            }
        }

       

    }
}
?>


