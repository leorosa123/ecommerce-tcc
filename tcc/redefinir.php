<?php
include_once "./mvc/model/email.php";


$alert_email = "";

if (isset($_POST["reset-password"])){
    $redefinir_senha = new Email();
    $result = $redefinir_senha ->enviar_email($_POST["email_recu"]);
    if (strlen($result)>0){
        $alert_email_email = "aguarde o código em sua caixa de email";
        session_start();
        $_SESSION["pass_us"] = $result;
        $_SESSION["email_us"] = $_POST["email_recu"];
        header("location: ../tcc/codigoRedifineSenha.php");
    }else{
        $alert_email = "E-mail invalído ou não encontrado!";
    }
}
if (isset($_POST["sair"])){
    echo "olá mundo";
    header("location: ../tcc/index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Title  -->
        <title>NewTEC-ECO | Home</title>

        <!-- Stylesheets  -->
        <link rel="stylesheet" href="statics/css/bootstrap.css" />
        <link rel="stylesheet" href="css/commonStyling.css" />
        <link rel="stylesheet" href="css/indexStyle.css" />

        <!-- Font Awesome  -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        />
    </head>
    <body>

        <!-- Navigation Bar  -->
         
        <nav class="navbar navbar-expand-lg bg-primary-color navbar-light fixed-top">
            <div class="container">
                <!-- Brand -->
                <div class="navbar-header">
                    <a class="navbar-brand text-white" href="#">NewTEC-ECO</a>
                </div>
            </div>

            </nav>



        <!-- Formulario recuperar senha no meio da tela -->

        <form method="POST">
            <div class="container text-center" id="formulario">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">
                                    <h3><i class="fa fa-lock fa-4x"></i></h3>
                                    <h2 class="text-center">Esqueceu a senha?</h2>
                                    <p>Você pode redefinir sua senha aqui.</p>
                                    <div class="panel-body">
                                        <form
                                            id="register-form"
                                            role="form"
                                            autocomplete="off"
                                            class="form"
                                            method="post"
                                        >
                                            <div class="form-group">
                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"
                                                            ><i
                                                                class="glyphicon glyphicon-envelope color-blue"
                                                            ></i
                                                        ></span>
                                                        <input
                                                                id="email"
                                                                name="email_recu"
                                                                placeholder="email address"
                                                                class="form-control"
                                                                type="email"
                                                        >  
                                                    </div>
                                            
                                            </div>
                                            

                            





        



            <div>

            <div class="modal-footer">
                        <button
                            name="sair"
                            type="submit"
                            class="btn btn-default"
                            data-dismiss="modal"
                        >
                            Cancelar
                        </button>
                        
                        <button
                                type="submit"
                                class="btn btn-primary"
                                name="reset-password"
                            >
                                Enviar
                        </button>
                      
                       
            </div>
        </form>
        
           

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div class="alert alert-primary d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  <div>
    <?php

    echo $alert_email;

    ?>
  </div>
</div>


          

        <!-- Scripts  -->
        <!-- Please note that jquery library is required for the carousel to work  -->
        <script src="statics/js/jquery.js"></script>
        <script src="statics/js/bootstrap.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>