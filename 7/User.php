<?php

class User {
    private $data = [];
    public $fields = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];
    private $file = 'registros.txt';
    private $users = [];

    public function __construct() {
        if ( ! file_exists( $this->file ) ) {
            return;
        }
        $this->refresh_user_list();
    }

    public function refresh_user_list() {
        $content = file_get_contents( $this->file );
        if ( ! empty( $content ) ) {
            $this->users = (array) unserialize( $content );
        }
    }

    public function add( $data ) {
        if( ! $this->is_input_valid( $data ) ) {
            return false;
        }

        $data = array_merge( $this->users, [$this->data] );
        $put = file_put_contents( $this->file, serialize( $data ) );
        $this->refresh_user_list();

        if ( $put ) {
            return true;
        }

        return false;
    }

    public function update( $data, $email ) {
        if( ! $this->is_input_valid( $data ) ) {
            return false;
        }

        foreach ( $this->users as $i => $user ) {
            if ( $user['email'] == $email ) {
                $update = $i;
            }
        }

        if ( isset( $update ) ) {
            $data = $this->users;
            $data[$update] = $this->data;
            $put = file_put_contents( $this->file, serialize( $data ) );
            $this->refresh_user_list();

            if ( $put ) {
                return true;
            }
        }

        return false;
    }

    public function delete( $email ) {
        foreach ( $this->users as $i => $user ) {
            if ( $user['email'] == $email ) {
                $delete = $i;
            }
        }

        if ( isset( $delete ) ) {
            $data = $this->users;
            unset( $data[$delete] );
            $put = file_put_contents( $this->file, serialize( $data ) );
            $this->refresh_user_list();

            if ( $put ) {
                return true;
            }
        }

        return false;
    }

    function get_all() {
        $users = $this->users;
        krsort( $users );
        
        return $users;
    }

    function is_input_valid( $data ) {
        foreach ( $data as $field => $value ) {
            if ( ! in_array( $field, $this->fields ) ) {
                continue;
            }
            
            $this->data[$field] = $value;
        }

        foreach ( $this->fields as $field) {
            if ( ! array_key_exists( $field, $this->data ) ) {
                return false;
            }
        }

        return true;
    }
}