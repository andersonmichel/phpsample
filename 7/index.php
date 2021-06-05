<?php

require_once 'Router.php';
require_once 'User.php';

$router = new Router();
$user = new User();

$router->get('/users', function ( $params ) {
    global $user;
    return ['data' => $user->get_all()];
});

$router->post('/users/add', function ( $data, $params ) {
    global $user;
    if ( $user->add( $data ) ) { 
        return ['success' => 'Usuário inserido'];
    }
    return ['error' => 'Usuário não inserido'];
});

$router->post('/users/:email/update', function ( $data, $params ) {
    global $user;
    if ( $user->update( $data, $params['email'] ) ) { 
        return ['success' => 'Usuário alterado'];
    }
    return ['error' => 'Usuário não alterado'];
});

$router->post('/users/:email/delete', function ( $data, $params ) {
    global $user;
    if ( $user->delete( $data, $params['email'] ) ) { 
        return ['success' => 'Usuário excluído'];
    }
    return ['error' => 'Nenhum usuário excluído'];
});