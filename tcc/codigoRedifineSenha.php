<?php
include_once "../tcc/mvc/model/usuarios.php";
$alert_update = "";
session_start();

if ($_SESSION["email_us"]){
    if(isset($_POST["rdf_senha"])){
        if($_POST["cod_senha"] == $_SESSION["pass_us"]){
            if($_POST["nova_senha"] == $_POST["nova_senha_conf"]){
                $update = new Usuario();
                if($update->update_senha($_POST["nova_senha"], $_SESSION["email_us"])){
                    session_unset();
                    session_destroy();
                    header("location: ../tcc/index.php");
                }else{
                    $alert_update = "Ocorreu algum erro ao tentar mudar sua senha!";
                }
            }else{
                $alert_update = "Verifique o campo senhas!!";
            }
        }else{
            $alert_update = "Código não coincide!";
        }
    }
}else{
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

        <div class="container text-center" id="formulario">
            <div class="row justify-content-center align-items-cent er">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Codigo Email</h2>
                                <p>Insira o Codigo recebido </p>
                                <div class="panel-body">
                                        <div class="form-group">
                                            <form method="POST">
                                                <div class="input-group">
                                                    <span class="input-group-addon"
                                                        ><i
                                                            class="glyphicon glyphicon-envelope color-blue"
                                                        ></i
                                                    ></span>
                                                    <input
                                                            id="codSenha"
                                                            name="cod_senha"
                                                            placeholder="Codigo"
                                                            class="form-control"
                                                            type="text"
                                                            style="width: 100%;"
                                                    > 
                                                    
                                                    

                                                    <input
                                                            id="codSenha"
                                                            name="nova_senha"
                                                            placeholder="nova senha"
                                                            class="form-control"
                                                            type="password"
                                                            style="width: 100%;"
                                                    > 
                                                    
                                                    

                                                    <input
                                                            id="codSenha"
                                                            name="nova_senha_conf"
                                                            placeholder="Confirmar senha"
                                                            class="form-control"
                                                            type="password"
                                                            style="width: 100%;"
                                                    > 
                                                    
                                                    
                                                   
                                                </div>

                                                <br>

                                                <button class="btn btn-primary" name="rdf_senha" type="submit">Definr a nova Senha</button>

                                            

                                                <div class="container">
                                            </form>
                    <!-- Brand -->
                

                    <!-- Toggler  -->
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#toggler"
                    >
                        
                    </button>


            <p><?php echo $alert_update ?></p>
        <div>
           

        <!-- Navigation Bar  -->
        
            
           
        
     
            

       

          

       

        <!-- Scripts  -->
        <!-- Please note that jquery library is required for the carousel to work  -->
        <script src="statics/js/jquery.js"></script>
        <script src="statics/js/bootstrap.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>
