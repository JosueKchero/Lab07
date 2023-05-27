<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'model/conexion.php';
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("SELECT pro.serie, pro.capitulos, pro.id_personas, per.nombre, per.apellido, per.email, per.celular 
  FROM promociones pro 
  INNER JOIN personas per ON per.id = pro.id_personas 
  WHERE pro.id = ?;");
$sentencia->execute([$codigo]);
$personas = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://api.green-api.com/waInstance1101818639/SendMessage/ac50ed3b59b84baba708a7871cdee58f182697ddaf0e4201bc';
    $data = [
        "chatId" => "51".$personas->celular."@c.us",
        "message" =>  'Estimado cliente, le ofrecemos un sin fin de opciones para ver :D. Estimad@'.strtoupper($personas->nombre).' '.strtoupper($personas->apellido).' Le enviamos esta informacion a su correo: '.strtoupper($personas->email).', y a su número telefonico'.strtoupper($personas->celular).' para decirle que no se pierda Haikyuu '.strtoupper($personas->serie).'y sus '.$personas->capitulos.' capitulos: '
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
   // header('Location: agregarPromocion.php?codigo='.$personas->id_personas);
?> 