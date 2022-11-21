<?php
	session_start(); //para las variables de sesion
	$id = $_SESSION['id_user'];

	if(isset($_POST['articulo']) && isset($_POST['to']) && isset($_POST['cantidad']) && isset($_POST['usuarioSol']))
	{
		// include Database connection file 
		include("./conexion.php");

		// get values 
		$articulo = $_POST['articulo'];
		$to = $_POST['to'];
		$cantidad = $_POST['cantidad'];
		$usuarioSol = $_POST['usuarioSol'];

        if($to == 1){
            $from = 2;
        }else{
            $from = 1;
        }

		$query = "INSERT INTO inventario_d(active, articulo_id, bodega_id, tipo, ent_sal_id, documento_id, cantidad, fecha_alta, usuario_id, usuario_solicitud)
            VALUES
                (1, $articulo, $from, 'SAL', 7, 0, $cantidad, NOW(), $id, $usuarioSol),
                (1, $articulo, $to, 'ENT', 2, 0, $cantidad, NOW(), $id, $usuarioSol)";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	}

	echo $result;
?>