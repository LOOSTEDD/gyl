<?php
function Matrizdecamino($Cnodos,$vertices,$isdirigido)
{
    $matriz = CrearMatriz($Cnodos);
    for($i = 1; $i<= $Cnodos; $i++) {
        $matriz[$vertices[$i][1]][$vertices[$i][0]] = ($matriz[$vertices[$i][1]][$vertices[$i][0]])+1;

    }
}

function crearmatriz()
{
    $matriz 
}
?>