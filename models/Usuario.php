<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla='usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    //Constructor
    public function __construct($args = []){
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->admin=$args['admin'] ?? null;
        $this->confirmado=$args['confirmado'] ?? null;
        $this->token=$args['token'] ?? '';
    }

    //Mensajes de Validacion de Creacion de Cuentas
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][]='Tu nombre es Obligatorio';
        }

        if(!$this->apellido){
            self::$alertas['error'][]='Tu Apellido es Obligatorio';
        }

        if(!$this->telefono){
            self::$alertas['error'][]='Tu Teléfono es Obligatorio';
        }

        if(!$this->email){
            self::$alertas['error'][]='Tu Correo es Obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][]='Tu Contraseña es Obligatoria';
        }

        return self::$alertas;
    }


}