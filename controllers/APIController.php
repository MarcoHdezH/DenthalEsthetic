<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{

    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){

        //Almacena la Cita
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        //Almacena Cita y Servicio

        $idServicios = explode(",",$_POST['servicios']);

        foreach($idServicios as $idServicio){
            $args = [
                'citaID'=> $id,
                'servicioID'=>$idServicio
            ];
            $CitaServicio = new CitaServicio($args);
            $CitaServicio->guardar();
        }
        
        echo json_encode(['resultado'=>$resultado]);
    }
}