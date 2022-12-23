<?php
require "./mvc/model/usuarios.php";
require "./mvc/model/prdt.php";
$alerts_rg = "";
$alerts_lg = "";
$alerts_search = ""; 

/* já está funcionando */
if(isset($_POST["btn_registrar"])){
    if(strlen(isset($_POST["password"]) > 0 && strlen(isset($_POST["password_conf"]) > 0))){
        if ($_POST["password"] == $_POST["password_conf"]){
            $usuario = new Usuario();
            if ($usuario->insert_user($_POST["name"], $_POST["email"], ($_POST["password"]))){
                $alerts_rg = "Usuario Inserido!Seja bem vindo(a)";
            }else{
                $alerts_rg = "Ocorreu um erro ao Inserir seu usuario";
            }
        }else{
            $alerts_rg = "Por favor!!Verifique o campo senhas";
        }
    }else{
        $alerts_rg = "Insira senhas de até 8 caracters";
    }
}

/* já está funcionando */
if (isset($_POST["login"])){
    /*session_reset();
    session_destroy();*/
    if (strlen($_POST["user_log"])>0 && strlen($_POST["password_log"])>0){
        $log = new Usuario();
        if($log->logar_user($_POST["user_log"], $_POST["password_log"])){
            session_start();
            $_SESSION["logado"] = uniqid();
            $_SESSION["user_"] = $_POST["user_log"]; 
            $alerts_lg = "logado";
        }else{
            $alerts_lg = "Usuario não encontrado!!";
        }
    }else{
        $alerts_lg = "Verifique todos os campos!";
    }
}

/* já está funcionando */
if (isset($_POST["btn_search"])){
    session_start();
    if ($_SESSION["logado"]){
        if(isset($_POST["btn_search"])){
            $produtos = new Produtos();
            $produto = $produtos->search_product(ucfirst($_POST["product_search"]));
            if ($produto){
                /* posso usar esse id na pagina html/products para buscar os dados */
                $_SESSION["id_prdt"] = $produto;
                header("location: ../tcc/html/products.php#".$produto);
            }else{
                $alerts_search = "Produto não encontrado!";
            }
        }else{
            $alerts_search = "Escreva algum produto!";
        }
    }else{
        $alerts_search = "Esteja logado para pesquisar produtos!";  
    }
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

        <!-- Cart Modal  -->
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
                            Preço Total: Rs.<span class="total-cart"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="clear-cart btn btn-danger">Limpar Carrinho</button>
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

        <!-- Carousel  -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators invisible">
                <li
                    data-target="#myCarousel"
                    data-slide-to="0"
                    class="active"
                ></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        class="d-block w-100"
                        src="assets/carousel/pc.webp"
                        alt="First slide"
                    />
                </div>
                <div class="carousel-item">
                    <img
                        class="d-block w-100"
                        src="assets/carousel/roteador.webp"
                        alt="Second slide"
                       
                    />
                </div>
                <div class="carousel-item">
                    <img
                        class="d-block w-100"
                        src="assets/carousel/laptop.webp"
                        alt="Third slide"
                    />
                </div>
                <div class="carousel-item">
                    <img
                        class="d-block w-100"
                        src="assets/carousel/escritorio.webp"
                        alt="Fourth slide"
                    />
                </div>

                <div class="carousel-item">
                    <img
                        class="d-block w-100"
                        src="assets/carousel/im3.webp"
                        alt="Fourth slide"
                    />
                </div>




            </div>
            <a
                class="carousel-control-prev"
                href="#myCarousel"
                role="button"
                data-slide="prev"
            >
                <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                ></span>
                <span class="sr-only">Previous</span>
            </a>
            <a
                class="carousel-control-next"
                href="#myCarousel"
                role="button"
                data-slide="next"
            >
                <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                ></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <hr class="divider" />


        <!-- fim do carrosel   -->

        <!-- Main Content  -->
        <div class="container main-content">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h1>Categorias Mais Populares</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/computadores.webp"
                            alt="Card image cap"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Computadores</h5>
                            <p class="card-text">
                                <strong class="text-danger">A partir de R$ 1000.00</strong>
                            </p>
                            
                        </div>
                        <div class="card-footer">
                            <a
                                href="html/products.php#1"
                                class="btn btn-primary card-btn"
                                >Ver Mais</a
                            >
                            
                            <a
                                href="#"
                                data-name="Tank Top"
                                data-price="699"
                                class="add-to-cart btn btn-primary card-btn"
                                >Adicionar</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/CABOS.webp"
                            alt="Card image cap"
                            height="348px"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Cabos</h5>
                            <p class="card-text">
                                <strong class="text-danger">A partir de R$ 20,00</strong>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                                href="html/products.php#2"
                                class="btn btn-primary card-btn"
                                >Ver Mais</a
                            >
                            <a
                                href="#"
                                data-name="FS Shirt"
                                data-price="499"
                                class="add-to-cart btn btn-primary card-btn"
                                >Adicionar</a
                            >
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/products/roteador/tv2.jpg"
                            alt="Card image cap"
                            height="348px"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Televisões</h5>
                            <p class="card-text">
                                <strong class="text-danger">A partir de R$ 1900,00</strong>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                                href="html/products.php#3"
                                class="btn btn-primary card-btn"
                                >Ver Mais</a
                            >
                            <a
                                href="#"
                                data-name="HS RN T-Shirt"
                                data-price="299"
                                class="add-to-cart btn btn-primary card-btn"
                                >Adicionar</a
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="divider" />

        <div class="container mt-5 mb-5">
            <div class="row text-center">
                <div class="col-lg-12">
                    <h1>Veja Mais Categorias</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-3">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/acessorios.webp"
                            alt="Card image cap"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Acessórios</h5>
                            <p class="card-text">
                                Veja Acessórios
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                            href="html/products.php#4"
                            class="btn btn-primary w-100"
                            >Ver</a
                        >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/cadeira gamer.webp"
                            alt="Card image cap"
                            height="214px"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Cadeiras Gamer</h5>
                            <p class="card-text">
                                Veja Cadeiras Gamer
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                            href="html/products.php#5"
                            class="btn btn-primary w-100"
                            >Ver</a
                        >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/reparos.webp"
                            alt="Card image cap"
                            height="252px"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Reparos</h5>
                            <p class="card-text">
                                Veja mais reparos
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                            href="html/products.php#6"
                            class="btn btn-primary w-100"
                            >Ver</a
                        >
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <img
                            class="card-img-top"
                            src="assets/card/sobre.webp"
                            alt="Card image cap"
                            height="252px"
                        />
                        <div class="card-body text-center">
                            <h5 class="card-title">Sobre Nós</h5>
                            <p class="card-text">
                                Veja mais sobre nós
                            </p>
                        </div>
                        <div class="card-footer">
                            <a
                            href="html/products.php#7"
                            class="btn btn-primary w-100"
                            >Ver</a
                        >
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Products  -->
        <div class="search-products">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-8 offset-lg-2 mr-auto">
                        <div class="search-box">
                            <div class="container">
                                <div class="col-lg-10 offset-sm-1">
                                    <form method="POST">
                                        <div class="input-group">
                                                
                                                <input
                                                    name="product_search"
                                                    class="form-control"
                                                    type="text"
                                                    placeholder="Search Products"
                                                >

                                                <span class="input-group-append">
                                                    <button class="btn" name="btn_search" type="submit">
                                                        <i
                                                            class="fa fa-search"
                                                            aria-hidden="true"
                                                        ></i>
                                                    </button>
                                                </span>
                                        </div>
                                    </form>
                                    <br>
                                    <div class="alert alert-primary" role="alert">
                                        <?php echo $alerts_search; ?>
                                    </div>
                              
                              
                                  
                                  
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <form method="POST">
                            <div class="input-group" style="margin-top: 10px;">
                                <span class="input-group-text">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                                <input
                                    type="text"
                                    name="user_log"
                                    placeholder="Nome de Usuário"
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
                                    name="password_log"
                                    placeholder="Senha"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="form-group" style="margin-top: 20px;">
                                <input
                                    type="submit"
                                    value="Entrar"
                                    name="login"
                                    class="btn btn-primary btn-block"
                                />
                            </div>
                           
                            <div class="alert alert-primary" role="alert">
                            <?php echo $alerts_lg ?>
                           </div>
                           
                           
                          
                        </form>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <p>
                            <a href="redefinir.php">Esqueceu a senha?</a>
                            
                             
                        </p>
                        <p class="text-right" style="display: inline-block;">
                            Novo aqui? <a
                                href="#signupModal"
                                data-toggle="modal"
                                data-dismiss="modal"
                                >Registre-se</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>

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
                                placeholder="Email: newtececo@gmail.com"
                                class="form-control"
                                disabled
                            />
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <input
                                type="text"
                                name="name"
                                placeholder="Celular: 011 9442542931"
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
                            Registre-se
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
                        <form method="POST">
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
                                    placeholder="username@email.com"
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
                                    name="password_conf"
                                    placeholder="Confirmar Senha"
                                    class="form-control"
                                    required
                                />
                            </div>
                            <div class="modal-footer justify-content-between">
                                <div class="form-group w-100">
                                    <input
                                        type="submit"
                                        name="btn_registrar"
                                        value="Registrar"
                                        class="btn btn-primary btn-block"
                                    />
                                </div>
                            </div>


                            <div class="alert alert-primary" role="alert">

                            <?php echo $alerts_rg?>
                           
                            </div>


                        </form>
                       
                    </div>
                   
                </div>
            </div>
        </div>


        

        <!-- Footer  -->
        <footer class="page-footer pt-4 text-white  bg-primary-color pt-5">
            <div class="container text-center text-md-left text-sm-left">
                <div class="row" style="font-size: 20px;">
                    <div class="col-md-4 mt-md-0 mt-3">
                        <h5 class="footer-header text-white">Entre em Contato</h5>
                        <p>
                            Email: newtececo@gmail.com
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
        <script src="statics/js/jquery.js"></script>
        <script src="statics/js/bootstrap.js"></script>
        <script src="js/cart.js"></script>
    </body>
</html>
