<?php
   
    function lectura_A (){
        $fp = fopen ("indicaciones.txt","r");
        $i = 0 ;
        $datos = array();
        while (!feof($fp)){
            $linea = fgets($fp);
            array_push($datos,$linea);
        }
        
            return $datos;
    }
    function lectura_B (){
        $fp = fopen ("matriz.txt","r");
        $i = 0 ;
        $datos = array();
        while (!feof($fp)){
            $linea = fgets($fp);
            array_push($datos,$linea);
        }
        
            return $datos;
    }

    function Isdireccional(){
        $data = lectura_A();

        if(strlen($data[0])> 13){
            
            return true;
        }
       else
        {
            
            return false;
        }
    }


    function Cantidaddenodos()
    {
        $data = lectura_A();
        $numbers= "";
        $caracter = (strlen($data[1]))-1; 
        for($i=7;$i<$caracter;$i++)
        {
           $numbers= $numbers.$data[1][$i];
        }
    
        $IVAL = intval($numbers);
        return $IVAL;
    }

    function getaristas(){
        $data = lectura_B();
        $aristas = array();
        $valor_aristas = array();
        $cantidad_nodos = sizeof($data);
        for ($i=0;$i<$cantidad_nodos-1;$i++){
            $arista = Manejostring($data[$i]);
            array_push($aristas,$arista);
            

        }
            return $aristas; 
    }


    function Manejostring($cadena)
    {
        $cantidad =strlen($cadena);
        $data = array();
        $result ="";
        $i =0;
        while($cadena[$i]!=','){
                $result= $result.$cadena[$i];
                $i++;
            }
            $num =intval($result);
            array_push($data,$num);
            $i++;
            $result = "";

        while($cadena[$i]!=' '){
                $result= $result.$cadena[$i];
                
                $i++;
            }
            $num =intval($result);
            array_push($data,$num);
            $result = "";
            

        while($i<$cantidad-1){
                $result= $result.$cadena[$i];
                $i++;
            }
            $num =intval($result);
            array_push($data,$num);
            return $data;
    }

    

function Get_Vertice_A(){
    $aristas = getaristas(); 
    $tamano = sizeof($aristas);
    $data = array();
    for($i=0;$i<$tamano;$i++){ 
        array_push($data,$aristas[$i][0]);

    }
    return $data;

}

function Get_Vertice_B(){
    $aristas = getaristas(); 
    $tamano = sizeof($aristas);
    $data = array();
    for($i=0;$i<$tamano;$i++){ 
    
        array_push($data,$aristas[$i][1]);

    }
    return $data;

}


function Get_tamano(){
    $aristas = getaristas(); 
    $tamano = sizeof($aristas);
    return $tamano;

}








?>