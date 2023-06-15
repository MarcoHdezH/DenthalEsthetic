<?php

namespace Model;

class Servicio extends ActiveRecord{

    //Base de Datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id','nombre'];

    public $id;
    public $nombre;

    public function __construct($args=[]){
        
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
    }
}