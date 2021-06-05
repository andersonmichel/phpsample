<?php

class Validator {
    private $errors = [];

    public function validate( $rules, $data, $labels ) {

        foreach ( $rules as $field => $rules_ ) {
            if ( ! isset( $data[$field] ) ) {
                continue;
            }

            $value = $data[$field];

            foreach ( $rules_ as $rule ) {
                if ( ! method_exists( $this, '_' . $rule ) ) {
                    continue;
                }

                $method_name_rule = "_{$rule}";
                $method_name_error = "_{$rule}_error";
                if ( ! $this->{$method_name_rule}( $value, $field ) ) {
                    $this->errors[] = $this->{$method_name_error}( $labels[$field] );
                    continue 2;
                }
            }
        }
    }

    public function is_valid() {
        return empty( $this->errors ) ? true : false;
    }

    public function get_errors() {
        return $this->errors;
    }

    public function set_labels( $labels ) {
        $this->labels = $labels;
    }

    private function _required( $value ) {
        return ( ! empty( trim( $value ) ) ) ? true : false;
    }

    private function _required_error( $field ) {
        return "O campo {$field} é obrigatório";
    }

    private function _email( $value ) {
        return filter_var( $value, FILTER_VALIDATE_EMAIL ) ? true : false;
    }

    private function _email_error( $field ) {
        return "O campo {$field} deve ser um e-mail válido";
    }

    private function _phone( $value ) {
        return preg_match('/^\([0-9]{2}\) [0-9]?[0-9]{4}-[0-9]{4}$/', $value ) ? true : false;
    }

    private function _phone_error( $field ) {
        return "O campo {$field} deve ter o formato (99) 99999-9999";
    }

    private function _user( $value ) {
        return preg_match('/^\w{5,}$/', $value ) ? true : false;
    }

    private function _user_error( $field ) {
        return "O Login deve ser alfanumérico com no mínimo 5 caracteres";
    }

    private function _unique( $value, $field ) {
        $file = 'registros.txt'; 

        if ( ! file_exists( $file ) ) {
            return true;
        }

        $content = file_get_contents( $file );
        $users = (array) unserialize( $content );

        $valid = true;
        foreach ( $users as $user ) {
            if ( $user[$field] === $value ) {
                $valid = false;
                break;
            }
        }
        
        return $valid;
    }

    private function _unique_error( $field ) {
        return "O campo {$field} deve ser único. O valor que você informou já se encontra em uso";
    }

    private function _password( $value ) {
        return strlen( trim( $value ) ) >= 5 ? true : false;
    }

    private function _password_error( $field ) {
        return "A senha deve ter no mínimo 5 caracteres";
    }
}