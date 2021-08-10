<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;


// echo '<pre>';
//     print_r($obUpload);
//     echo '</pre>'; exit;

if(isset($_FILES['arquivo'])) {

    $uploads = Upload::createMultiUpload($_FILES['arquivo']);

    foreach($uploads as $obUpload) {
        // Gera um nome aleatório para o arquivo
        $obUpload->generateNewName();

        // Move os arquivos de upload
        $sucesso = $obUpload->Upload(__DIR__ . '/files', false);

        if($sucesso) {
            echo 'Arquivo <strong>' . $obUpload->getBasename() . '</strong> enviado com sucesso! </br>';
            continue;
        }

        echo 'Problemas ao enviar o arquivo </br>';
    }
    // // Instância de Upload
    // $obUpload = new Upload($_FILES['arquivo']);



    // die('Problemas ao enviar o arquivo');

}

include __DIR__ . '/includes/formulario-multi.php';