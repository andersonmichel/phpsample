<?php

class Router {
    public $route = '/';

    function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ( isset( $_GET['route'] ) ) {
            $this->route = $_GET['route'];
        }
    }

    public function get( $route, $callback ) {
        if ( ! $this->is_get_method() ) {
            return;
        }

        if ( ! $this->is_current_route( $route ) ) {
            return;
        }

        $params = $this->get_params( $route );
        echo json_encode( $callback( $params ) );
        die;
    }

    public function post( $route, $callback ) {
        if ( ! $this->is_post_method() ) {
            return;
        }

        if ( ! $this->is_current_route( $route ) ) {
            return;
        }

        $data = $_POST;
        $params = $this->get_params( $route );
        echo json_encode( $callback( $data, $params ) );
        die;
    }

    public function is_current_route( $route ) {
        $parts_this = explode( '/', $this->route );
        $parts_curr = explode( '/', $route );

        if ( count( $parts_this ) != count( $parts_curr ) ) {
            return false;
        }
        
        foreach ( $parts_curr as $i => $part ) {
            $first = substr( $part, 0, 1 );
            if ( ':' === $first ) {
                continue;
            }
       
            if ( $part != $parts_this[$i] ) {
                return false;
            }
        }

        return true;
    }

    public function get_params( $route ) {
        $parts_this = explode( '/', $this->route );
        $parts_curr = explode( '/', $route );
        $params = [];
        foreach ( $parts_curr as $i => $part ) {
            $first = substr( $part, 0, 1 );
            if ( ':' === $first ) {
                $param = substr( $part, 1, strlen( $part ) - 1 );
                $params[$param] = $parts_this[$i];
            }
        }

        return $params;
    }

    public function is_get_method() {
        return $this->method == 'GET' ? true : false;
    }

    public function is_post_method() {
        return $this->method == 'POST' ? true : false;
    }
}