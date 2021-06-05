<?php

$filexml = 'products.xml';

if ( file_exists( $filexml ) )  {

    $xml = simplexml_load_file( $filexml );

    $filecsv = 'products.csv';
    $columns = [ 'Name', 'Category', 'Stock', 'Price' ];
    $fs = fopen( $filecsv, 'w' );
    fputcsv( $fs, $columns );

    $rows = $xml->xpath('//products[1]/*');
    foreach ( $rows as $row ) {           
        $fs = fopen( $filecsv, 'a' );
        fputcsv( $fs, (array) $row );
    }

    fclose( $fs );
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Exercício 05</title>
</head>
<body>
    <?php if ( file_exists( $filecsv ) ) : ?>
        <a href="<?php echo $filecsv; ?>"><?php echo $filecsv; ?></a>
    <?php else : ?>
        Não foi possível gerar o arquivo csv
    <?php endif; ?>
</body>
</html>
