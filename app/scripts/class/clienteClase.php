<?php
	/*
		Clase Cliente
	*/
	
	class cliente {
		/**
		 * Variable de conexión a Base de Datos
		 *
		 * @var conexion
		 */
		var $base;
	
	    /**
	    * @return void
	    * @desc Constructor de la clase
	    */
	    function cliente(&$base) {
	    	$this->base = $base;
	    }
	
		/**
	    * @return recordset
	    * @desc Recupera los clientes por tipo de cliente... 
	    */
	    function listaClientes($tipoCliente) 
	    {
	    	if(strlen($tipoCliente) > 0)
		    	$sqlText = <<<mya
		    		SELECT cli_id,tipcli_id,sex_id,estciv_id,
		    		cli_cedula,cli_ruc,cli_nombre,cli_apellido,
		    		cli_fechanacimiento,cli_direccion,cli_telefono,cli_email 
		    		FROM cliente 
		    		where tipcli_id=$tipoCliente 
		    		ORDER BY cli_id
mya;
			else
				$sqlText = <<<mya
					SELECT cli_id,tipcli_id,sex_id,estciv_id,
		    		cli_cedula,cli_ruc,cli_nombre,cli_apellido,
		    		cli_fechanacimiento,cli_direccion,cli_telefono,cli_email 
		    		FROM cliente 
		    		ORDER BY cli_id
mya;
	       	$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;
	    }
	    
	    /**
	     * Consulta los datos de tabla sexo
	     *
	     * @return rs
	     */
	    function listaSexo() 
	    {
	    	$sqlText = <<<mya
		    		SELECT sex_id,sex_nombre
		    		FROM sexo 
		    		order by sex_id
mya;
			$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;	    	
	    }
	    
	    /**
	     * Consulta los datos de tabla tipocliente
	     *
	     * @return rs
	     */
	    function listaTipocliente() 
	    {
	    	$sqlText = <<<mya
		    		SELECT tipcli_id,tipcli_nombre
		    		FROM tipocliente 
		    		order by tipcli_nombre
mya;
			$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;	    	
	    }
	    
	    /**
	     * Consulta los datos de tabla estadocivil
	     *
	     * @return rs
	     */
	    function listaEstadocivil() 
	    {
	    	$sqlText = <<<mya
		    		SELECT estciv_id,estciv_nombre
		    		FROM estadocivil 
		    		order by estciv_id
mya;
			$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;
	    }
		
		/**
		 * En base a $lista carga los datos para el backbase ComboBoxOption
		 *
		 * @param rs $lista
		 * @return string
		 */
		function bbComboOption($lista)
	    {
	      //<b:comboBoxOption value="1" class="auto_BB_ID_313">Opcion 1</b:comboBoxOption>	
	      switch ($lista) 
	      {
	      	case "sexo":
	      		$rs=$this->listaSexo();
	      		break;
	      	case "tipocliente":
	      		$rs=$this->listaTipocliente();
	      		break;
	      	case "estadocivil":
	      		$rs=$this->listaEstadocivil();	
	      		break;
	      }
	      
	      $cad="";
	      while(!$rs->EOF)
	      {
	        $vId=$rs->fields[0];
	        $vValor=$rs->fields[1];
	      	$nodo=<<<mya
  <b:comboBoxOption value="$vId" class="auto_BB_ID_313">$vValor</b:comboBoxOption>	        
mya;
			$cad.=$nodo;
	      	$rs->next();
		  }
		  return($cad); 
		}
	    
	    /**
	 	* @return bool
	 	* @param array $datos
	 	* @desc Genera un cliente...
	 	*/
	    function grabaCliente($datos) {
	    	$tipcliId = $datos["tTipcliId"];
	    	$sexId = $datos["tSexId"];
	    	$estcivId = $datos["tEstcivId"];
	    	$cedula = $datos["tCedula"];
	    	$ruc = $datos["tRuc"];
	    	$nombre = $datos["tNombre"];
	    	$apellido = $datos["tApellido"];
	    	$fechanacimiento = $datos["tFechanacimiento"];
	    	$direccion = $datos["tDireccion"];
	    	$telefono = $datos["tTelefono"];
	    	$email = $datos["tEmail"];
	    	
	    	$estado = 'I';
	    	$sqlText = <<<mya
	    		INSERT INTO cliente 
	    		(tipcli_id,sex_id,estciv_id,cli_cedula,
	    		cli_ruc,cli_nombre,cli_apellido,cli_fechanacimiento,
	    		cli_direccion,cli_telefono,cli_email)
	    		VALUES('$tipcliId','$sexId','$estcivId','$cedula',
	    		'$ruc','$nombre','$apellido','$fechanacimiento',
	    		'$direccion','$telefono','$email')
mya;
			$rs = &$this->base->execute($sqlText);
			if($rs)
				return 1;
			else
				return 0;
	    }
	    
	    /**
	 	* @return recordset
	 	* @param int $idCliente
	 	* @desc Obtiene los datos de un cliente...
	 	*/
	    function datosCliente($idCliente) {
	    	$sqlText = <<<mra
	    		SELECT tipcli_id,sex_id,estciv_id,cli_cedula,
	    		cli_ruc,cli_nombre,cli_apellido,cli_fechanacimiento,
	    		cli_direccion,cli_telefono,cli_email
	    		FROM cliente
	    		WHERE cli_id = $idCliente
mra;
			$rs = &$this->base->execute($sqlText);
			if(!$rs->EOF)
				return $rs;
			else
				return 0;
	    }
	    
	    /**
	 	* @return bool
	 	* @param int $idCliente
	 	* @param array $datos
	 	* @desc Modifica los datos de un cliente...
	 	*/
	    function modificaCliente($idCliente,$datos) {
	    	$tipcliId = $datos["tTipcliId"];
	    	$sexId = $datos["tSexId"];
	    	$estcivId = $datos["tEstcivId"];
	    	$cedula = $datos["tCedula"];
	    	$ruc = $datos["tRuc"];
	    	$nombre = $datos["tNombre"];
	    	$apellido = $datos["tApellido"];
	    	$fechanacimiento = $datos["tFechanacimiento"];
	    	$direccion = $datos["tDireccion"];
	    	$telefono = $datos["tTelefono"];
	    	$email = $datos["tEmail"];
			
	    	$sqlText = <<<mra
	    		UPDATE cliente
	    		SET tipcli_id = '$tipcliId',
	    			sex_id = '$sexId',
	    			estciv_id = '$estcivId',
	    			cli_cedula = '$cedula',
	    			cli_ruc = '$ruc',
	    			cli_nombre = '$nombre',
	    			cli_apellido = '$apellido',
	    			cli_fechanacimiento = '$fechanacimiento',
	    			cli_direccion = '$direccion',
					cli_telefono = '$telefono',
					cli_email = '$email'
	    		WHERE cli_id = $idCliente
mra;
			$rs = &$this->base->execute($sqlText);
			if($rs)
				return 1;
			else
				return 0;
	    }
	    
	    /**
	 	* @return string
	 	* @param int $idCliente
	 	* @desc Retorna el nombre del cliente...
	 	*/
	    function nombreCliente($idCliente) {
	    	$sqlText = <<<mya
	    		SELECT cli_apellido,cli_nombre
	    		FROM cliente
	    		WHERE cli_id = $idCliente
mya;
			$rs = &$this->base->execute($sqlText);
			if(!$rs->EOF)
			{
				$res=$rs->fields[0]." ".$rs->fields[1];
				return($res);
			}
			else
				return("");
	    }
	}
?>