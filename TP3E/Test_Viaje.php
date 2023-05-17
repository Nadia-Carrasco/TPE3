<?php
include_once("Viaje.php");
include_once("PasajeroVip.php");
include_once("PasajeroEstandar.php");
include_once("PasajeroEspecial.php");
include_once("ResponsableV.php");


function menu(){
    echo " 1. Mostrar Datos Pasajeros "."\n"." 2. Mostrar Datos del Viaje "."\n"." 3. Mostrar Datos Responsable "."\n"." 4. Modificar Pasajero "."\n"." 5. Modificar Responsable "."\n". " 6. Modificar Viaje "."\n"." 7. Agregar Pasajero "."\n"." 8. Agregar Responsable "."\n"." 9. Salir"."\n"."Ingrese Opción: ";
    $opcion=trim(fgets(STDIN));
    return $opcion;
}
$objPasajero=[];
$objResponsable=[];
$objViaje= new Viaje(44,"Colombia",20,$objPasajero,$objResponsable,2300,0);


$responsable1=new ResponsableV(15,22,"Pepe","Mero");
$numLicencia=$responsable1->getNumLicencia();
$objViaje->agregarResponsable($responsable1,$numLicencia);



$pasajeroVip1=new PasajeroVip("Luis","Lopez",45001145,2994555542,1,1,1,301);
$porcentajeIncrementoVip=$pasajeroVip1->darPorcentajeIncremento();
$dniPasajeroVip=$pasajeroVip1->getNumDocu();
$seAgrego=$objViaje->agregarPasajero($pasajeroVip1,$dniPasajeroVip);
if($seAgrego){$ventaPasVip=$objViaje->venderPasaje($pasajeroVip1,$porcentajeIncrementoVip);}
//array_push($objPasajero,$pasajeroVip1);

$pasajeroEspecial1=new PasajeroEspecial("María","Merced",4545443,2994884659,2,2,3); //el ultimo param es la cant de servicios
$porcentajeIncrementoEspecial=$pasajeroEspecial1->darPorcentajeIncremento();
$dniPasajeroEspecial=$pasajeroEspecial1->getNumDocu();
$seAgrego=$objViaje->agregarPasajero($pasajeroEspecial1,$dniPasajeroEspecial);
if($seAgrego){$ventaPasEspecial=$objViaje->venderPasaje($pasajeroEspecial1,$porcentajeIncrementoEspecial);}
//array_push($objPasajero,$pasajeroEspecial1);

$pasajeroEstandar1=new PasajeroEstandar("Mía", "Vera",47115550,2994758562,3,3);
$porcentajeIncrementoEstandar=$pasajeroEstandar1->darPorcentajeIncremento();
$dniPasajeroEstandar=$pasajeroEstandar1->getNumDocu();
$seAgrego=$objViaje->agregarPasajero($pasajeroEstandar1,$dniPasajeroEstandar);
if($seAgrego){$ventaPasEstandar=$objViaje->venderPasaje($pasajeroEstandar1,$porcentajeIncrementoEstandar);}
//array_push($objPasajero,$pasajeroEstandar1);


//array_push($objPasajero,$pasajeroVip1,$pasajeroEspecial1,$pasajeroEstandar1);
//$objViaje->setPasajeros($objPasajero);
//$objViaje= new Viaje(44,"Colombia",20,$objPasajero,$objResponsable,2300,0);

$opcion=menu();

do{
    switch($opcion){
        case 1:
            echo $objViaje->mostrarDatosPasajeros();
    
            $opcion=menu();
            break;
        case 2:
            
            echo $objViaje;
            $opcion=menu();
            break;
        case 3:
            echo $objViaje->mostrarDatosResponsables();
            $opcion=menu();
            break;
        case 4:
            echo "Ingrese Número de Documento para Modificar Pasajero: ";
            $numDocuPas=trim(fgets(STDIN));
            $indice=$objViaje->buscarPasajero($numDocuPas);
            if($indice>=0){
                echo "Nombre Pasajero: ";
                $nombrePas=trim(fgets(STDIN));
                echo "Apellido Pasajero: ";
                $apellidoPas=trim(fgets(STDIN));
                echo "Teléfono: ";
                $telefonoPas=trim(fgets(STDIN));
                echo "Número Documento: ";
                $numDocu=trim(fgets(STDIN));

                $result=$objViaje->modificarPasajero($indice,$nombrePas,$apellidoPas,$telefonoPas,$numDocu);
                if($result){
                    echo "Modificado. "."\n";
                }
            }else{
                echo "El pasajero NO se encontró en el viaje "."\n";
            }
            $opcion=menu();
            break;
        case 5:
            echo "Ingrese Número de Licencia para modificar Responsable: ";
            $numR=trim(fgets(STDIN));
            $indice=$objViaje->buscarResponsable($numR);
            if($indice>=0){
                echo "Número Empleado: ";
                $numEmpleado=trim(fgets(STDIN));
                echo "Número Licencia: ";
                $numLicencia=trim(fgets(STDIN));
                echo "Nombre: ";
                $nombre=trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido=trim(fgets(STDIN));

                $result=$objViaje->modificarResponsable($indice,$numEmpleado,$numLicencia,$nombre,$apellido);
                if($result){
                    echo "Modificado. "."\n";
                }
            }else{
                echo "El Responsable no se encontró. "."\n";
            }
            $opcion=menu();
            break;
        case 6:
                echo "Nuevo Codigo: ";
                $nuevoCodigo=trim(fgets(STDIN));
                echo "Nuevo Destino: ";
                $nuevoDestino=trim(fgets(STDIN));
                echo "Cant Max de Pasajeros: ";
                $cantMaxPas=trim(fgets(STDIN)); 
                $objViaje->modificarViaje($nuevoCodigo,$nuevoDestino,$cantMaxPas);

            $opcion=menu();
            break;
        case 7:
            do{
                echo "\n 1. Pasajero VIP."."\n 2.Pasajero Especial. "."\n 3.Pasajero Estándar. "."\n 4. Salir."."\n Ingrese Opción: ";
                $opcionPasajero=trim(fgets(STDIN));
            }while($opcionPasajero==4);
            $hayLugar=$objViaje->hayPasajesDisponible();
            if($hayLugar && $opcionPasajero<4){
                    echo "Número Documento: ";
                    $numDocuNuevo=trim(fgets(STDIN));
                    $indice=$objViaje->buscarPasajero($numDocuNuevo);
                    if($indice<0){
                        echo "Ingrese Nombre: ";
                        $nombreNuevo=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellidoNuevo=trim(fgets(STDIN));
                        echo "Número Teléfono: ";
                        $numTelNuevo=trim(fgets(STDIN));
                        echo "Ingrese Nro Asiento: ";
                        $numAsientoNuevo=trim(fgets(STDIN));
                        echo "Ingrese Nro Ticket: ";
                        $numTicketNuevo=trim(fgets(STDIN));

                        if($opcionPasajero==1){
                            echo "Ingrese Nro Viajero Frecuente: ";
                            $numViajeroFNuevo=trim(fgets(STDIN));
                            echo "Ingrese Cantidad de Millas: ";
                            $cantMillasNuevo=trim(fgets(STDIN));
                            $nuevoPasajero=new PasajeroVip($nombreNuevo,$apellidoNuevo,$numDocuNuevo,$numTelNuevo,$objResponsable,$numAsientoNuevo,$numTicketNuevo,$numViajeroFNuevo,$cantMillasNuevo);
                            $objViaje->agregarPasajero($nuevoPasajero,$objPasajero);
                        }elseif($opcionPasajero==2){
                            echo "Ingrese Cantidad de Servicios que querrá: ";
                            $cantServicio=trim(fgets(STDIN));
                            $nuevoPasajero=new PasajeroEspecial($nombreNuevo,$apellidoNuevo,$numDocuNuevo,$numTelNuevo,$objResponsable,$numAsientoNuevo,$numTicketNuevo,$cantServicio);
                            $objViaje->agregarPasajero($nuevoPasajero,$objPasajero);
                        }else{
                            $nuevoPasajero=new PasajeroEstandar($nombreNuevo,$apellidoNuevo,$numDocuNuevo,$numTelNuevo,$objResponsable,$numAsientoNuevo,$numTicketNuevo);
                            $objViaje->agregarPasajero($nuevoPasajero,$objPasajero);
                        }
                        
                        
                    }else{
                        echo "Pasajero Ya Ingresado"."\n";
                    }
            }
            $opcion=menu();
            break;
        case 8:
           echo "Número de Licencia: ";
           $numLicencia=trim(fgets(STDIN));
           $indice=$objViaje->buscarResponsable($numLicencia);
           if($indice<0){
                echo "Número de Empleado: ";
                $numEmpleado=trim(fgets(STDIN));
                echo "Nombre: ";
                $nombre=trim(fgets(STDIN));
                echo "Apellido: ";
                $apellido=trim(fgets(STDIN));
                $nuevoRespo=new ResponsableV($numEmpleado,$numLicencia,$nombre,$apellido);
                $objViaje->agregarResponsable($nuevoRespo,$numLicencia);
            }else{
                echo "Responsable ya ingresado. "."\n";
            }
            $opcion=menu();
            break;
    }
}while($opcion!=9);
