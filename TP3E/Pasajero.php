<?php
class Pasajero{
    private $nombre;
    private $apellido;
    private $numDocu;
    private $telefono;
    private $numAsiento;
    private $numTicket; //del pasaje del viaje

    //se crean los objts con el metodo constructor 
    public function __construct($nombre,$apellido,$numDocu,$telefono,$numAsiento,$numTicket){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->numDocu=$numDocu;
        $this->telefono=$telefono;
        $this->numAsiento=$numAsiento;
        $this->numTicket=$numTicket;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function getNumDocu(){
        return $this->numDocu;
    }
    public function setNumDocu($numDocu){
        $this->numDocu=$numDocu;
    }

    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    public function getNumAsiento(){
        return $this->numAsiento;
    }
    public function setNumAsiento($numAsiento){
        $this->numAsiento=$numAsiento;
    }

    public function getNumTicket(){
        return $this->numTicket;
    }
    public function setNumTicket($numTicket){
        $this->numTicket=$numTicket;
    }

    public function __toString(){
        return "Nombre del Pasajero: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."Número Documento: ".$this->getNumDocu()."\n"."Teléfono: ".$this->getTelefono()."\n Nro Asiento: ".$this->getNumAsiento()."\n Nro Ticket: ".$this->getNumTicket()."\n";
    }    

}