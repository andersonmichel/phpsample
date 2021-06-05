<?php

function val( $field ) {
    $val = isset( $_POST[$field] ) ? htmlentities( $_POST[$field] ) : '';
    echo $val;
}