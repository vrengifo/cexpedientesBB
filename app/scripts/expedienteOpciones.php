<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	header('Content-Type: application/xml; charset=iso-8859-1');
	include_once("includes/conexion.php");
	include_once("class/expedienteClase.php");
	$accion = $_REQUEST['accion'];
	$expedienteObj = new expediente($conn);
	switch($accion)
	{
		case "i":
			$datos['tTipexpId'] = mb_convert_encoding($_REQUEST['tTipexpId'],"ISO-8859-1","UTF-8");
			$datos['tEstexpId'] = $_REQUEST['tEstexpId'];
			$datos['tPrefijo'] = mb_convert_encoding($_REQUEST['tPrefijo'],"ISO-8859-1","UTF-8");
			$datos['tSufijo'] = mb_convert_encoding($_REQUEST['tSufijo'],"ISO-8859-1","UTF-8");
			$datos['tFormato'] = mb_convert_encoding($_REQUEST['tFormato'],"ISO-8859-1","UTF-8");
			$datos['tNig'] = mb_convert_encoding($_REQUEST['tNig'],"ISO-8859-1","UTF-8");
			$datos['tNroautos'] = mb_convert_encoding($_REQUEST['tNroautos'],"ISO-8859-1","UTF-8");
			$datos['tReferencias'] = mb_convert_encoding($_REQUEST['tReferencias'],"ISO-8859-1","UTF-8");
			$datos['tFechaapertura'] = $_REQUEST['tFechaapertura'];
			$datos['tFechacierre'] = $_REQUEST['tFechacierre'];
			$datos['tObservacion'] = mb_convert_encoding($_REQUEST['tObservacion'],"ISO-8859-1","UTF-8");
			
			$respuesta = $expedienteObj->grabaExpediente($datos);
			if($respuesta)
				$msg = "Datos registrados con éxito..!!";
			else 
				$msg = "Imposible registrar expediente...!!"; 
			$respuesta = <<<mya
<?xml version="1.0" ?>
<div id="area-usuario" xmlns="http://www.w3.org/1999/xhtml"><h2>$msg</h2></div>
mya;
			echo $respuesta;
			break;;
		case "mi":
			$idExpediente = $_REQUEST['idExpediente'];
			$datos['tTipexpId'] = mb_convert_encoding($_REQUEST['tTipexpId'],"ISO-8859-1","UTF-8");
			$datos['tEstexpId'] = $_REQUEST['tEstexpId'];
			$datos['tPrefijo'] = mb_convert_encoding($_REQUEST['tPrefijo'],"ISO-8859-1","UTF-8");
			$datos['tSufijo'] = mb_convert_encoding($_REQUEST['tSufijo'],"ISO-8859-1","UTF-8");
			$datos['tFormato'] = mb_convert_encoding($_REQUEST['tFormato'],"ISO-8859-1","UTF-8");
			$datos['tNig'] = mb_convert_encoding($_REQUEST['tNig'],"ISO-8859-1","UTF-8");
			$datos['tNroautos'] = mb_convert_encoding($_REQUEST['tNroautos'],"ISO-8859-1","UTF-8");
			$datos['tReferencias'] = mb_convert_encoding($_REQUEST['tReferencias'],"ISO-8859-1","UTF-8");
			$datos['tFechaapertura'] = $_REQUEST['tFechaapertura'];
			$datos['tFechacierre'] = $_REQUEST['tFechacierre'];
			$datos['tObservacion'] = mb_convert_encoding($_REQUEST['tObservacion'],"ISO-8859-1","UTF-8");
			
			$respuesta = $expedienteObj->modificaExpediente($idExpediente,$datos);
			if($respuesta)
				$msg = "Datos registrados con éxito..!!";
			else 
				$msg = "Imposible registrar expediente...!!"; 
			$respuesta = <<<mya
<?xml version="1.0" ?>
<div id="area-usuario" xmlns="http://www.w3.org/1999/xhtml"><h2>$msg</h2></div>
mya;
			echo $respuesta;
			break;
		case "md":
			//eliminar
			$idExpediente = $_REQUEST['idExpediente'];
			
			$respuesta = $expedienteObj->eliminarExpediente($idExpediente);
			if($respuesta)
				$msg = "Datos eliminados con éxito..!!";
			else 
				$msg = "Imposible eliminar expediente...!!"; 
			$respuesta = <<<mya
<?xml version="1.0" ?>
<div id="area-usuario" xmlns="http://www.w3.org/1999/xhtml"><h2>$msg</h2></div>
mya;
			echo $respuesta;
			break;	
		case "l":
			$listaExpedientes = $expedienteObj->listaExpedientes("","","");
			//exp_id,tipexp_id,estexp_id,exp_prefijo,
			//exp_sufijo,exp_formato,exp_nig,exp_nroautos,
			//exp_referencias,exp_fechaapertura,exp_fechacierre,exp_observacion 
			$respuesta = '<?xml version="1.0" ?>';
			if($listaExpedientes) {
				$registros = $listaExpedientes->size;
				$respuesta .= '<datos totalRecords="'.$registros.'">';
				while (!$listaExpedientes->EOF){
					$expId = $listaExpedientes->fields[0];
					$tipexpId = $listaExpedientes->fields[1];
					$estexpId = $listaExpedientes->fields[2];
					$expPrefijo= $listaExpedientes->fields[3];
					$expSufijo= $listaExpedientes->fields[4];
					$expFormato = $listaExpedientes->fields[5];
					$expNig = $listaExpedientes->fields[6];
					$expNroautos = $listaExpedientes->fields[7];
					$expReferencias = $listaExpedientes->fields[8];
					$expFechaapertura = $listaExpedientes->fields[9];
					$expFechacierre= $listaExpedientes->fields[10];
					$expObservacion = $listaExpedientes->fields[11];
					
					$tipexpNombre=$expedienteObj->getTipoExpediente($tipexpId);
					$estexpNombre=$expedienteObj->getEstadoExpediente($estexpId);
					
					$codigo=$expedienteObj->id2cad($expPrefijo,$expSufijo,$expId);
					
					$nodo = <<<mya
<dato>
	<idExpediente>$expId</idExpediente>
	<codigo>$codigo</codigo>
	<tipexp>$tipexpNombre</tipexp>
	<estexp>$estexpNombre</estexp>
	<nig>$expNig</nig>
	<nroautos>$expNroautos</nroautos>
	<referencias>$expReferencias</referencias>
	<fechaapertura>$expFechaapertura</fechaapertura>
	<fechacierre>$expFechacierre</fechacierre>
	<observacion>$expObservacion</observacion>
</dato>
mya;
					$respuesta .= $nodo;
					$listaExpedientes->next();
				}
				$respuesta .= '</datos>';
			}
			else 
				$respuesta .= '<datos />';
			echo $respuesta;
			break;
		case "mc":
			$idExpediente = $_REQUEST['idExpediente'];
			$datosExpediente = $expedienteObj->datosExpediente($idExpediente);
			/*
			tipexp_id,estexp_id,exp_prefijo,exp_sufijo,
	    	exp_formato,exp_nig,exp_nroautos,exp_referencias,
	    	exp_fechaapertura,exp_fechacierre,exp_observacion
			*/
			$tipexpId = $datosExpediente->fields[0];
			$estexpId = $datosExpediente->fields[1];
			$expPrefijo = $datosExpediente->fields[2];
			$expSufijo = $datosExpediente->fields[3];
			$expFormato = $datosExpediente->fields[4];
			$expNig = $datosExpediente->fields[5];
			$expNroautos = $datosExpediente->fields[6];
			$expReferencias = $datosExpediente->fields[7];
			$expFechaapertura = $datosExpediente->fields[8];
			$expFechacierre = $datosExpediente->fields[9];
			$expObservacion = $datosExpediente->fields[10];

			$respuesta = '<?xml version="1.0" ?>';
			$respuesta .= '<datos totalRecords="1">';
			$nodo = <<<mya
<dato>
	<tTipexpId>$tipexpId</tTipexpId>
	<tEstexpId>$estexpId</tEstexpId>
	<tPrefijo>$expPrefijo</tPrefijo>
	<tSufijo>$expSufijo</tSufijo>
	<tFormato>$expFormato</tFormato>
	<tNig>$expNig</tNig>
	<tNroautos>$expNroautos</tNroautos>
	<tReferencias>$expReferencias</tReferencias>
	<tFechaapertura>$expFechaapertura</tFechaapertura>
	<tFechacierre>$expFechacierre</tFechacierre>
	<tObservacion>$expObservacion</tObservacion>
</dato>
mya;
			$respuesta .= $nodo;
			$respuesta .= '</datos>';
			echo $respuesta;
			break;
	}
?>