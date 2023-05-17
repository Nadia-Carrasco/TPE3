<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxPas;
    private $pasajeros;//OBJ pasajero
    private $responsable; //OBJ responsable
    private $costoViaje;
    private $sumaCostoViaje;

    public function __construct($codigo,$destino,$cantMaxPas,$pasajeros,$responsable,$costoViaje,$sumaCostoViaje){
        $this->codigo=$codigo;
        $this->destino=$destino;
        $this->cantMaxPas=$cantMaxPas;
        $this->pasajeros=$pasajeros;
        $this->responsable=$responsable;
        $this->costoViaje=$costoViaje;
        $this->sumaCostoViaje=$sumaCostoViaje;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }
    Public function getDestino(){
        return $this->destino;
    }
    public function setDestino($destino){
        $this->destino=$destino;
    }
    public function getCantMaxPas(){
        return $this->cantMaxPas;
    } 
    public function setCantMaxPas($cantMaxPas){
        $this->cantMaxPas=$cantMaxPas;
    }
    public function getPasajeros(){
        return $this->pasajeros;
    }
    public function setPasajeros($pasajeros){
        $this->pasajeros=$pasajeros;
    }

    public function getResponsable(){
        return $this->responsable;
    }
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }
   
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function setCostoViaje($costoViaje){
        $this->costoViaje=$costoViaje;
    }

    public function getSumaCostoViaje(){
        return $this->sumaCostoViaje;
    }
    public function setSumaCostoViaje($sumaCostoViaje){
        $this->sumaCostoViaje=$sumaCostoViaje;
    }
    
    public function __toString(){
        return "\n Importe Viaje: ".$this->getCostoViaje()."\n Suma de los costos abonados: ".$this->getSumaCostoViaje()."\n Código: " . $this->getCodigo() . "\n Destino: " . $this->getDestino() . "\n Cantidad Max de Pasajeros: " . $this->getCantMaxPas() . "\n Pasajeros: "."\n".$this->mostrarDatosPasajeros()."\n Responsable: "."\n".$this->mostrarDatosResponsables();
    }


    public function mostrarDatosPasajeros(){
        
        $objPasajero=$this->getPasajeros();
        $cadena="";
        for($i=0; $i<count($objPasajero); $i++){
            $objPas=$objPasajero[$i];
            $cadena=$cadena.$objPas->__toString();
            
        }
        return $cadena;

    }
    

    public function buscarPasajero($dni){
        $colPasajeros=$this->getPasajeros();
        $i=0;
        $encontro=false;
        while($i<count($colPasajeros) && !$encontro){
            $encontro=$colPasajeros[$i]->getNumDocu()==$dni;
            $i++;
        }
        if($encontro==false){
            $i=-1;
        }
        return $i-1; 
    }

    
    public function modificarPasajero($indice,$nombre,$apellido,$telefono,$numDocu){
        
        $modifico=false;
        if($indice>=0){
            $colPasajeros=$this->getPasajeros();
            $colPasajeros[$indice]->setNombre($nombre);
            $colPasajeros[$indice]->setApellido($apellido);
            $colPasajeros[$indice]->setTelefono($telefono);
            $colPasajeros[$indice]->setNumDocu($numDocu);
            $modifico=true;
        }
        return $modifico;
    }
   
    public function agregarPasajero($objPas,$dni){
        $colPasajeros=$this->getPasajeros();
        echo $existe=$this->buscarPasajero($dni);
        $seAgrego=false;
        if($existe<0){
            $colPasajeros[]= $objPas;
            print_r($colPasajeros);
            $this->setPasajeros($colPasajeros);
            echo count($colPasajeros);
            $seAgrego=true;
        }
        return $seAgrego;
    }

    public function agregarResponsable($objRes,$numLicencia){
        $colResponsable=$this->getResponsable();
        $existe=$this->buscarResponsable($numLicencia);
        $seAgrego=false;
        if($existe<0){
            array_push($colResponsable,$objRes);
           $this->setResponsable($colResponsable);
           $seAgrego=true;
        }
       return $seAgrego;
    }
    public function buscarResponsable($numLicencia){
        $colResponsable=$this->getResponsable();
        $encontro=false;
        $i=0;
        while($i<count($colResponsable) && !$encontro){
            $encontro=$colResponsable[$i]->getNumLicencia()==$numLicencia;
            $i++;
        }
        if(!$encontro){
            $i=-1;
        }
        return $i-1;
    }

    public function mostrarDatosResponsables(){
        $objResponsable=$this->getResponsable();
        print_r($objResponsable);
        $cadena="";
        for($i=0; $i<count($objResponsable); $i++){
            $objRes=$objResponsable[$i];
            $cadena=$cadena.$objRes->__toString();
        }
        return $cadena;
    }

    public function modificarResponsable($indice,$numEmpleado,$numLicencia,$nombre,$apellido){
        $colResponsable=$this->getResponsable();
        $modifico=false;
        if($indice>=0){
            $colResponsable[$indice]->setNumEmpleado($numEmpleado);
            $colResponsable[$indice]->setNumLicencia($numLicencia);
            $colResponsable[$indice]->setNombre($nombre);
            $colResponsable[$indice]->setApellido($apellido);
            $modifico=true;  
        }
        return $modifico;
    }

    public function modificarViaje($codigo,$destino,$cantMaxPas){
       $this->setCodigo($codigo);
       $this->setDestino($destino);
       $this->setCantMaxPersona($cantMaxPas);
    }
    //metoddo para incorporar pasajero y actualizar costos abonados y retornar el costo final que debera ser abonado por el pasajero
    public function venderPasaje($objPas,$porcentajeIncremento){
        $pasajeDispo=$this->hayPasajesDisponible();
        $colPas=$this->getPasajeros();
        $costosAbonados=$this->getSumaCostoViaje();
        $costoImporte=$this->getCostoViaje();
        $costoConIncremento=0;
        if($pasajeDispo){
            $costoConIncremento=($costoImporte)+($costoImporte*$porcentajeIncremento/100);
            $nuevoCostoAbonado=$costosAbonados+$costoConIncremento;
            $this->setSumaCostoViaje($nuevoCostoAbonado);
        }
        return $costoConIncremento;
    }

    public function hayPasajesDisponible(){
        $hay=false;
        $cantMaxPas=$this->getCantMaxPas();
        $colPas=$this->getPasajeros();
        $cantPas=count($colPas);
        if($cantPas<$cantMaxPas){
            $hay=true;
        }
        return $hay;
    }

}