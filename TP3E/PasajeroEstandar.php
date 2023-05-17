<?php
include_once("Pasajero.php");
class pasajeroEstandar extends Pasajero{

    public function __construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket){
        parent::__construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket);
    }

    public function __toString(){
        return parent:: __toString();
    }

    //metoddo para dar porcentaje de incremento del importe
    public function darPorcentajeIncremento(){
        $incremento=10;
        return $incremento;
    }
}