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
        $this->admin=$args['admin'] ?? 0;
        $this->confirmado=$args['confirmado'] ?? 0;
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

        if(strlen($this->password)<6){
            self::$alertas['error'][]='La Contraseña debe tener al menos 6 Caracteres';
        }

        return self::$alertas;
    }

    //Busca coincidencias de Usuarios
    public function existeUsuario(){
        $query="SELECT * FROM ".self::$tabla." WHERE email='".$this->email."' LIMIT 1";
        $resultado = self::$db->query($query); 

        if($resultado->num_rows){
            self::$alertas['error'][]='Este Correo ya esta Registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token=uniqid();
    }


}