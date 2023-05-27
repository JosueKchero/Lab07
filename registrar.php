<?php
//print_r($_POST);
if (empty($_POST["txtnombre"]) || empty($_POST["txtapellido"]) || empty($_POST["txtemail"]) || empty($_POST["txtcelular"])) {
    header('Location: index.php?mensaje=falta');
    exit();
}

include_once 'model/conexion.php';
$nombre = $_POST["txtnombre"];
$apellido = $_POST["txtapellido"];
$email = $_POST["txtemail"];
$celular = $_POST["txtcelular"];

$sentencia = $bd->prepare("INSERT INTO personas(nombre,apellido,email,celular) VALUES (?,?,?,?);");
$resultado = $sentencia->execute([$nombre,$apellido,$email,$celular]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=registrado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
