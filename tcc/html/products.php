<?php

include_once "../html/class_uniq/prdt_uniq.php";
include_once "../html/class_uniq/vendas_uniq.php";

session_start();

/* lista produtos */
if ($_SESSION["logado"]){
    $listar_elements = new Produtos();
    $pdts = $listar_elements->Listar();
    $categoria = array();
}else{
    header("location: ../index.php");
}


/* fechar sessao de compras */
if (isset($_POST["btn_home"])){
    session_unset();
    session_destroy();
    header("location: ../index.php");
}

$compra = "";
/* Carrinho fazer pedido */
if ($_SESSION["logado"]){
    if(isset($_POST["pedir"])){
        $rvenda = new Vendas();
        $email_venda = new Email();
        /*$compra = strval($_SESSION["valor"]);*/
        
        if($rvenda->realizar_venda($_SESSION["user_"])){
            if($email_venda->enviar_email($_SESSION["user_"])){
                header("location: ../index.php");
            }    
        }else{
            $compra = "Não foi possivel finalizar a compra";
        } 
    }        
}








?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Title  -->
        <title>NewTEC-ECO | Carrinho</title>

        <!-- Stylesheets  -->
        <link rel="stylesheet" href="../statics/css/bootstrap.css" />
        <link rel="stylesheet" href="../css/commonStyling.css" />
        <link rel="stylesheet" href="../css/productStyle.css" />

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

                <!-- Toggler  -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#toggler"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="toggler">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <form method="POST">
                                <a class="nav-link" href="../index.php">
                                    <button
                                        class="btn btn-outline-light nav-btn"
                                        data-toggle="modal"
                                        name="btn_home"
                                        type="submit"
                                        data-target="#loginModal"
                                    >
                                        <i
                                            class="fa fa-home"
                                            aria-hidden="true"
                                        ></i>
                                        &nbsp; Home
                                    </button>
                                </a>
                            </form>
                           
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <button
                                    class="btn btn-outline-light nav-btn"
                                    data-toggle="modal"
                                    data-target="#loginModal"
                                >
                                    <i
                                        class="fa fa-sign-in"
                                        aria-hidden="true"
                                    ></i>
                                    &nbsp; Entrar
                                </button>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <button
                                    class="btn btn-outline-light nav-btn"
                                    data-toggle="modal"
                                    data-target="#cart"
                                >
                                    <i
                                        class="fa fa-shopping-cart"
                                        aria-hidden="true"
                                    ></i>

                                    <sup
                                        >(<span class="total-count"></span
                                        >)</sup
                                    >
                                    &nbsp; Carrinho
                                </button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container  mt-5 mb-5 main-content">
            <div class="row text-center">
                <div class="col-lg-12">
            <?php while($element = mysqli_fetch_assoc($pdts)){ ?> 
                <?php
                    if (in_array($element["categoria"], $categoria) == false){ ?>
                        <div class="row">
                            <!-- Tank Tops -->
                            <div class="container product text-center" id="<?php $element['categoria'];?>">
                                <div class="row">
                                    <h1 class="section-heading mb-3" style="font-size: 2rem";><?php echo $element["categoria"]; ?></h1>
                                </div>

                                <div>

                                </div>

                            
                                <div class="row product-items " style="margin-bottom: 10px ;">
                                    <?php
                                        $listar_elements = new Produtos();
                                        $elements = $listar_elements->listar_elementos($element["categoria"]);
                                        array_push($categoria, $element["categoria"]);
                                        
                                    ?>
                                    <?php while ($element = mysqli_fetch_assoc($elements)){ ?>
                                        <div class="col-lg-3" style="margin-bottom: 10px ;">
                                            
                              
                                        
                                        <div class="card">
                                                <?php $_FILES["file"] = '../mvc/paths/'.$element['path_produto'] ?>
                                                
                                                <img
                                                    class="card-img-top"
                                                    src= <?php echo $_FILES["file"]; ?>
                                                    alt="Card image cap"
                                                    height="150px"
                                                    
                                                    style="margin: 30px, 30px, 30px, 30px;"

                                                    
                                                />
                                                <div class="card-block text-center">
                                                 <?php  echo $element["nome_produto"]; ?>
                                                    <p class="card-text">Preço <span class="text-danger">R$ <?php echo $element["valor_produto"]?> </span></p>
                                                    
                                                </div>
                                                
                                                <!-- card footer -->
                                                <div class="card-footer">
                                                    <a
                                                    href="#<?php echo $element["id_produto"]?>"
                                                    data-name="<?php  echo $element["nome_produto"]; ?>"
                                                    data-price="<?php echo $element["valor_produto"]?>"
                                                    class="add-to-cart btn btn-primary w-100"
                                                    >Adicionar</a
                                                >
                                                
                                               
                                                 </div>


                                            </div>
                                        </div>

                                    <?php }  ?>
                                    
                                
                                </div>
                            </div>
                        </div>

                <?php } ?>
                
            <?php } ?>



        </div>

       
         

                
             

                   
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            id="cart"
            tabindex="-1"
            role="dialog"
            aria-labelledby="cartModalLabel"
            aria-hidden="true"
           
        >
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cartModalLabel">Carrinho</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="show-cart table"></table>
                            
                            <div>
                                Preço Total: $ <span class="total-cart"></span>
                                <?php $_SESSION["valor"] =  "<span class='total-cart'></span>" ?>
                                
                               
                            </div>

                            <div>
                            Pagar com : 

                            
                            <a href="#pix" 
                            data-toggle="modal"
                            data-dismiss="modal">
                                <button class="btn btn-primary">Pix</button>
                            </a>

                        
                        


                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="clear-cart btn btn-danger">Limpar</button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                Fechar
                            </button>
                            <button type="submit" name="pedir" class="btn btn-primary">
                                Pedir
                            </button>
                        </div>

                    </form>

                    <?php echo $compra; ?>
                  
                </div>
            </div>
        </div>

        <!-- Fixed Contact Button  -->
        <div class="contact-btn">
            <a
                href="#contactModal"
                style="color: black"
                data-toggle="modal"
                data-target="#contactModal"
            >
                <i class="fa fa-phone fa-2x icon-color" aria-hidden="true"></i>
            </a>
        </div>

        <!-- SignIn Modal  -->
        <div
            class="modal fade"
            id="loginModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="loginModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">
                            Login
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group" style="margin-top: 10px;">
                            <span class="input-group-text">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                placeholder="Nome de Usuario"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <span class="input-group-text">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                placeholder="Senha"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <input
                                type="submit"
                                value="Enviar"
                                class="btn btn-primary btn-block"
                            />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <p>
                            <p>
                            
                                <a href="../redefinir.php">Esqueceu a senha?</a>
                                
                                 
                            </p>
                        </p>
                        <p class="text-right" style="display: inline-block;">
                            Novo Usuario? Cadastre-se
                            <a
                                href="#signupModal"
                                data-toggle="modal"
                                data-dismiss="modal"
                                >aqui</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PASS Modal  -->


        <!-- pix Modal  -->

        <div
        class="modal fade"
        id="pix"
        tabindex="-1"
        role="dialog"
        aria-labelledby="signupModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">
                        Chave Pix 
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        
                        <span>CPF CHAVE PIX</span>
                    </div>
                    <div class="input-group" style="margin-top: 20px;">
                        <span class="input-group-text">
                            <i
                                class="fa fa-key"
                                aria-hidden="true"
                                style="font-size: 11px;"
                            ></i>
                        </span>
                        <span>499.523.666.52</span>

                    

                    </div>

                    <div>
                        <p>Para Concluir a sua compra envie-nos o comprovante pelo whatsapp da loja ou pelo email</p>
                        <p>Email : NewTEC@gmail.com</p>
                        <p>Whatsapp : 11 99999-9999</p>

                        <div>
                            Preço Total: $<span class="total-cart"></span>
                        </div>
                    </div>
                   
                <div >
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Fechar
                    </button>
                    
                    
                </div>
            </div>
        </div>
    </div>
          

        <!-- pix Modal  -->



       
          

          
          <!-- PASS Modal  -->

        <!-- Contact Modal  -->
        <div
            class="modal fade"
            id="contactModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="contactModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel">
                            Contato
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group" style="margin-top: 10px;">
                            <input
                                type="text"
                                name="name"
                                placeholder="Email: xxxxx@email.com"
                                class="form-control"
                                disabled
                            />
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <input
                                type="text"
                                name="name"
                                placeholder="Celular: +11 9332542931"
                                class="form-control"
                                disabled
                            />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between"></div>
                </div>
            </div>
        </div>

        <!-- Sign Up Modal  -->
        <div
            class="modal fade"
            id="signupModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="signupModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signupModalLabel">
                            Cadastre-se
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group" style="margin-top: 10px;">
                            <span class="input-group-text">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input
                                type="text"
                                name="name"
                                placeholder="Nome"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <span class="input-group-text">
                                <i
                                    class="fa fa-envelope-o"
                                    aria-hidden="true"
                                    style="font-size: 11px;"
                                ></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                placeholder="xxxxx@email.com"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <span class="input-group-text">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                placeholder="Criar Senha"
                                class="form-control"
                                required
                            />
                        </div>
                        <div class="input-group" style="margin-top: 20px;">
                            <span class="input-group-text">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                placeholder="Digite a senha novamente"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <div class="form-group w-100">
                            <input
                                type="submit"
                                value="Enviar"
                                class="btn btn-primary btn-block"
                            />
                        </div>
                    </div>
                </div>
            </div>


        </div>

    

        <footer class="page-footer pt-4 text-white  bg-primary-color pt-5">
            <div class="container text-center text-md-left text-sm-left">
                <div class="row">
                    <div class="col-md-4 mt-md-0 mt-3">
                        <h5 class="footer-header text-white">Entre em Contato</h5>
                        <p>
                            Email: xxxxxxx@gmail.com
                            <br />
                            Mobile: 11 9543888132
                            <br />
                            Instagram: @grupo02
                        </p>
                    </div>

                    <hr class="clearfix w-100 d-md-none pb-3" />

                    
                    
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3 bg-secondary-color mt-5">
                &copy; 2022 Copyright: grupo02 - Etec
            </div>
        </footer>

        <!-- Scripts  -->
        <!-- Please note that jquery library is required for the carousel to work  -->
        <script src="../statics/js/jquery.js"></script>
        <script src="../statics/js/bootstrap.js"></script>
        <script src="../js/cart.js"></script>
    </body>
</html>
