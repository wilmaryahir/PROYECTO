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
if(isset($_GET['accion'])){
    if($_GET['accion'] == "eliminar"){ 
        $sql = "delete from tarea where idtarea=".$_GET['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar eliminacion!";
        }else{
            echo "<script>alert('Se elimino la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
	 if($_GET['accion'] == "archivar"){ 
        $sql = "update tarea set estado='Archivada' where idtarea=".$_GET['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar eliminacion!";
        }else{
            echo "<script>alert('Se actualizo la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
}
if(isset($_POST['grabar'])){
    if($_POST['titulo'] == "" || $_POST['contenido'] == "" || $_POST['vencimiento'] == "" || $_POST['id'] == ""){ 
        echo "<script>alert('Ingrese los campos tareas!!');</script>";
    }else{
		$sql = "UPDATE tarea set  contenido='".$_POST['contenido']."',fechavencimiento='".$_POST['vencimiento']."' where idtarea=".$_POST['id'].";";
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar actualizar!";
        }else{
            echo "<script>alert('Se actualizo la tarea !!');window.location.href = 'ListarTareas.php';</script>";
        }
    }
}
?>
	
</head>
<body>

<?php
if(isset($_GET['accion']) && $_GET['accion'] == "modificar"){
	
	    $sql = "SELECT * FROM tarea WHERE idtarea = ".$_GET['id'];
        if(!$consulta = $conexion->query($sql)){
            echo "ERROR: no se pudo ejecutar la consulta!";
        }else{
		   while ($fila = $consulta->fetch_assoc()) {
			
?>
<form action="GestionTarea.php" method="post">
<fieldset>
  <legend>Modificar Tarea</legend>
<table>
<tr>
<td> Titulo :</td>
<td> <input type="text" name="titulo"  readonly="readonly" value='<?php echo  $fila['titulo'];?>' />
 <input type="hidden" name="id"  value='<?php echo $_GET['id'];?>' />
 </td>
</tr>
<tr>
<td> Contenido :</td>
<td><textarea name="contenido" rows="5" cols="20"><?php echo  $fila['contenido'];?></textarea></td>
</tr>
<tr>
<td> Fecha Vencimiento :</td>
<td><input type="date" name="vencimiento"  maxlength="10" value='<?php echo $fila['fechavencimiento'];?>'/></td>
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
<?php
 }  } }
?>

</body>
</html>