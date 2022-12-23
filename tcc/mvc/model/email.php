<?php

require_once "./mvc/model/src//PHPMailer.php";
require_once "./mvc/model/src/SMTP.php";
require_once "./mvc/model/src/Exception.php";
require_once "./mvc/model/connect_bd.php";




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Email{
   
    public function enviar_email($send_email){
        $mail = new PHPMailer(true);
        $user_adm = "newtececo@gmail.com";
        $password_generator = uniqid();

        $start_conexao = new BD_connect();
        $conexao_on =   $start_conexao->connect_BD("newtec-eco");

        if ($conexao_on->connect_error){
            echo "Ocorreu um erro de conexão!";
        }else{
            $sql = ("SELECT user_user from usuarios where email_user ='".$send_email."'");

            $execute_select = $conexao_on->query($sql);
            $array = $execute_select->fetch_object();
            try{
                if (strlen($array->user_user)> 0){
                    try{

                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = $user_adm;
                        $mail->Password = "erxumjdmhptfrmsk";
                        $mail -> Port = 587;
            
                        $mail->setFrom($user_adm);
                        $mail->addAddress($send_email);
            
                        $mail->isHTML(true);
                        $mail->Subject = "Redefinir senha-NewTec";
                        $mail->Body = "
                            <h2>Olá, ".$array->user_user." </h2>
                            <hr>
                            <p>Seu pedido de redefinição de senha foi solicitado com sucesso!!</p>
                            <p>Senha de recuperação: ( ".$password_generator." )</p>
                            <br>
                            <p>Atensiosamente, Equipe Newtec-ECO</p>
                        ";
            
                        if ($mail->send()){
                            return $password_generator;
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