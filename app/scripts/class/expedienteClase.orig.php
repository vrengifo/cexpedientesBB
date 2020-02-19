<?php
	/*
		Clase expediente
	*/
	
	class expediente_orig {
		/**
		 * Variable de conexión a Base de Datos
		 *
		 * @var conexion
		 */
		var $base;
		
		var $prefijo;
		var $sufijo;
		var $id;
	
	    /**
	    * @return void
	    * @desc Constructor de la clase
	    */
	    function expediente(&$base) {
	    	$this->base = $base;
	    }
	
	    /**
	     * Retorna rs de expedientes
	     *
	     * @param int $tipoExpediente
	     * @param int $clienteExpediente
	     * @param string $estadoExpediente
	     * @return rs
	     */
	    function listaExpedientes($tipoExpediente,$clienteExpediente,$estadoExpediente) 
	    {
	    	$cadTipoExpediente="";
	    	if(strlen($tipoExpediente) > 0)
	    	{
	    		$cadTipoExpediente=<<<mya
 and tipexp_id=$tipoExpediente 
mya;
	    	}
	    	
	    	$cadClienteExpediente="";
	    	if(strlen($clienteExpediente) > 0)
	    	{
	    		$cadClienteExpediente=<<<mya
 and exp_id in ( select distinct exp_id from clienteexpediente where cli_id=$clienteExpediente ) 
mya;
	    	}
	    	
	    	$cadEstadoExpediente="";
	    	if(strlen($estadoExpediente) > 0)
	    	{
	    		$cadEstadoExpediente=<<<mya
 and estexp_id='$estadoExpediente' 
mya;
	    	}
	    	
		    	$sqlText = <<<mya
		    		SELECT exp_id,tipexp_id,estexp_id,exp_prefijo,
		    		exp_sufijo,exp_formato,exp_nig,exp_nroautos,
		    		exp_referencias,exp_fechaapertura,exp_fechacierre,exp_observacion  
		    		FROM expediente 
		    		where exp_id>0 
		    		$cadTipoExpediente 
		    		$cadClienteExpediente 
		    		$cadEstadoExpediente 
		    		ORDER BY exp_id desc
mya;

	       	$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;
	    }
	    
	    /**
	     * Consulta los datos de tabla tipoexpediente
	     *
	     * @return rs
	     */
	    function listaTipoexpediente() 
	    {
	    	$sqlText = <<<mya
		    		SELECT tipexp_id,tipexp_nombre
		    		FROM tipoexpediente 
		    		order by tipexp_nombre
mya;
			$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;	    	
	    }
	    
	    /**
	     * Consulta los datos de tabla estadoexpediente
	     *
	     * @return rs
	     */
	    function listaEstadoexpediente() 
	    {
	    	$sqlText = <<<mya
		    		SELECT estexp_id,estexp_nombre
		    		FROM estadoexpediente 
		    		order by extexp_orden asc
mya;
			$rs = &$this->base->execute($sqlText);
	       	if(!$rs->EOF)
	       		return $rs;
	       	else 
	       		return 0;	    	
	    }
	    
	    function getTipoExpediente($tipexpId)
	    {
	    	$sql=<<<mya
	    	select tipexp_nombre 
	    	from tipoexpediente 
	    	where tipexp_id=$tipexpId
mya;
			$rs=&$this->base->execute($sql);
			if($rs)
			  $res=$rs->fields[0];
			else 
			  $res="";
			return($res);    
	    }
	    
	    function getEstadoExpediente($estexpId)
	    {
	    	$sql=<<<mya
	    	select estexp_nombre 
	    	from estadoexpediente 
	    	where estexp_id='$estexpId'
mya;
			$rs=&$this->base->execute($sql);
			if($rs)
			  $res=$rs->fields[0];
			else 
			  $res="";
			return($res);    
	    }
	    
	    function cad2id($cad)
	    {
	    	list($this->prefijo,$this->sufijo,$this->id)=explode("-",$cad);
	    }
	    
	    function id2cad($prefijo,$sufijo,$id)
	    {
	    	return ($prefijo."-".$sufijo."-".$id);
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
	      	case "tipoexpediente":
	      		$rs=$this->listaTipoexpediente();
	      		break;
	      	case "estadoexpediente":
	      		$rs=$this->listaEstadoexpediente();	
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
	 	* @desc Genera un expediente...
	 	*/
	    function grabaExpediente($datos) {
	    	$tipexpId = $datos["tTipexpId"];
	    	$estexpId = $datos["tEstexpId"];
	    	$prefijo = $datos["tPrefijo"];
	    	$sufijo = $datos["tSufijo"];
	    	$formato = $datos["tFormato"];
	    	$nig = $datos["tNig"];
	    	$nroautos = $datos["tNroautos"];
	    	$referencias = $datos["tReferencias"];
	    	$fechapertura = $datos["tFechaapertura"];
	    	$fechacierre = $datos["tFechacierre"];
	    	$observacion = $datos["tObservacion"];
	    	
	    	$sqlText = <<<mya
	    		INSERT INTO expediente 
	    		(tipexp_id,estexp_id,exp_prefijo,exp_sufijo,
	    		exp_formato,exp_nig,exp_nroautos,exp_referencias,
	    		exp_fechaapertura,exp_fechacierre,exp_observacion)
	    		VALUES('$tipexpId','$estexpId','$prefijo','$sufijo',
	    		'$formato','$nig','$nroautos','$referencias',
	    		'$fechapertura','$fechacierre','$observacion')
mya;
			$rs = &$this->base->execute($sqlText);
			if($rs)
				return 1;
			else
				return 0;
	    }
	    
	    /**
	 	* @return recordset
	 	* @param int $idexpediente
	 	* @desc Obtiene los datos de un expediente...
	 	*/
	    function datosExpediente($idexpediente) {
	    	$sqlText = <<<mra
	    		SELECT tipexp_id,estexp_id,exp_prefijo,exp_sufijo,
	    		exp_formato,exp_nig,exp_nroautos,exp_referencias,
	    		exp_fechaapertura,exp_fechacierre,exp_observacion
	    		FROM expediente
	    		WHERE exp_id = $idexpediente
mra;
			$rs = &$this->base->execute($sqlText);
			if(!$rs->EOF)
				return $rs;
			else
				return 0;
	    }
	    
	    /**
	 	* @return bool
	 	* @param int $idexpediente
	 	* @param array $datos
	 	* @desc Modifica los datos de un expediente...
	 	*/
	    function modificaExpediente($idexpediente,$datos) {
	    	$tipexpId = $datos["tTipexpId"];
	    	$estexpId = $datos["tEstexpId"];
	    	$prefijo = $datos["tPrefijo"];
	    	$sufijo = $datos["tSufijo"];
	    	$formato = $datos["tFormato"];
	    	$nig = $datos["tNig"];
	    	$nroautos = $datos["tNroautos"];
	    	$referencias = $datos["tReferencias"];
	    	$fechapertura = $datos["tFechaapertura"];
	    	$fechacierre = $datos["tFechacierre"];
	    	$observacion = $datos["tObservacion"];
			
	    	$sqlText = <<<mra
	    		UPDATE expediente
	    		SET tipexp_id = '$tipexpId',
	    			estexp_id = '$estexpId',
	    			exp_prefijo = '$prefijo',
	    			exp_sufijo = '$sufijo',
	    			exp_formato = '$formato',
	    			exp_nig = '$nig',
	    			exp_nroautos = '$nroautos',
	    			exp_referencias = '$referencias',
	    			exp_fechaapertura = '$fechapertura',
					exp_fechacierre = '$fechacierre',
					exp_observacion = '$observacion'
	    		WHERE exp_id = $idexpediente
mra;
			$rs = &$this->base->execute($sqlText);
			if($rs)
				return 1;
			else
				return 0;
	    }
	    
	    
	    /**
	 	* @return string
	 	* @param int $idexpediente
	 	* @desc Retorna el nombre del expediente...
	 	*/
	    /*
	    function nombreexpediente($idexpediente) {
	    	$sqlText = <<<mya
	    		SELECT cli_apellido,cli_nombre
	    		FROM expediente
	    		WHERE cli_id = $idexpediente
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
	    */
	}
?>