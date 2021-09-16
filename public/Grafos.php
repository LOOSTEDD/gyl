<?php
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
            }
        }
        echo('<br/>');
        print("Matriz de camino");
        mostrar_matriz($matriz,$cantidad);
        
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
    matriz_caminos(4,[1,0,0,2],[0,1,1,3],true);
    matriz_valoresA(3,[1,1,2,0,0],[0,2,1,1,1],[4,5,1,6,8]);
    
    function matriz_conexa($matriz,$cantidad)
    {
        $conexion=array();
        $conexion_aux=array();
        for($j=1;$j<$cantidad;$j++)
        {
            if($matriz[0][$j]!=0 || $matriz[$j][0]!=0)
            {
                array_push($conexion,$j);
            }
        }

        if(count($conexion)==count($cantidad)-1)
        {
            print("Es conexo");
        }
        else
        {
            for($i=0;$i<count($conexion);$i++)
            {
                //escribir algo piensa pablo piensa
            }
        }
    }        
?>