<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    //TODO: Validar Inicio de Sesion
    public static function login(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas=$auth->validarLogin();

            if(empty($alertas)){
                //Comprobar si Existe Usuario
                $usuario = Usuario::where('email',$auth->email);

                if($usuario){
                    //Verificar Contraseña
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //TODO: Inicio de Sesion de Usuario
                        session_start();
                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;

                        //Redireccionamiento (Administrador o Usuario Normal)
                        if($usuario->admin === "1"){
                            $_SESSION['admin']=$usuario->admin ?? null;
                            header('Location: /cita');
                        }else{
                            header('Location: /cita');
                        }
                    }

                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            'alertas'=>$alertas
        ]);
    }

    //Cerrar Sesion de Usuario
    public static function logout(){
        echo "Desde Logout";
    }

    public static function olvidar(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD']==='POST'){
            $auth = new Usuario($_POST);
            $alertas=$auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);

                if($usuario && $usuario->confirmado ==="1"){
                    $usuario->crearToken();
                    $usuario->guardar();

                    //TODO: Enviar Email de Resstablecer Contraseña

                    $email = new Email($usuario->nombre,$usuario->apellido,$usuario->email,$usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito','Revisa tu correo electronico');
                }else{
                    Usuario::setAlerta('error','El usuario no Existe o no esta Confirmado');
                }
            }
        }

        $alertas=Usuario::getAlertas();

        $router->render('auth/olvide-password',[
            'alertas'=>$alertas
        ]);
    }

    public static function recuperar(){
        echo "Desde Recuperar";
    }

    //Crea un nuevo Usuario
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
                    $resultado = $usuario->guardar();
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

    public static function confirmar(Router $router){
        $alertas=[];

        $token= s($_GET['token']);

        $usuario= Usuario::where('token',$token);

        if(empty($usuario)){
            Usuario::setAlerta('error','Token de Registro no Valido');
        }else{
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Registro Completado Exitosamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta',[
            'alertas'=>$alertas
        ]);
    }
}