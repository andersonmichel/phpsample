<?php

require_once 'functions.php';

$location = [];

$location[] = ['name' => 'EUA', 'capital' => 'Washington'];
$location[] = ['name' => 'Brasil', 'capital' => 'Brasília'];
$location[] = ['name' => 'Austrália', 'capital' => 'Sydney'];
$location[] = ['name' => 'Argentina', 'capital' => 'Buenos Aires'];
$location[] = ['name' => 'Portugal', 'capital' => 'Lisboa'];
$location[] = ['name' => 'México', 'capital' => 'Cidade do México'];

$location = array_sort( $location, 'capital', SORT_ASC );

foreach ( $location as $country ) {
    $name = $country['name'];
    $capital = $country['capital'];
    echo "A capital do país {$name} é {$capital}<br />\n";
}







