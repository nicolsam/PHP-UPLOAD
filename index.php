<?php

require __DIR__ . '/vendor/autoload.php';

use \App\File\Upload;

if(isset($_FILES['arquivo'])) {
    $obUpload = new Upload($_FILES['arquivo']);

    echo '<pre>';
    print_r($obUpload);
    echo '</pre>'; exit;
}

include __DIR__ . '/includes/formulario.php';