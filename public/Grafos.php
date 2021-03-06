<?php
    require("administracion_datos.php");
    use Illuminate\Foundation\Inspiring;
    use Illuminate\Support\Facades\Artisan;

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
    /*function Nodo_exist($vertices,$cantidad)
    {
        for($i=0;$i<sizeof($vertices);$i++)
        {
            if($vertices[$i]>$cantidad)
            {
                log::error("El nodo".$vertices[$i]."no existe");
            }
        }
    }*/

    function matriz_caminos()
    {
        $cantidad=Cantidaddenodos();
        $vertice_1=Get_Vertice_A();
        //Nodo_exist($vertice_1,$cantidad);
        $vertice_2=Get_Vertice_B();
        //Nodo_exist($vertice_2,$cantidad);
        $isdireccional=Isdireccional();
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
        //log::info("Matriz de caminos creada correctamente");
        return $matriz;
    }


    function matriz_valoresA()
    {
        $cantidad=Cantidaddenodos();
        $vertice_1=Get_Vertice_A();
        $vertice_2=Get_Vertice_B();
        $aristas=Get_Peso();
        $matriz = crearmatriz($cantidad);
        
        for($i=0;$i<count($vertice_1);$i++)
        {
            if($matriz[$vertice_1[$i]][$vertice_2[$i]] == 0 && $matriz[$vertice_2[$i]][$vertice_1[$i]] == 0)            // crea matriz con valor de las aristas, sirve ademas para ver camino optimo
            {
                $matriz[$vertice_1[$i]][$vertice_2[$i]]=$aristas[$i];
                $matriz[$vertice_2[$i]][$vertice_1[$i]]=$aristas[$i];
            }
        }
        //log::info("Matriz de valores creada correctamente");
        return $matriz;
    }
    
    function mostrar_matriz($matriz)
    {
        $cantidad=Cantidaddenodos();
        echo"\n";
        for($i=0;$i<$cantidad;$i++)
        {
            if($i==0)
            {
                echo "\t&nbsp&nbsp";
            }
            echo "[$i]&nbsp";
        }
                                                //imprime matriz seleccionada
        echo'<br/>';
        
        for($i=0;$i<$cantidad;$i++)
        {
            echo "[$i]";
            for($j=0;$j<$cantidad;$j++)
            {
                echo "&nbsp";
                print_r($matriz[$i][$j]);
                echo "&nbsp&nbsp";
            }
            echo'<br/>';
        }
        echo'<br/>';
    }
    
    
    
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
                //log::info("El grafo es conexo");
                return true;
            }
        }

        $contador=0;
        $i=0;
        $grafo=array();

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
        $direccional=Isdireccional();
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
            if($direccional)
                $matriz[$i][$salientes[0]]=$matriz[$i][$salientes[0]]-1;
            else
            {
                $matriz[$i][$salientes[0]]=$matriz[$i][$salientes[0]]-1;
                $matriz[$salientes[0]][$i]=$matriz[$salientes[0]][$i]-1;
            }
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

    function caminos()
    {   
        $A = Get_Nodos()[0];
        $B = Get_Nodos()[1];
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
            }


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
                
                $optimo[0]= $camino;
                $optimo[1] = $distancia[$B];
                return $optimo;
        }
        else
        {
            //log::info("No se ha encontrado un camino optimo");
            //log::error("error en el camino mas optimo");
            return 0;
        }
    }

    function hamiltoniano()
    {
        $matriz=matriz_caminos();
        $cantidad=Cantidaddenodos();
        $hamilton=array();
        $contador=0;
        $i=0;
        $j=0;
        $aux=array();
        while($contador<$cantidad+1)
        {
            $conexiones=buscar_conexion($matriz,$i,$cantidad);
            if($j>=count($conexiones) && $i==0)
            {
                print("Su grafo no es hamiltoniano. ");
                array_pop($hamilton);
                break;
            }
            elseif($i==0 && !in_array($i,$hamilton))
            {
                array_push($hamilton,$i);
                $contador++;
            }
            elseif(!in_array($conexiones[$j],$hamilton) || ($conexiones[$j]==$hamilton[0] && $contador==$cantidad))
            {
                array_push($aux,$i);
                $i=$conexiones[$j];
                array_push($hamilton,$i);
                $contador++;
                $j=0;
            }
            else
            {
                $j++;
            }

            if($j>=count($conexiones) && $i!=0)
            {
                $contador_aux=0;
                while($j>=count(buscar_conexion($matriz,$i,$cantidad)) && $j>0)
                {
                    $j--;
                    if($contador_aux==0)
                    {
                        array_pop($hamilton);
                        $contador--;
                        $i=array_pop($aux);
                    }
                    if($j==0)
                    {
                        array_pop($hamilton);
                        $contador--;
                        $i=array_pop($aux);
                        $j++;
                    }
                    if($i==0 && $j==0)
                    {
                        print("Su grafo no es hamiltoniano. ");
                    }
                    $contador_aux++;
                }
            }
            if($j>=count($conexiones) && $i==0)
            {
                print("Su grafo no es hamiltoniano. ");
                array_pop($hamilton);
                break;
            }
        }
        if(!empty($hamilton))
        {
            if($hamilton[0]==$hamilton[$cantidad])
            {
                print("Su grafo es hamiltoniano. ");
                //log::info("Grafo es hamiltoniano");
                echo '<br/>';
                echo '<li/>';
                print("Su camino hamiltoniano es: ");
                for($i=0;$i<count($hamilton);$i++)
                {
                    if($i>0)
                    print(", ");
                    print($hamilton[$i]);
                }
                print(". ");
            }
            else
            {
                //log::info("Grafo no es hamiltoneano");
                print("Su grafo no es hamiltoniano. ");
            }
        }
    }

    function flujo_maximo()
    {
        $A = Get_Nodos_B()[0];
        $B = Get_Nodos_B()[1];
        $matriz = matriz_caminos();
        $matrizV= matriz_valoresA();
        $cantidad = Cantidaddenodos();
        $vertices_1 = array();
        $vertice_2 = array();
        $contador=0;
        $aux=array();
        do 
        {
            $camino=caminos_r($A,$B,$matriz,$matrizV,$cantidad);
            $string=$camino[0];
            $restar=$camino[1];
            if(!$camino || !empty($camino))
            {
                for($i=0;$i<iconv_strlen($string);$i++)
                {
                    if($string[$i]!=",")
                    {
                        array_push($aux,$string[$i]);
                    }
                    elseif($string[$i]=="," && empty($vertices_1))
                    {
                        $num=0;
                        for($j=0;$j<count($aux);$j++)
                        {
                            $num = $num*10 + intval($aux[$j]);
                        }
                        array_push($vertices_1,$num);
                        for($j=0;$j<count($aux);$j++)
                        {
                            array_pop($aux);
                        }
                    }
                    elseif($string[$i]=="," && ($i>0 && $i<iconv_strlen($string)-1))
                    {
                        $num=0;
                        for($j=0;$j<count($aux);$j++)
                        {
                            $num = $num*10 + intval($aux[$j]);
                        }
                        array_push($vertices_1,$num);
                        array_push($vertice_2,$num);
                        for($j=0;$j<count($aux);$j++)
                        {
                            array_pop($aux);
                        }
                    }
                    if($i==iconv_strlen($string)-1)
                    {
                        $num=0;
                        for($j=0;$j<count($aux);$j++)
                        {
                            $num = $num*10 + intval($aux[$j]);
                        }

                        array_push($vertice_2,$num);

                        for($j=0;$j<count($aux);$j++)
                        {
                            array_pop($aux);
                        }
                    }
                }
                for($j=0;$j<count($vertices_1);$j++)
                {
                    $matriz[$vertices_1[$j]][$vertice_2[$j]] = $matriz[$vertices_1[$j]][$vertice_2[$j]]-$restar;
                }
                $contador= $contador + intval($restar);
            }
            elseif(!$camino && $contador==0)
            {
                print("No existe camino entre los nodos que ingreso");
            }
        }while(!$camino);

        if($contador!=0)
        {
            print("El flujo maximo entre los nodos ingresados es: ");
            print($contador);
        }
    }

    function caminos_r($A,$B,$matriz,$matrizV,$cantidad)
    {   
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
            }
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
                if($distancia[$sucesores[$i]]>$distancia[$menor]) 
                {
                    $distancia[$sucesores[$i]]= $distancia[$menor];
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
                
                $optimo[0]= $camino;
                $optimo[1] = $distancia[$B];
                return $optimo;
        }
        else
        {
            return false;
        }
    }
    //flujo_maximo();
?>