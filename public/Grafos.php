<?php
    require("administracion_datos.php");

    function crearmatriz($cantidad)
    {
        $arreglo=array();
        $matriz=array();
        for($i=0;$i<$cantidad;$i++)
        {
            array_push($arreglo,0);                                 // Crea matriz con los vertices dados
        }

        for($i=0;$i<$cantidad;$i++)
        {
            array_push($matriz,$arreglo);
        }

        return $matriz;

    }

    function matriz_caminos()
    {
        $cantidad=Cantidaddenodos();
        $vertice_1=Get_Vertice_A();
        $vertice_2=Get_Vertice_B();
        $isdireccional=Isdireccional();
        print_r($isdireccional);
        $matriz=crearmatriz($cantidad);

        for($i=0;$i<count($vertice_1);$i++)
        {
            if($isdireccional)
            {
                $matriz[$vertice_1[$i]][$vertice_2[$i]]++;
            }
            else
            {
                $matriz[$vertice_2[$i]][$vertice_1[$i]]++;                          // Crea la matriz camino y muestra si es conexa
                $matriz[$vertice_1[$i]][$vertice_2[$i]]++;
            }
        }
        return $matriz;
    }


    function matriz_valoresA()
    {
        $cantidad=Cantidaddenodos();
        $vertice_1=Get_Vertice_A();
        $vertice_2=Get_Vertice_B();
        $aristas=Get_Peso();
        $matriz = crearmatriz($cantidad);
        //print(count($vertice_1));
        for($i=0;$i<count($vertice_1);$i++)
        {
            if($matriz[$vertice_1[$i]][$vertice_2[$i]] == 0 && $matriz[$vertice_2[$i]][$vertice_1[$i]] == 0)            // crea matriz con valor de las aristas, sirve ademas para ver camino optimo
            {
                $matriz[$vertice_1[$i]][$vertice_2[$i]]=$aristas[$i];
                $matriz[$vertice_2[$i]][$vertice_1[$i]]=$aristas[$i];
            }
        }
        return $matriz;
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
                                                //imprime matriz seleccionada
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
    
    function matriz_conexa()                           //Muestra si una matriz es conexa NO TOCAR POR NADA DEL MUNDO
    {
        $matriz=matriz_caminos();
        $cantidad=Cantidaddenodos();

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
            array_push($conexiones,buscar_conexion($matriz,$i,$cantidad));                          // contabiliza las conexiones dentro una matriz
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
                array_push($conexiones,$x);                                                     //retorna el numero de conexiones de un vertice en especifico.
            }
            $x++;

        }
        return $conexiones;
    }

    function euleriano()
    {
        $matriz=matriz_caminos();
        $cantidad=Cantidaddenodos();
        $isdireccional=Isdireccional();
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

    function camino_euler()
    {
        $matriz=matriz_caminos();
        $cantidad=Cantidaddenodos();
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

<<<<<<< HEAD

    function caminos($A,$B)
    {   
        $matriz = matriz_caminos();
        $matrizV= matriz_valoresA();
        $cantidad = Cantidaddenodos();
        $caminos= array();
        $antecesor = array();
        $distancia = array();
        $optimo = array();
        for($i=0;$i<$cantidad;$i++)
        {
            if($A == $i)
            {
                array_push($distancia,0);
            }
            else
            {
                if($matriz[$A][$i]== 0)
                {
                    array_push($distancia,9999999999999999999999999999999);

                }
                if($matriz[$A][$i] > 0)
                { 
                    
                    array_push($distancia,$matrizV[$A][$i]);
                    $antecesor[$i] = $A;
                
                }
=======
    function hamiltoniano()
    {
        $matriz=matriz_caminos();
        $cantidad=Cantidaddenodos();
        $hamilton=array();
        $contador=0;
        $i=0;
        $j=0;
        $aux=0;
        while($contador!=$cantidad)
        {
            $conexiones=buscar_conexion($matriz,$i,$cantidad);
            if($i==0 && !in_array($i,$hamilton))
            {
                array_push($hamilton,$i);
                $contador++;
>>>>>>> 7352ffa6b071c02650e57f91ceffaca33d97550f
            }
            if(!in_array($conexiones[$j],$hamilton) || ($conexiones[$j]==$hamilton[0] && $contador==$cantidad-1))
            {
                $j=0;
                $aux=$i;
                $i=$conexiones[$j];
                array_push($hamilton,$i);
                $contador++;
            }
            else
            {
                array_pop($hamilton);
                $contador--;
                $i=$aux;
                $j++;
            }
            if($j>=count($conexiones))
            {
                print("No es hamiltoniano");
                break;
            }
        }

<<<<<<< HEAD

        }
        $aux = $distancia;
        unset($aux[$A]);

        while(!empty($aux))
        {   
            $menor =array_search(min($aux),$aux,false);

            
            unset($aux[$menor]);
            $sucesores = buscar_conexion($matriz,$menor,$cantidad);
            

            for($i=0;$i<sizeof($sucesores);$i++)
            {   
                if($distancia[$sucesores[$i]]>$distancia[$menor] + $matrizV[$menor][$sucesores[$i]]) 
                {
                    $distancia[$sucesores[$i]]= ($distancia[$menor] + $matrizV[$menor][$sucesores[$i]]);
                    $antecesor[$sucesores[$i]] = $menor;

                }

            }
        }

            $camino = $A;
        if($antecesor[$B])
        {
            while($antecesor[$B] != $A)
                {
                        $camino = $camino.",".$antecesor[$B];
                        $antecesor[$B] = $antecesor[$antecesor[$B]];
                }
                 
                $camino = $camino.",".$B;
                
                $optimo["camino"]= $camino;
                $optimo["valor"] = $distancia[$B];
                return $optimo;
        }

        else
        {
            echo "No se ha encontrado camino ";
            return 0;
=======
        if($hamilton[0]==$hamilton[$cantidad-1])
        {
            print("Es hamiltoniano");
            for($i=0;$i<count($hamilton);$i++)
            {
                if($i>0)
                print(", ");
                print($hamilton[$i]);
            }
>>>>>>> 7352ffa6b071c02650e57f91ceffaca33d97550f
        }
    }
print_r(caminos(1,4));
    
?>