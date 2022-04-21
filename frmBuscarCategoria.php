<?php
ob_start(); //Activa el almacenamiento en búfer de la salida
session_start();
include_once('clsCategoria.php');
?>
<html>
<head>
<title></title>

<script> 
function Insertar(){ 
    opener.document.location.reload() 
    window.close() 
} 
var miPopup2 
function abreNuevaCategoria(){ 
    miPopup2 = window.open("frmCategoria.php","miwin2","width=410,height=350,scrollbars=yes")
    miPopup2.focus() 
} 
</script> 

<style type="text/css">
</style>
</head>
<body>
<center><form id="form1" method="post" action="frmBuscarCategoria.php">
<fieldset id="form">
<legend>BUSQUEDA DE CATEGORIAS</legend>
<table width="342" border="0">
	<tr>
		<td>
		<label>Nombre categoria</label>
		</td>
		<td>
		<input name="txtBuscar" type="text" size="20" value="" id="txtBuscar" />
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<center><input type="submit" name="botones" class="btn" value="Buscar" /> 
		<input type="submit" class="btn" name="botones"  value="Volver" /></center>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<?php    
		    $aux=new Categoria();
			if(isset($_POST['txtBuscar'])){
				$txtBuscar=$_POST['txtBuscar'];
			 }else{
				$txtBuscar="";
			 }
		    $registros=$aux->buscarPorNombre($txtBuscar);								  
		    echo "<table border='1' align='center'>";
			echo "<tr bgcolor='black' align='center'>
			<td><font color='white'>Codigo</font></td>
			<td><font color='white'> Nombre</font></td>
			<td><font color='white'>*</font></td></tr>";
			while($f=mysqli_fetch_object($registros))
			{
				echo "<tr >";
				echo "<td>$f->id_categoria</td>";
				echo "<td>$f->nombre</td>";
				echo "<td><a href='frmBuscarCategoria.php? pnombre_cat=$f->nombre&pid_categoria=$f->id_categoria' > << </a> </td>";
				echo "</tr>";
			}
			echo "</table>";
			if(isset($_POST['botones'])){
				$botones=$_POST['botones'];
			 }else{
				$botones="";
			 }
		    if($botones=="Volver")
		    {
		    	echo "<script>window.close()</script>";
		    }
	    ?>
		</td>
	</tr>
	<tr>
	<td colspan="2"><center><a href='#' onClick="abreNuevaCategoria()">Nueva Categoria</a></center> </td>
	</tr>
</table>
</form></center>

<?php
if(isset($_GET['pnombre_cat'])){$pnombre_cat=$_GET['pnombre_cat'];}else{$pnombre_cat="";}

   if($pnombre_cat)
   {
       $_SESSION['nombre_cat']=$_GET['pnombre_cat'];
       $_SESSION['id_categoria']=$_GET['pid_categoria'];

       echo "<script> 
       opener.document.location.reload() 
       window.close() 
       </script>";
   }

?>
</body>
</html>