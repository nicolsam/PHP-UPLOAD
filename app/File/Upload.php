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
     * Contador de duplicação de arquivo
     *
     * @var integer
     */
    private $duplicates = 0;

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
     * Método responsável por mover o arquivo de upload
     *
     * @param   string  $dir 
     * @param   boolean $overwrite
     * @return  boolean 
     */
    public function Upload($dir, $overwrite = true) {
        // Verificar error
        if($this->error != 0) return false;

        $path = $dir . '/' . $this->getPossibleBasename($dir, $overwrite);

        // Mover para a pasta de destino
        return move_uploaded_file($this->tmpName, $path);     
    }

    /**
     * Método responsável por alterar o nome do arquivo
     *
     * @param   string  $name
     *
     */
    public function setName($name) {
        $this->name = name;
    }

    /**
     * Método responsável por gerar um novo nome aleatório
     */
    public function generateNewName() {
        $this->name = time() . '-' . rand(100000, 999999) . '-' . uniqid();
    }

    /**
     * Método responsável por retornar o nome do arquivo com sua extensão
     *
     * @return  [type]  [return description]
     */
    public function getBasename() {
        // Validar extensão
        $extension = strlen($this->extension) ? '.' . $this->extension : '';

        // Validar duplicação
        $duplicates = $this->duplicates > 0 ? '-' . $this->duplicates : '';

        // Retornar nome completo
        return $this->name . $duplicates . $extension;
    }

    /**
     * Método responsável por obter um nome possível para o arquivo
     *
     * @param   string  $dir       
     * @param   boolean  $overwrite  
     *
     * @return  string             
     */
    private function getPossibleBasename($dir, $overwrite) {
        // Sobrescrever arquivo
        if($overwrite) return $this->getBasename();

        // Não pode sobrescrever arquivos
        $basename = $this->getBasename();

        // Verificar duplicação
        if(!file_exists($dir . '/' . $basename)) {
            return $basename;
        }

        // Incrementar duplicação
        $this->duplicates++;

        // Retornar o próprio método
        return $this->getPossibleBasename($dir, $overwrite);
    }
    
}