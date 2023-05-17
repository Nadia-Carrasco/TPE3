<?php
include_once("Pasajero.php");
class PasajeroVip extends Pasajero{
    private $numViajeroF;
    private $cantMillas;

    public function __construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket,$numViajeroF,$cantMillas){
        parent:: __construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket);
        $this->numViajeroF=$numViajeroF;
        $this->cantMillas=$cantMillas;
    }

    public function getNumViajeroF(){
        return $this->numViajeroF;
    }
    public function setNumViajeroF($numViajeroF){
        $this->numViajeroF=$numViajeroF;
    }

    public function getCantMillas(){
        return $this->cantMillas;
    }
    public function setCantMillas($cantMillas){
        $this->cantMillas=$cantMillas;
    }

    public function __toString(){
        $cadena=parent:: __toString();
        $cadena=$cadena."Nro Viajero Frecuente: ".$this->getNumViajeroF()."\n Cantidad de Millas: ".$this->getCantMillas()."\n";
        return $cadena;
    }

    public function darPorcentajeIncremento(){
        $incremento=0;
        $cantMillas=$this->getCantMillas();
        if($cantMillas>300){
            $incremento=30;
        }else{
            $incremento=35;
        }
        return $incremento;
    }

}