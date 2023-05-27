<?php
    print_r($_POST);
    if(!isset($_POST['codigo'])){
        header('Location: index.php?mensaje=error');
    }

    include 'model/conexion.php';
    $codigo = $_POST['codigo'];
    $nombre = $_POST['txtnombre'];
    $apellido = $_POST['txtapellido'];
    $email = $_POST['txtemail'];
    $celular = $_POST['txtcelular'];

    $sentencia = $bd->prepare("UPDATE personas SET nombre = ?,apellido = ?,email = ?,celular = ? where id = ?;");
    $resultado = $sentencia->execute([$nombre, $apellido, $email, $celular, $codigo]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
        exit();
    }