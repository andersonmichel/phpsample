<?php

class User {
    private $data = [];
    public $fields = [
        'first_name' => 'Nome',
        'last_name'  => 'Sobrenome',
        'email'      => 'E-mail',
        'phone'      => 'Telefone',
        'username'   => 'Login',
        'password'   => 'Senha',
    ];
    public $rules = [
        'first_name' => [
            'required',
        ],
        'last_name' => [
            'required',
        ],
        'email' => [
            'required',
            'email',
            'unique',
        ],
        'phone' => [
            'required',
            'phone',
        ],
        'username' => [
            'required',
            'user',
            'unique',
        ],
        'password' => [
            'required',
            'password',
        ]
    ];
    private $file = 'registros.txt';
    private $users = [];

    public function __construct() {
        if ( ! file_exists( $this->file ) ) {
            return;
        }
        $this->check_users();
    }

    public function check_users() {
        $content = file_get_contents( $this->file );
        $this->users = (array) unserialize( $content );
    }

    public function add( $data ) {
        foreach ( $data as $field => $value ) {
            if ( ! array_key_exists( $field, $this->fields ) ) {
                continue;
            }
            if ( 'password' === $field ) {
                $value = sha1( $value );
            }
            $this->data[$field] = $value;
        }

        $data = array_merge( $this->users, [$this->data] );
        $put = file_put_contents( $this->file, serialize( $data ) );
        $this->check_users();

        if ( $put ) {
            return true;
        }

        return false;
    }

    function get_all() {
        $users = $this->users;
        krsort( $users );
        return $users;
    }
}