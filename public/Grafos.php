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
        
        if(matriz_conexa($matriz,$cantidad))
        {
            print("Es una matriz conexa");
        }
        else
        {
            print("No es una matriz conexa");
        }
        echo('<br/>');
        if(euleriano($matriz,$cantidad,$isdireccional))
        {
            print("Es euleriano");
            echo('<br/>');
            print("Camino euleriano: ");
            camino_euler($matriz,$cantidad);
        }
        else
        {
            print("No es eulerinano");

        }
        
    }

    matriz_caminos(5,[0,0,1,2,2,3,4],[1,4,2,3,0,0,2],true);

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
    
    //print_r (conexiones(matriz_caminos(Cantidaddenodos(),Get_Vertice_A(),Get_Vertice_B(),Isdireccional()),Cantidaddenodos()));
    
    function matriz_conexa($matriz,$cantidad)
    {
        for($i=0;$i<$cantidad;$i++)
        {
            $contador=0;

            for($j=0; $j <$cantidad ;$j++)
            {
                if($matriz[$i][$j]!=0 || $matriz[$j][$i]!=0)
                {
                    $contador++;
                }
            }

            if($contador==$cantidad-1 || $contador==$cantidad)
            {
                return true;
            }
        }

        $contador=0;
        $i=0;
        $grafo=array();
        $total=conexiones($matriz,$cantidad);

        while($i<$cantidad)
        {
            if($i>0)
            {
                $conexiones_A=buscar_conexion($matriz,$i-1,$cantidad);
            }

            $conexiones=buscar_conexion($matriz,$i,$cantidad);

            if(empty($conexiones))
            {
                return false;
            }
            if(empty($grafo) || !in_array($i,$grafo))
            {

                if($i==0)
                {
                    array_push($grafo,$i);
                    $contador++;
                    for($j=0;$j<count($conexiones);$j++)
                    {
                        if(!in_array($conexiones[$j],$grafo))
                        {
                            array_push($grafo,$conexiones[$j]);
                            $contador++;
                        }
                    }
                    
                }
                elseif(in_array($i,$conexiones_A))
                {
                    array_push($grafo,$i);
                    $contador++;

                    for($j=0;$j<count($conexiones);$j++)
                    {
                        if(!in_array($conexiones[$j],$grafo))
                        {
                            array_push($grafo,$conexiones[$j]);
                            $contador++;
                        }
                    }
                }
            }
            elseif(in_array($i,$grafo))
            {
                if(in_array($i,$conexiones_A))
                {
                    for($j=0;$j<count($conexiones);$j++)
                    {
                        if(!in_array($conexiones[$j],$grafo))
                        {
                            array_push($grafo,$conexiones[$j]);
                            $contador++;
                        }
                    }
                }
            }
            $i++;
        }
        for($j=0;$j<count($grafo);$j++)
        {
            $comprobante=buscar_conexion($matriz,$grafo[$j],$cantidad);
            for($x=0;$x<count($comprobante);$x++)
            {
                if(!in_array($comprobante[$x],$grafo))
                {
                    array_push($grafo,$comprobante[$x]);
                    $contador++;
                }
            }
        }
        if($contador==$cantidad)
        {
            return true;
        }
    }
    
    

    /*function arreglo_simple($cantidad)
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

        while($valor!=$array[$x])
        {
            $x++;
        }
        for($x;$x<sizeof($array)-1;$x++)
        {
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
      

    }*/

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
        while($x<$cantidad)
        {
            if($matriz[$A][$x]>0)
            {
                array_push($conexiones,$x);
            }
            $x++;

        }
        return $conexiones;
    }

    function euleriano($matriz,$cantidad,$isdireccional)
    {
        $contador=0;

        if(matriz_conexa($matriz,$cantidad))
        {
            if(!$isdireccional)  //caso matriz no direccional
            {
                for($i=0;$i<$cantidad;$i++)
                {
                    if(count(buscar_conexion($matriz,$i,$cantidad))%2==0)
                    {
                        $contador++;
                    }
                }
            }
            else
            {
                for($i=0;$i<$cantidad;$i++)
                {
                    if(count(buscar_conexion($matriz,$i,$cantidad))==count(conexionesentrantes($matriz,$i,$cantidad)))
                    {
                        $contador++;
                    }
                }
            }

            if($contador==$cantidad)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function conexionesentrantes($matriz,$i,$cantidad)
    {
        $conexiones = array();
        $x=0;
        while($x<$cantidad)
        {
            if($matriz[$x][$i]>0)
            {
                array_push($conexiones,$x);
            }
            $x++;

        }
        return $conexiones;
    }

    function camino_euler($matriz,$cantidad)
    {
        $euler=array();
        $verificador=0;
        $i=0;   //recorrer matriz
        while($verificador!=$cantidad)
        {
            $verificador=0;
            $salientes=buscar_conexion($matriz,$i,$cantidad);
            if(!in_array($i,$euler))
            array_push($euler,$i);

            array_push($euler,$salientes[0]);
            $matriz[$i][$salientes[0]]=$matriz[$i][$salientes[0]]-1;

            $i=$salientes[0];

            for($x=0;$x<$cantidad;$x++)
            {
                $contador=0;
                for($y=0;$y<$cantidad;$y++)
                {
                    if($matriz[$x][$y]==0)
                    {
                        $contador++;
                    }
                }

                if($contador==$cantidad)
                {
                    $verificador++;
                }
            }

        }
        
        for($i=0;$i<count($euler);$i++)
        {
            if($i>0)
            print(", ");
            print($euler[$i]);
        }
    }
    
?>