<?php 

require_once "helper.php";
require_once "User.php";
require_once "Validator.php";

$user = new User();
$validator = new Validator();

if ( isset( $_POST ) && ! empty( $_POST ) ) {
    $validator->validate( $user->rules, $_POST, $user->fields );
    if ( $validator->is_valid() ) {
        if ( $user->add( $_POST ) ) {
            $success = true;
        }
        foreach ( $_POST as $field => $value ) {
            unset( $_POST[$field] );
        }
    } else {
        $errors = $validator->get_errors();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Exercício 04</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Exercício 04</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-2">
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Cadastro</h4>

                    <?php if ( isset( $success ) ) : ?>
                    <div class="alert alert-success" role="alert">
                        Registro inserido com sucesso!
                    </div>
                    <?php endif; ?>

                    <?php if ( isset( $errors ) ) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ( $errors as $error ) : ?>
                            <?php echo $error ?><br />
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <form class="needs-validation" novalidate="" method="post" action="">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="first_name" class="form-label">Nome*</label>
                                <input type="text" class="form-control" id="first_name" placeholder="" name="first_name" value="<?php val( 'first_name' ) ?>" required="" style="">
                            </div>

                            <div class="col-sm-6">
                                <label for="last_name" class="form-label">Sobrenome*</label>
                                <input type="text" class="form-control" id="last_name" placeholder="" name="last_name" value="<?php val( 'last_name' ) ?>" required="">
                            </div>

                            <div class="col-sm-6">
                                <label for="email" class="form-label">E-mail*</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php val( 'email' ) ?>" placeholder="voce@exemplo.com" required="" style="">
                            </div>

                            <div class="col-sm-6">
                                <label for="phone" class="form-label">Telefone*</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="(99) 99999-9999" value="<?php val( 'phone' ) ?>" required="">
                            </div>

                            <div class="col-sm-6">
                                <label for="username" class="form-label">Login*</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Nome de usuário" value="<?php val( 'username' ) ?>" required="">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="password" class="form-label">Senha*</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="" value="<?php val( 'password' ) ?>" required="">
                            </div>
                        </div>

                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Enviar</button>
                    </form>

                    <?php
                    $users = $user->get_all();
                    if ( ! empty( $users ) ) :
                    ?>
                    <h4 class="mb-3" style="margin-top: 50px">Usuários</h4>
                    <table class="table caption-top">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Login</th>
                            <th scope="col">Senha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ( $users as $i => $user ) :
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i + 1 ?></th>
                                <td><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                <td><?php echo $user['phone'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td><?php echo $user['password'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">Teste CI & T</p>
        </footer>
    </div>
</body>
</html>
