<?php

function foiMordido() {
    $number = rand( 0, 999 );
    return $number % 2 == 0 ? true : false;
}

if ( foiMordido() ) {
    echo 'Joãozinho mordeu o seu dedo !';
} else {
    echo 'Joãozinho NÃO mordeu o seu dedo !';
}
