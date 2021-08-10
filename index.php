<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;


// echo '<pre>';
//     print_r($obUpload);
//     echo '</pre>'; exit;
if(isset($_FILES['arquivo'])) {
    $obUpload = new Upload($_FILES['arquivo']);

    $sucesso = $obUpload->Upload(__DIR__ . '/files', false);

    if($sucesso) {
        echo 'Arquivo enviado com sucesso';
        exit;
    }

    die('Problemas ao enviar o arquivo');

}

include __DIR__ . '/includes/formulario.php';