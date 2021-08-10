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
    /**
     * Método responsável por retornar o nome do arquivo com sua extensão
     *
     * @return  [type]  [return description]
     */
    public function getBasename() {
        // Validar extensão
        $extension = strlen($this->extension) ? '.' . $this->extension : '';

        // Retornar nome completo
        return $this->name . $extension;
    }

    /**
     * Método responsável por mover o arquivo de upload
     *
     * @param   string  $dir 
     *
     * @return  boolean 
     */
    public function Upload($dir) {
        // Verificar error
        if($this->error != 0) return false;

        $path = $dir . '/' . $this->getBasename();

        // echo '<pre>';
        // print_r($path);
        // echo '</pre>'; exit;

        // Mover para a pasta de destino
        return move_uploaded_file($this->tmpName, $path);
            
    }
    
}