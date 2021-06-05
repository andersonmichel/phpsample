<?php

$files = [
    'music.mp4',
    'video.mov',
    'imagem.jpeg',
];

$extensions = array_map( function( $file ) {
    $parts = explode( '.', $file );
    $ext = end( $parts );
    return $ext;
}, $files );

sort( $extensions );

foreach ( $extensions as $extension ) {
    echo ".{$extension}<br />\n";
}
