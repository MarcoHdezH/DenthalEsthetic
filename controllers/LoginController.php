<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router){
        $router->render('auth/login');
    }

    public static function logout(){
        echo "Desde Logout";
    }

    public static function olvidar(Router $router){
        $router->render('auth/olvide-password',[]);
    }

    public static function recuperar(){
        echo "Desde Recuperar";
    }

    public static function crear(Router $router){

        $usuario = new Usuario;

        //Alertas
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] ==='POST'){

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar alertas

            if(empty($alertas)){

                //Verificar is Existe un Usuario
                $resultado=$usuario->existeUsuario();
        
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    
                    //Crear Usuario Nuevo
                    //TODO: Hashear Contraseña
                    $usuario->hashPassword();

                    //TODO: Crear Token de Usuario
                    $usuario->crearToken();

                    //TODO: Enviar Correo de Confirmacion:
                    $email = new Email($usuario->nombre,$usuario->apellido,$usuario->email,$usuario->token);

                    $email->enviarConfirmacion();

                    //Crear Usuario
                    // $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }

                }
            }

        }

        $router->render('auth/crear-cuenta',[
            'usuario'=>$usuario,
            'alertas'=>$alertas,
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }
}