<?php
include_once("Pasajero.php");
class PasajeroEspecial extends Pasajero{
    private $servicio;
    public function __construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket,$servicio){
        parent::__construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket);
        $this->servicio=$servicio;
    }

    public function getServicio(){
        return $this->servicio;
    }
    public function setServicio($servicio){
        $this->servicio=$servicio;
    }

    public function __toString(){
        return parent:: __toString();
    }

    public function darPorcentajeIncremento(){
        $cantServicio=$this->getServicio();
        $incremento=15; //si solo quiere un servicio
        if($cantServicio>1){ 
            $incremento=30; //si quiere mas de un servicio
        }
        return $incremento;
    }
}