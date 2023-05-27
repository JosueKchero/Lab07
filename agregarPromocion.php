<?php include 'template/header.php' ?>

<?php
include_once "model/conexion.php";
$codigo = $_GET['codigo'];

$sentencia = $bd->prepare("select * from personas where id = ?;");
$sentencia->execute([$codigo]);
$personas = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_serie = $bd->prepare("select * from promociones where id_personas = ?;");
$sentencia_serie->execute([$codigo]);
$serie = $sentencia_serie->fetchAll(PDO::FETCH_OBJ); 
//print_r($persona);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos para la serie: <br><?php echo $personas->nombre.' '.$personas->apellido.' '.$personas->email.' '.$personas->celular; ?>
                </div>
                <form class="p-4" method="POST" action="registrarPromocion.php">
                    <div class="mb-3">
                        <label class="form-label">Serie: </label>
                        <input type="text" class="form-control" name="txtSerie" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capitulos: </label>
                        <input type="text" class="form-control" name="txtCapitulos" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="codigo" value="<?php echo $personas->id; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Lista de Series
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Serie</th>
                                <th scope="col">Capitulos</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($serie as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->serie; ?></td>
                                    <td><?php echo $dato->capitulos; ?></td>
                                    <td><a class="text-primary" href="enviarMensaje.php?codigo=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?> 