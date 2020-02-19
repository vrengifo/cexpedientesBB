<?php
	include("includes/conexion.php");
	$base = conectar();
	$accion = $_REQUEST['accion'];
	switch($accion){
		case "i":
			$idciudad = $_REQUEST['codigoCiudad'];
			$nomciudad = $_REQUEST['nombreCiudad'];
			$sqlText = <<<acl
				INSERT INTO ciudad
				VALUES(0,'$nomciudad','$idciudad')
acl;
			$rs = &$base->Execute($sqlText);
			header('Content-Type: application/xml');
			$respuesta = <<<acl
<?xml version="1.0" ?>
<div id="result" xmlns="http://www.w3.org/1999/xhtml"> Datos ingresados </div>
acl;
			echo $respuesta;
			break;
		case "l":
			$sqlText = <<<acl
				SELECT ciucod,ciunom FROM ciudad
acl;
			$rs = &$base->Execute($sqlText);
			$registros = $rs->RecordCount();
			header('Content-Type: application/xml');
			$respuesta = '<?xml version="1.0" ?>';
			$respuesta .= '<datos totalRecords="'.$registros.'">';
			while (!$rs->EOF){
				$nomciudad = $rs->fields[ciunom];
				$codciudad = $rs->fields[ciucod];
				$nodo = <<<acl
<dato>
	<codigo>$codciudad</codigo>
	<nombre>$nomciudad</nombre>
</dato>
acl;
				$respuesta .= $nodo;
				$rs->MoveNext();
			}
			$respuesta .= '</datos>';
			echo $respuesta;
			break;			
		default:
			  header('Content-Type: application/xml');
			  $respuesta = '<?xml version="1.0" ?>';
			  $respuesta .= '<datos totalRecords="3">';
			  $aux=<<<mya
<dato>
	<codigo>UIO</codigo>
	<nombre>Quito</nombre>
</dato>
<dato>
	<codigo>GYE</codigo>
	<nombre>Guayaquil</nombre>
</dato>
<dato>
	<codigo>CUE</codigo>
	<nombre>Cuenca</nombre>
</dato>
mya;
			$respuesta.=$aux;
			break;
	}
?>