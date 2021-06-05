<?php 
require_once "class.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Exercício 06</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Exercício 06</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-2">
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Sample Form</h4>

                    <form class="needs-validation" novalidate="" method="post" action="">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="first_name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="first_name" placeholder="" name="first_name" value="" required="" style="">
                            </div>

                            <div class="col-sm-12">
                                <label for="last_name" class="form-label">Sobrenome</label>
                                <input type="text" class="form-control" id="last_name" placeholder="" name="last_name" value="" required="">
                            </div>

                            <div class="col-sm-12">
                            <?php
                                $select = new Select( 'Estado', 'estate' );
                                $select->add_option( 'São Paulo', 'SP' );
                                $select->add_option( 'Rio de Janeiro', 'RJ' );
                                $select->add_option( 'Minas Gerais', 'MG' );
                                $select->render();
                            ?>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Enviar</button>
                    </form>

                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">Teste CI & T</p>
        </footer>
    </div>
</body>
</html>
