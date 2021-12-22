<!DOCTYPE html>
<html>
<head>
	<title>Registrar</title>
   
<?php
$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['grabar'])){
    $u = $_POST['usuario'];
    $c = $_POST['clave']; 
    if($u == "" || $_POST['clave'] == ""){ 
        echo "<script>alert('Error: usuario y/o clave vacios!!');</script>";
    }else{
        $sql = "INSERT INTO usuario(usuario,clave) values ('$u' ,AES_ENCRYPT('$c','tarea'));";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar insert!";
        }else{
            echo "<script>alert('Se inserto el registro , inicie session !!');window.location.href = 'Login.php';</script>";
        }
    }
}
?>
	
</head>
<body>
<form action="Usuario.php" method="post">
<table>
<tr>
<td> Usuario :</td>
<td> <input type="text" name="usuario"  maxlength="10"/></td>
</tr>
<tr>
<td> Clave :</td>
<td> <input type="password" name="clave"  maxlength="10"/></td>
</tr>
<tr>
<td> </td>
<td> <input type="submit" name="grabar" value="Grabar"/></td>
</tr>
<tr>
<td> </td>
<td> <a href="Login.php">Login</a></td>
</tr>
</table>
</form>
</body>
</html>