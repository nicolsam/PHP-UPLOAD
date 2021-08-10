<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;


// echo '<pre>';
//     print_r($obUpload);
//     echo '</pre>'; exit;
if(isset($_FILES['arquivo'])) {
    // Instância de Upload
    $obUpload = new Upload($_FILES['arquivo']);

    // Gera um nome aleatório para o arquivo
    $obUpload->generateNewName();

    // Move os arquivos de upload
    $sucesso = $obUpload->Upload(__DIR__ . '/files', false);

    if($sucesso) {
        echo 'Arquivo <strong>' . $obUpload->getBasename() . '<string> enviado com sucesso';
        exit;
    }

    die('Problemas ao enviar o arquivo');

}

include __DIR__ . '/includes/formulario.php';