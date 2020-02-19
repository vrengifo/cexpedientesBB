<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	header('Content-Type: application/xml; charset=iso-8859-1');
	include_once("includes/conexion.php");
	include_once("class/clienteClase.php");
	$accion = $_REQUEST['accion'];
	$clienteObj = new cliente($conn);
	switch($accion)
	{
		case "i":
			$datos['tTipcliId'] = mb_convert_encoding($_REQUEST['tTipcliId'],"ISO-8859-1","UTF-8");
			$datos['tSexId'] = $_REQUEST['tSexId'];
			$datos['tEstcivId'] = mb_convert_encoding($_REQUEST['tEstcivId'],"ISO-8859-1","UTF-8");
			$datos['tCedula'] = $_REQUEST['tCedula'];
			$datos['tRuc'] = $_REQUEST['tRuc'];
			$datos['tNombre'] = mb_convert_encoding($_REQUEST['tNombre'],"ISO-8859-1","UTF-8");
			$datos['tApellido'] = $_REQUEST['tApellido'];
			$datos['tFechanacimiento'] = $_REQUEST['tFechanacimiento'];
			$datos['tDireccion'] = mb_convert_encoding($_REQUEST['tDireccion'],"ISO-8859-1","UTF-8");
			$datos['tTelefono'] = $_REQUEST['tTelefono'];
			$datos['tEmail'] = $_REQUEST['tEmail'];
			
			$respuesta = $clienteObj->grabaCliente($datos);
			if($respuesta)
				$msg = "Datos registrados con éxito..!!";
			else 
				$msg = "Imposible registrar cliente...!!"; 
			$respuesta = <<<mya
<?xml version="1.0" ?>
<div id="area-usuario" xmlns="http://www.w3.org/1999/xhtml"><h2>$msg</h2></div>
mya;
			echo $respuesta;
			break;;
		case "mi":
			$idCliente = $_REQUEST['idCliente'];
			$datos['tTipcliId'] = $_REQUEST['tTipcliId'];
			$datos['tSexId'] = $_REQUEST['tSexId'];
			$datos['tEstcivId'] = $_REQUEST['tEstcivId'];
			$datos['tCedula'] = $_REQUEST['tCedula'];
			$datos['tRuc'] = $_REQUEST['tRuc'];
			$datos['tNombre'] = mb_convert_encoding($_REQUEST['tNombre'],"ISO-8859-1","UTF-8");
			$datos['tApellido'] = mb_convert_encoding($_REQUEST['tApellido'],"ISO-8859-1","UTF-8");
			$datos['tFechanacimiento'] = $_REQUEST['tFechanacimiento'];
			$datos['tDireccion'] = mb_convert_encoding($_REQUEST['tDireccion'],"ISO-8859-1","UTF-8");
			$datos['tTelefono'] = $_REQUEST['tTelefono'];
			$datos['tEmail'] = $_REQUEST['tEmail'];
			
			$respuesta = $clienteObj->modificaCliente($idCliente,$datos);
			if($respuesta)
				$msg = "Datos registrados con éxito..!!";
			else 
				$msg = "Imposible registrar cliente...!!"; 
			$respuesta = <<<mya
<?xml version="1.0" ?>
<div id="area-usuario" xmlns="http://www.w3.org/1999/xhtml"><h2>$msg</h2></div>
mya;
			echo $respuesta;
			break;
		case "l":
			$listaClientes = $clienteObj->listaClientes("");
			//cli_id,tipcli_id,sex_id,estciv_id,cli_cedula,cli_ruc,cli_nombre,cli_apellido,cli_fechanacimiento,cli_direccion,cli_telefono,cli_email 
			$respuesta = '<?xml version="1.0" ?>';
			if($listaClientes) {
				$registros = $listaClientes->size;
				$respuesta .= '<datos totalRecords="'.$registros.'">';
				while (!$listaClientes->EOF){
					$cliId = $listaClientes->fields[0];
					$tipcliId = $listaClientes->fields[1];
					$sexId = $listaClientes->fields[2];
					$estcivId= $listaClientes->fields[3];
					$cliCedula= $listaClientes->fields[4];
					$cliRuc = $listaClientes->fields[5];
					$cliNombre = $listaClientes->fields[6];
					$cliApellido = $listaClientes->fields[7];
					$cliFechanacimiento = $listaClientes->fields[8];
					$cliDireccion = $listaClientes->fields[9];
					$cliTelefono= $listaClientes->fields[10];
					$cliEmail = $listaClientes->fields[11];
					
					if(strlen($cliRuc)>0)
					  $ciruc=$cliRuc;
					else 
					  $ciruc=$cliCedula;  
					
					$nodo = <<<mya
<dato>
	<idCliente>$cliId</idCliente>
	<nombre>$cliApellido $cliNombre</nombre>
	<ciruc>$ciruc</ciruc>
	<telefono>$cliTelefono</telefono>
	<direccion>$cliDireccion</direccion>
</dato>
mya;
					$respuesta .= $nodo;
					$listaClientes->next();
				}
				$respuesta .= '</datos>';
			}
			else 
				$respuesta .= '<datos />';
			echo $respuesta;
			break;
		case "mc":
			$idCliente = $_REQUEST['idCliente'];
			$datosCliente = $clienteObj->datosCliente($idCliente);

			$tipcliId = $datosCliente->fields[0];
			$sexId = $datosCliente->fields[1];
			$estcivId = $datosCliente->fields[2];
			$cliCedula = $datosCliente->fields[3];
			$cliRuc = $datosCliente->fields[4];
			$cliNombre = $datosCliente->fields[5];
			$cliApellido = $datosCliente->fields[6];
			$cliFechanacimiento = $datosCliente->fields[7];
			$cliDireccion = $datosCliente->fields[8];
			$cliTelefono = $datosCliente->fields[9];
			$cliEmail = $datosCliente->fields[10];

			$respuesta = '<?xml version="1.0" ?>';
			$respuesta .= '<datos totalRecords="1">';
			$nodo = <<<mya
<dato>
	<tTipcliId>$tipcliId</tTipcliId>
	<tSexId>$sexId</tSexId>
	<tEstcivId>$estcivId</tEstcivId>
	<tCedula>$cliCedula</tCedula>
	<tRuc>$cliRuc</tRuc>
	<tNombre>$cliNombre</tNombre>
	<tApellido>$cliApellido</tApellido>
	<tFechanacimiento>$cliFechanacimiento</tFechanacimiento>
	<tDireccion>$cliDireccion</tDireccion>
	<tTelefono>$cliTelefono</tTelefono>
	<tEmail>$cliEmail</tEmail>
</dato>
mya;
			$respuesta .= $nodo;
			$respuesta .= '</datos>';
			echo $respuesta;
			break;
	}
?>