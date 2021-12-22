<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
   
<?php

$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
session_start();
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['login'])){
    $u = $_POST['usuario'];
    $c = $_POST['clave']; 

    if($u == "" || $c == ""){ 
        echo "<script>alert('Error: usuario y/o clave vacios!!');</script>";
    }else{
        $sql = "SELECT * FROM usuario WHERE usuario = '$u' AND AES_DECRYPT(clave,'tarea') = '$c'";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{
            $filas = mysqli_num_rows($consulta);
            if($filas == 0){
                echo "<script>alert('Error: usuario y/o clave incorrectos!!');</script>";
            }else{
			   while ($fila = $consulta->fetch_assoc()) {
					$_SESSION['idusuario'] = $fila["idusuario"];
					$_SESSION['usuario'] = $fila["usuario"];
				}
                echo "<script>alert('Usuario correcto !!');window.location.href = 'ListarTareas.php';</script>";
            }

        }
    }
}
?>
	
</head>
<body>
<form action="Login.php" method="post">

<table>
<tr>
<td> Usuario :</td>
<td> <input type="text" name="usuario"/></td>
</tr>
<tr>
<td> Clave :</td>
<td> <input type="password" name="clave"/></td>
</tr>
<tr>
<td> </td>
<td> <input type="submit" name="login" value="Login"/></td>
</tr>
<tr>
<td> </td>
<td> <a href="Usuario.php">Registrar Usuario</a></td>
</tr>
</table>
</form>

</body>
</html>