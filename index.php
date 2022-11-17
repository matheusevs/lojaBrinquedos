<?php 
$host = ''; // host do seu banco de dados
$user = ''; // user do seu banco de dados
$pass = ''; // password do seu banco de dados
$data = 'loja'; // nome do database, conforme criado em migration

$conexao = mysqli_connect($host, $user, $pass);

if(!$conexao){
    header("Location: views/error/error.php?motivoErro=acessoBanco");
    die();
}


$conexaoDatabase = mysqli_select_db($conexao, $data);
if(!$conexaoDatabase){
    header("Location: views/error/error.php?motivoErro=database");
    die();
}

$sql = "
    SELECT
        nome as nomeBrinquedo,
        preco as preco,
        oferta as oferta,
        imagem as foto
    FROM
        itens;
";

$resultadoBrinquedos = mysqli_query($conexao, $sql);
if(!$resultadoBrinquedos){
    header("Location: views/error/error.php?motivoErro=semRegistros");
    die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <!-- Normalize CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/normalize.css">

        <!-- Estilo customizado-->
        <link rel="stylesheet" type="text/css" href="assets/css/estilo.css">
        <title>Brinquedos Infantil</title>
    </head>

    <body>
        <header><!-- Inicio do header -->
            <nav id="cabecalho" class="navbar navbar-expand-sm">
                <div class="container">
                    <a href="index.php" class="navbar-brand">
                        <img src="assets/img/index/logo.png" width="80px">
                    </a>
                </div>
            </nav><!-- Fim da Nav -->
        </header><!-- Fim do header -->

            <section class="py-5">
                
                <div class="display-3 text-center">Brinquedos</div>
                        <?php 
                            $count = 0;
                            while($rowBrinquedos = mysqli_fetch_array($resultadoBrinquedos)){ 
                                $count++;
                                if($count == 1 || $count == 5){ ?>

                                    <div class="container px-4 px-lg-5 mt-5">
                                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                                <?php } ?>

                                    <div class="col mb-5">
                                        <div class="card h-100">
                                            <!-- Product image-->
                                            <img class="card-img-top" src="<?php echo $rowBrinquedos['foto'] ?>" alt="..." />
                                            <!-- Product details-->
                                            <div class="card-body p-4">
                                                <div class="text-center">
                                                    <!-- Product name-->
                                                    <h5 class="fw-bolder"><?php echo $rowBrinquedos['nomeBrinquedo'] ?></h5>
                                                    <!-- Product price-->

                                                    <?php if($rowBrinquedos['oferta']){ ?>
                                                        <span class="text-muted text-decoration-line-through">R$<?php echo number_format($rowBrinquedos['preco'],2,',','.'); ?></span>
                                                        R$<?php echo $rowBrinquedos['oferta']; ?>
                                                    <?php 
                                                        } else {
                                                            echo 'R$'.number_format($rowBrinquedos['preco'],2,',','.');
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <!-- Product actions-->
                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                <div class="text-center"><a class="btn btn-outline-dark mt-auto carrinho" href="#">Comprar</a></div>
                                            </div>
                                        </div>
                                    </div>

                        <?php  } ?>
                   
            </section>


        <footer class="bg-dark p-4"><!-- Início do rodapé -->
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        <p class="text-light">&copy Kelle Cristina</p>
                    </div>

                    <div class="col-md-4 d-flex justify-content-end">
                        <a href="" class="btn btn-outline-light ml-2">
                            <i class="fab fa-facebook"></i>
                        </a>

                        <a href="" class="btn btn-outline-light ml-2">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="" class="btn btn-outline-light ml-2">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="" class="btn btn-outline-light ml-2">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer><!-- Fim do rodapé -->

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>