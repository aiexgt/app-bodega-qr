<?php
//ini_set('memory_limit', '1024M');
session_start();

if (isset($_SESSION['id_user'])) { //$_SESSION['id_user'] > 0 && 
    error_reporting(0);

    include("./app/conexion.php");

    if (!isset($_GET['code']) && !isset($_GET['to'])) {
        header('Location: dashboard.php');
    }

    $code = $_GET['code'];
    $to = $_GET['to'];

    $query = "SELECT 
    ifnull(a.codigo, a.codant) AS codigo, 
    a.id AS articuloId,
    a.nombre, 
    um.nombre AS unidad_medida,
    m.nombre AS marca,
    c.nombre AS categoria,
    sc.nombre AS subcategoria,
    ssc.nombre AS subsubcategoria,
    i.stock, 
    cb.medida, cb.observaciones 
    FROM codigo_barras cb 
    INNER JOIN articulo a ON a.id = cb.articulo_id
    INNER JOIN unidad_medida um ON um.id = a.uni_med_id
    INNER JOIN marca m ON m.id = a.marca_id 
    INNER JOIN categoria c ON c.id = a.categoria_id
    INNER JOIN categoria sc ON sc.id = a.scategoria_id
    INNER JOIN categoria ssc ON ssc.id = a.sscategoria_id
    INNER JOIN inventario i ON i.articulo_id = a.id 
    WHERE cb.codigo_barra = '" . $code . "' LIMIT 1";

    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
    }else{
        header('Location: scanner.php?to='.$to);
    }

    $select = "<option value='0'>Seleccionar usuario solicitante</option>";
    $query2 = "SELECT id, codigo, nombres, apellidos FROM tubagua.usuario 
    WHERE rol_id = 4 AND active = 1
    ORDER BY nombres ASC";

    if (!$result2 = mysqli_query($con, $query2)) {
        exit(mysqli_error($con));
    }

    if (mysqli_num_rows($result2) > 0) {

        while($row2 = mysqli_fetch_assoc($result2)){

            $select .= '<option value="'.$row2['id'].'">'.$row2['codigo'].' - '.$row2['nombres'].'</option>';

        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirmación</title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

        <!-- CSS only -->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <br><br>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
                    <h2>Stock: <?php echo $row['stock'] ?></h2>
                </div>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $row['codigo'] . ' - ' . $row['nombre'] ?></h2>
                    <h5 class="card-text">
                        <strong>Unidad de Medida: </strong><?php echo $row['unidad_medida'] ?> <br>
                        <strong>Marca: </strong><?php echo $row['marca'] ?> <br>
                        <strong>Categoria: </strong><?php echo $row['categoria'] ?> <br>
                        <strong>Sub-Categoria: </strong><?php echo $row['subcategoria'] ?> <br>
                        <strong>Sub-Sub-Categoria: </strong><?php echo $row['subsubcategoria'] ?> <br>
                        <strong>Cantidad Caja: </strong><?php echo $row['medida'] ?> <br>
                    </h5>
                </div>
                <div class="card-footer text-muted">
                    <?php echo date('m-d-Y') ?>
                </div>
            </div>
            <br>
            <select class="form-select" id="selectSolicitud" aria-label="Default select example">
                <?php echo $select ?>
            </select>
            <br>
            <div class="d-grid gap-2">
                <button class="btn btn-success btn-lg" type="button" onclick="registrar(<?php echo $row['articuloId'] ?>,<?php echo $to ?>,<?php echo $row['medida']?>)">
                    Aceptar
                    <i class="fa fa-check" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger btn-lg" type="button" onclick="cancelar()">
                    Cancelar
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                </button>
            </div>
        </div>

        <!-- JavaScript Bundle with Popper -->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="./js/script.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: index.php');
}
?>