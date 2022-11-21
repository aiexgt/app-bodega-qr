<?php
//ini_set('memory_limit', '1024M');
session_start();

if (isset($_SESSION['id_user'])) { //$_SESSION['id_user'] > 0 && 

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bodega</title>
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

        <!-- CSS only -->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <br><br>
        <div class="container">
            <a href="scanner.php?to=1">
                <div class="card mb-3 text-bg-primary optionBC">
                    <img src="./images/bodega.png" class="card-img-top icon-accion">
                    <div class="card-body text-center">
                        <h1 class="card-title">A Bodega</h1>
                    </div>
                </div>
            </a>
            <br><br>
            <a href="scanner.php?to=2">
                <div class="card mb-3 text-bg-success optionBC">
                    <img src="./images/casillero.png" class="card-img-top icon-accion">
                    <div class="card-body text-center">
                        <h1 class="card-title">A Casillero</h1>
                    </div>
                </div>
            </a>
        </div>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>

    </html>

<?php
} else {
    header('Location: index.php');
}
?>