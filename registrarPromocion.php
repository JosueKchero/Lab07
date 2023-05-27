<?php
//print_r($_POST);
if (empty($_POST["txtSerie"]) || empty($_POST["txtCapitulos"])) {
    header('Location: index.php');
    exit();
}

include_once 'model/conexion.php';
$serie = $_POST["txtSerie"];
$capitulos = $_POST["txtCapitulos"];
$codigo = $_POST["codigo"];


$sentencia = $bd->prepare("INSERT INTO promociones(serie,capitulos,id_personas) VALUES (?,?,?);");
$resultado = $sentencia->execute([$serie ,$capitulos ,$codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarPromocion.php?codigo='.$codigo);
}