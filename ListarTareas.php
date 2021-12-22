<!DOCTYPE html>
<html>
<head>
	<title>Listar Tareas</title>
   
</head>
<body>

<form action="ListarTareas.php" method="post">
<fieldset>
  <legend>Buscar Tarea</legend> 
<table>

<tr>
<td> Estado :</td>
<td>
<select name="prioridad">
  <option value="%">Todos</option>
  <option value="Pendiente">Pendiente</option>
  <option value="Vencida">Vencida</option>
  <option value="Archivada">Archivada</option>
</select>
</td>
<td><input type="submit" name="buscar" value="Buscar"/></td>	
<td><a href="Tarea.php">Nueva Tarea</a> <a href="CerrarSession.php">Cerrar Session</a></td>	
</tr>
</table>
</fieldset>
</form>
<br/>

<table border ="1">
<tr>
<td> Titulo </td>
<td> Contenido</td>
<td> Fecha Registro</td>
<td> Fecha Vencimiento</td>
<td> Prioridad</td>
<td> Estado</td>
<td> Accion</td>
</tr>

<?php
$conexion = new mysqli('localhost', '335668', 'cenizoR1', '335668');
session_start();

if ($conexion->connect_errno) {
    echo "ERROR al conectar con la DB.";
    exit;
}

$u = $_SESSION['idusuario'];
$filtro = "%";
if(isset($_POST['buscar'])){
    $filtro  = $_POST['prioridad'];
}

$sql = "select * from (".
" SELECT idtarea,titulo,contenido,fecharegistro,fechavencimiento,prioridad,".
" case when estado = 'Pendiente' and now() >= fechavencimiento  then 'Vencida' else estado end as estadofinal".
" FROM tarea where idusuario=$u order by fechavencimiento desc,prioridad asc) a where a.estadofinal like '$filtro'";

if(!$consulta = $conexion->query($sql)){
	echo "ERROR: no se pudo ejecutar la consulta!";
}else{
	$filas = mysqli_num_rows($consulta);
	if($filas == 0){
		echo "<script>alert('No existe tareas!!');</script>";
	}else{
	   while ($fila = $consulta->fetch_assoc()) {		   
		   echo "<tr><td>".$fila["titulo"]."</td><td> ".$fila["contenido"]."</td><td> ".$fila["fecharegistro"]."</td><td> ".$fila["fechavencimiento"].
		   "</td><td>  ".$fila["prioridad"]."</td><td>  ".$fila["estadofinal"]."</td>".
		   "<td> <a href='GestionTarea.php?accion=eliminar&id=".$fila["idtarea"]."'>Eliminar</a>&nbsp;<a href='GestionTarea.php?accion=archivar&id=".$fila["idtarea"]."'>Archivar</a>";
		   if($fila["estadofinal"]=="Pendiente"){
		   echo "&nbsp;<a href='GestionTarea.php?accion=modificar&id=".$fila["idtarea"]."'>Modificar</a>";
		   }
		   echo "</td></tr>";
		}
	}
}

?>
</table>
</body>
</html>