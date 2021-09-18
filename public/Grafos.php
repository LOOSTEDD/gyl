<?php
    require("administracion_datos.php");

    function crearmatriz($cantidad)
    {
        $arreglo=array();
        $matriz=array();
        for($i=0;$i<$cantidad;$i++)
        {
            array_push($arreglo,0);
        }

        for($i=0;$i<$cantidad;$i++)
        {
            array_push($matriz,$arreglo);
        }

        return $matriz;

    }

    function matriz_caminos($cantidad,$vertice_1,$vertice_2,$isdireccional)
    {
        $matriz=crearmatriz($cantidad);

        for($i=0;$i<count($vertice_1);$i++)
        {
            if($isdireccional)
            {
                $matriz[$vertice_1[$i]][$vertice_2[$i]]++;
            }
            else
            {
                $matriz[$vertice_2[$i]][$vertice_1[$i]]++;
                $matriz[$vertice_1[$i]][$vertice_2[$i]]++;
            }
        }
        echo('<br/>');
        print("Matriz de camino");
        mostrar_matriz($matriz,$cantidad);
        return $matriz;
        
    }

    function matriz_valoresA($cantidad,$vertice_1,$vertice_2,$aristas)
    {
        $matriz = crearmatriz($cantidad);
        //print(count($vertice_1));
        for($i=0;$i<count($vertice_1);$i++)
        {
            if($matriz[$vertice_1[$i]][$vertice_2[$i]] == 0 && $matriz[$vertice_2[$i]][$vertice_1[$i]] == 0)
            {
                $matriz[$vertice_1[$i]][$vertice_2[$i]]=$aristas[$i];
                $matriz[$vertice_2[$i]][$vertice_1[$i]]=$aristas[$i];
            }
        }
        print("Matriz con valores de la arista");
        mostrar_matriz($matriz,$cantidad);
    }

    function mostrar_matriz($matriz,$cantidad)
    {
        echo('<pre>');
        for($i=0;$i<$cantidad;$i++)
        {
            if($i==0)
            {
                echo "&nbsp&nbsp&nbsp";
            }
            echo "[$i] ";
        }
        
        echo('<pre>');
        
        for($i=0;$i<$cantidad;$i++)
        {
            echo "[$i]";
            for($j=0;$j<$cantidad;$j++)
            {
                echo "&nbsp";
                print_r($matriz[$i][$j]);
                echo "&nbsp&nbsp";
            }
            echo('<pre>');
        }
        echo('<br/>');
    }
    
  print_r (conexiones(matriz_caminos(Cantidaddenodos(),Get_Vertice_A(),Get_Vertice_B(),Isdireccional()),Cantidaddenodos()));
    
    function matriz_conexa($matriz,$cantidad)
    {
        $numerador = arreglo_simple($cantidad);
        for($i=0;$i<$cantidad;$i++)
        {
            $x=0;
            $y=0;
    
           while($x==0)
           {   
               
               $x = $matriz[$i][$numerador[$y]];
               
            

               
               if($x==0)
               {
                   $y++;
                   if($y == sizeof($numerador))
                   {    
                       
                       return false;
                     
                   }
                   
               }
               else
               {   
                   $numerador = quitar_array($numerador,$numerador[$y]);
                   
               }
           }
        }
        
       return true;
    }
    
    

  function arreglo_simple($cantidad)
  {
    $arreglo = array();
    for($i=0;$i<$cantidad;$i++) 
    {
        array_push($arreglo,$i);

    }
    return $arreglo;
  }

  function quitar_array($array,$valor)
  {
    $x=0;

    while($valor!=$array[$x]){
        $x++;
    }
    for($x;$x<sizeof($array)-1;$x++){
        $array[$x]=$array[$x+1];
    }
    unset($array[sizeof($array)-1]);
    return $array;
  }

  function camino($matriz,$A,$B,$cantidad)
  { 
    $conexiones = conexiones($matriz,$cantidad);
    $arreglo= array();
    for($i=0;$i<$cantidad;$i++)
    {

    }
      

  }

function conexiones($matriz,$cantidad)
{
    $conexiones = array();
      for($i=0;$i<$cantidad;$i++)
      { 
         array_push($conexiones,buscar_conexion($matriz,$i,$cantidad));

      }
 return $conexiones;
}

  function buscar_conexion($matriz,$A,$cantidad)
  {
      $conexiones = array();
      $x=0;
    while($x<$cantidad){
        if($matriz[$A][$x]==1){
            array_push($conexiones,$x);
        
        }
        $x++;

    }
    return $conexiones;
    }


    
?>