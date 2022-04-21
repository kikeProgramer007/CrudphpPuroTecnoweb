<html>
<head>
</head>
<body>
<?php
 include_once('clsCategoria.php');
 
 if(isset($_POST['txtBuscar'])){
	$valor=$_POST['txtBuscar'];
 }else{
	$valor="";
 }
?>

<b> REGISTRO DE CATEGORIAS  </b>
<form id="form1" name="form1" method="post" action="frmCategoria.php">
  <table width="400" border="0">
    <tr> <td> </td>
     <td>
     <input name="txtIdCategoria" id="txtIdCategoria" type="hidden" value="<?php if(isset($_GET['pid_categoria'])){ echo $_GET['pid_categoria'];};?>" />
     </td>
    </tr>    
	<tr>
      <td width="80">Nombre</td>
      <td width="225">	 	  
      <input name="txtNombre" type="text"  value="<?php if(isset($_GET['pnombre'])){ echo $_GET['pnombre'];}?>" id="txtNombre" />
      </td>
    </tr>    
    <tr>
      <td colspan="2">
      <input type="submit" name="botones"  value="Nuevo" />
      <input type="submit" name="botones"  value="Guardar" />
      <input type="submit" name="botones"  value="Modificar" />
      <input type="submit" name="botones"  value="Eliminar" />
      <input type="submit" name="botones"  id="botones" value="MostrarTodo"/>
     </td>
    </tr>  
   <tr>	
  </table>
</form>

<?php

function guardar()
{
	if($_POST['txtNombre'] )
	{
		$obj= new Categoria();
		$obj->setNombre($_POST['txtNombre']);
		if ($obj->guardar())
			echo "Categoria Guardada..!!!";
		else
			echo "Error al guardar la Categoria";
	}
	else
		echo "El nombre es obligatorio..!!!";
}	

function modificar()
{
	if($_POST['txtNombre'])
	{
		$obj= new Categoria();
		$obj->setIdCategoria($_POST['txtIdCategoria']);
		$obj->setNombre($_POST['txtNombre']);
		if ($obj->modificar())
			echo "Categoria modificada..!!!";
		else
			echo "Error al modificar la categoria..!!!";		
	}
	else
		echo "El nombre es obligatorio...!!!";
}

function eliminar()
{
	if($_POST['txtIdCategoria'])
	{
		$obj= new Categoria();
		$obj->setIdCategoria($_POST['txtIdCategoria']);		
		if ($obj->eliminar())
			echo "Categoria eliminada";
		else
			echo "Error al eliminar la categoria";		
	}
	else	
		echo "para eliminar la categoria, debe tener el codigo..!!!";	
}

function buscar()
{  
   $obj= new Categoria();
    
 if(isset($_POST['txtBuscar'])){
	$valor0=$_POST['txtBuscar'];
 }else{
	$valor0="";
 }
   $resultado=$obj->buscar($valor0);
   mostrarRegistros($resultado);   
}

 function mostrarRegistros($registros)
 {
	echo "<table border='1' align='left'>";
	echo "<tr> <td>Codigo</td> <td> Nombre</td> <td><center>*</center></td></tr>";
	while($fila=mysqli_fetch_object($registros))
	{
	   echo "<tr>";
	   echo "<td>$fila->id_categoria</td>";
	   echo "<td>$fila->nombre</td>";
	   echo "<td><a href='frmCategoria.php? pid_categoria=$fila->id_categoria&pnombre=$fila->nombre'> [Editar] </a> </td>";
		echo "</tr>";
	}
	echo "</table>";
 }   

//programa principal
if(isset($_POST['botones'])){
	$valor2=$_POST['botones'];
 }else{
	$valor2="";
 }
  switch($valor2)
  {
	case "Nuevo":{
	}break;

	case "Guardar":{
    guardar();
	}break;

	case "Modificar":{
    modificar();
	}break;

	case "Eliminar":{
     eliminar();
	}break;

	case "MostrarTodo":{
     buscar();
	}break;
  }
?>  

</body>
</html>
