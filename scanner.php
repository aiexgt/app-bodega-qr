<?php
//ini_set('memory_limit', '1024M');
session_start();

if (isset($_SESSION['id_user'])) { //$_SESSION['id_user'] > 0 && 

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Scanner</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <h1>Escanea el código de barras</h1>
            </div>
        </nav>

        <div class="container">
            <div class="card">
                <div id="contenedor"></div>
            </div>

            <br><br><br>
            <a href="dashboard.php">
                <div class="card text-bg-danger text-center optionBC">
                    <br>
                    <h1>Regresar</h1>
                    <br>
                </div>
            </a>
            <br><br><br>
        </div>

        <!-- Cargamos Quagga y luego nuestro script -->
        <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        
        <script src="js/scanner.js"></script>
    </body>

    </html>

<?php
} else {
    header('Location: index.php');
}
?>