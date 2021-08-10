<?php

namespace App\File;

class Upload {
    /**
     * Nome do arquivo (sem extensão)
     *
     * @var string
     */
    private $name;

    /**
     * EXtensão do arquivo (sem ponto)
     *
     * @var string
     */
    private $extension;

    /**
     * Type do arquivo
     *
     * @var string
     */
    private $type;

    /**
     * Nome temporário/caminho temporário do arquivo
     *
     * @var string
     */
    private $tmpName;

    /**
     * Código de error do upload
     *
     * @var integer
     */
    private $error;

    /**
     * Tamanho do arquivo
     *
     * @var integer
     */
    private $size;

    /**
     * Construtor da classe
     *
     * @param   array  $file  $_FILES[campo]
     *
     * @return  [type]         [return description]
     */
    public function __construct($file) {
        $this->type    = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error   = $file['error'];
        $this->size    = $file['size'];

        $info = pathinfo($file['name']);

        $this->name      = $info['filename'];
        $this->extension = $info['extension'];
    }
}