<?php
   use Illuminate\Foundation\Inspiring;
   use Illuminate\Support\Facades\Artisan;

    function lectura_A (){
        log::info("Lectura de archivo indicaciones.txt");
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
        log::info("Lectura de archivo matriz.txt");
        $fp = fopen ("matriz.txt","r");
        $i = 0 ;
        $datos = array();
        while (!feof($fp)){
            $linea = fgets($fp);
            array_push($datos,$linea);
        }
        
            return $datos;
    }
    function lectura_C (){
        log::info("Lectura de archivo nodos.txt");
        $fp = fopen ("nodos.txt","r");
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

        if(strlen($data[0])> 14){
            log::info("El grafo es direccional");
            
            return true;
        }
       else
        {
            log::info("El grafo no es direccional");
            
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
    function Get_Peso(){
        $aristas = getaristas(); 
        $tamano = sizeof($aristas);
        $data = array();
        for($i=0;$i<$tamano;$i++){ 
    
            array_push($data,$aristas[$i][2]);

         }
        return $data;

}


    function Get_tamano(){
        $aristas = getaristas(); 
        $tamano = sizeof($aristas);
        return $tamano;

    }


    function Get_Nodos()
    {
        $data  = lectura_C();
        $nodos= array();
        $cadena = "";
        $i=0;
        while($data[0][$i] != ',')
        {
           
            $cadena=$cadena.$data[0][$i];
            $i++;
        }
        array_push($nodos,intval($cadena));
        $cadenaB="";
        $i++;
        while($i<strlen($data[0]))
        {
        
            $cadenaB=$cadenaB.$data[0][$i];
            $i++;
        }
        array_push($nodos,intval($cadenaB));
        return $nodos;

    }



 
<<<<<<< HEAD

=======
>>>>>>> 338dd8aff1791d50ed6c349c5dbac43e2ef185e5
?>