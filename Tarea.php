<!DOCTYPE html>
<html>
<head>
	<title>Registrar Tarea</title>
   
<?php
$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
session_start();

if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}
if(isset($_POST['grabar'])){
    if($_POST['titulo'] == "" || $_POST['contenido'] == "" || $_POST['vencimiento'] == "" || $_POST['prioridad'] == ""){ 
        echo "<script>alert('Ingrese los campos tareas!!');</script>";
    }else{
		$fcha = date("Y-m-d");
        $sql = "INSERT INTO tarea(titulo,contenido,fecharegistro,fechavencimiento,prioridad,idusuario,estado) ".
		"values ('".$_POST['titulo']."' ,'".$_POST['contenido']."','".$fcha."','".$_POST['vencimiento']."','".$_POST['prioridad']."',".$_SESSION['idusuario'].",'Pendiente');";
		if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar insert!";
        }else{
            echo "<script>alert('Se inserto la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
}
?>
	
</head>
<body>
<form action="Tarea.php" method="post">
<fieldset>
  <legend>Formulario Tarea</legend>
  
<table>

<tr>
<td> Titulo :</td>
<td> <input type="text" name="titulo"  maxlength="100"/></td>
</tr>
<tr>
<td> Contenido :</td>
<td><textarea name="contenido" rows="5" cols="20"></textarea></td>
</tr>
<tr>
<td> Fecha Vencimiento :</td>
<td><input type="date" name="vencimiento"  maxlength="10"/></td>
</tr>
<tr>
<td> Prioridad :</td>
<td>
<select name="prioridad">
  <option value="1.Alto">1.Alto</option>
  <option value="2.Mediano">2.Mediano</option>
  <option value="3.Bajo">3.Bajo</option>
</select>
</td>
</tr>
<tr>
<td> </td>
<td> <input type="submit" name="grabar" value="Grabar"/></td>
</tr>
<tr>
<td> </td>
<td> <a href="ListarTareas.php">Listado Tareas</a></td>
</tr>
</table>
</fieldset>
</form>
</body>
</html>