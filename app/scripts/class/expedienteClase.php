<?php
	/*
		Clase expediente
	*/
	
	class expediente {
		/**
		 * Variable de conexión a Base de Datos
		 *
		 * @var conexion
		 */
		var $base;
		
		var $prefijo;
		var $sufijo;
		var $id;
		
		var $comboTipoExpediente;
		var $comboEstadoExpediente;
		
		var $cadModalPropios;
	
	    /**
	    * @return void
	    * @desc Constructor de la clase
	    */
	    function expediente(&$base) {
	    	$this->base = $base;
	    	$this->cargaCombos();
	    	$this->cargaModales();
	    }
	    
	    function cargaCombos()
	    {
	    	$this->comboTipoExpediente=$this->bbComboOption("tipoexpediente");
	    	$this->comboEstadoExpediente=$this->bbComboOption("estadoexpediente");
	    }
	    
	    function cargaModales()
	    {
	    	$this->cadModalPropios=$this->ModalPropios();
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
		    	select estexp_id,estexp_nombre from estadoexpediente order by estexp_orden
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
	    	where tipexp_id='$tipexpId'
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
	 	* @return bool
	 	* @param int $idexpediente
	 	* @desc Elimina un expediente...
	 	*/
	    function eliminarExpediente($idexpediente) 
	    {
		  $sql=<<<mya
	delete from clienteexpediente 
	where exp_id=$idexpediente	  
mya;
		  $rs = &$this->base->execute($sql);

		  $sql=<<<mya
	delete from archivo 
	where exp_id=$idexpediente	  
mya;
		  $rs = &$this->base->execute($sql);
		  
		  $sql=<<<mya
	delete from accion 
	where exp_id=$idexpediente	  
mya;
		  $rs = &$this->base->execute($sql);
		  
		  $sql=<<<mya
	delete from asuntoopcionasunto  
	where asu_id in 
	(
	  select distinct asu_id 
	  from asunto 
	  where exp_id=$idexpediente
	)
mya;
		  $rs = &$this->base->execute($sql);

		  $sql=<<<mya
	delete from asunto 
	where exp_id=$idexpediente	  
mya;
		  $rs = &$this->base->execute($sql);
		  
		  $sql=<<<mya
	delete from expediente 
	where exp_id=$idexpediente	  
mya;
		  $rs = &$this->base->execute($sql);
			
		  return($idexpediente);
	    }
	    
	    function bbNuevo()
	    {
	    	$cmbOptTipoExpediente=$this->comboTipoExpediente;
	    	$cmbOptEstadoExpediente=$this->comboEstadoExpediente;
	    	
	    	$cad=<<<mya
						<c:create destination="id('area-usuario')" mode="replace">
							<div id="area-usuario">
								<b:box width="auto" height="auto" padding="10px">
									<form id="registro" name="registro" method="POST" action="expedienteOpciones.php?accion=i" bf:destination="id('area-usuario')" bf:mode="replace">
  <b:tabBox class="auto_BB_ID_288" height="400px" width="480px">
	<b:tab label="Datos Expediente" class="textBackground auto_BB_ID_389">
	  <div id="texpedientes" style="width:100%; height:100%;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;" class="auto_BB_ID_390">
<!-- TablaNuevo -->	  
		            <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_274">
		              <tr class="auto_BB_ID_275">
		                <td class="auto_BB_ID_276">Tipo Expediente:</td>
		                <td class="auto_BB_ID_277">
		                  <b:comboBox name="tTipexpId" id="tTipexpId" class="auto_BB_ID_278">
							$cmbOptTipoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_280">*</span>
		                  <bf:messages class="error-text auto_BB_ID_281">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_282">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>  
		              <tr class="auto_BB_ID_329">
		                <td class="auto_BB_ID_330">Estado Expediente:</td>
		                <td class="auto_BB_ID_331">
		                  <b:comboBox name="tEstexpId" id="tEstexpId" class="auto_BB_ID_332">
							$cmbOptEstadoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_334">*</span>
		                  <bf:messages class="error-text auto_BB_ID_335">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_336">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_337">
		                <td class="auto_BB_ID_338">Prefijo:</td>
		                <td class="auto_BB_ID_349">
		                  <input type="text" value="" name="tPrefijo" id="tPrefijo" class="auto_BB_ID_350" />  
		                  <span class="required auto_BB_ID_355">*</span>
		                  <bf:messages class="error-text auto_BB_ID_356">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_357">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>  
		              </tr>
		              <tr class="auto_BB_ID_361">
		                <td class="auto_BB_ID_362">Sufijo:</td>
		                <td class="auto_BB_ID_363">
		                  <input type="text" value="" name="tSufijo" id="tSufijo" class="auto_BB_ID_364"/>  
		                  <span class="required auto_BB_ID_365">*</span>
		                  <bf:messages class="error-text auto_BB_ID_366">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_367">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <input type="hidden" name="tFormato" id="tFormato" value="" />
		              <tr class="auto_BB_ID_375">
		                <td class="auto_BB_ID_376">NIG:</td>
		                <td class="auto_BB_ID_377">
		                  <input type="text" value="" name="tNig" id="tNig" class="auto_BB_ID_378"/>  
		                  <span class="required auto_BB_ID_379">*</span>
		                  <bf:messages class="error-text auto_BB_ID_380">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_381">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_382">
		                <td class="auto_BB_ID_383">Nro. Autos:</td>
		                <td class="auto_BB_ID_384">
		                  <input type="text" value="" name="tNroautos" id="tNroautos" class="auto_BB_ID_343"/>  
		                  <span class="required auto_BB_ID_385">*</span>
		                  <bf:messages class="error-text auto_BB_ID_386">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_387">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_388">
		                <td class="auto_BB_ID_389">Referencias:</td>
		                <td class="auto_BB_ID_339">
		                  <textarea class="auto_BB_ID_459" name="tReferencias" id="tReferencias" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_340">*</span>
		                  <bf:messages class="error-text auto_BB_ID_341">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_342">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_393">
		                <td class="auto_BB_ID_394">Fecha Apertura:</td>
		                <td class="auto_BB_ID_395">
		                  <b:calendar name="tFechaapertura" format="yyyy-MM-dd" id="tFechaapertura" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" />
		                  <span class="required auto_BB_ID_396">*</span>
		                  <bf:messages class="error-text auto_BB_ID_397">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_402">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_403">
		                <td class="auto_BB_ID_404">Fecha Cierre:</td>
		                <td class="auto_BB_ID_405">
		                  <b:calendar name="tFechacierre" format="yyyy-MM-dd" id="tFechacierre" value="" />
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_410">
		                <td class="auto_BB_ID_411">Observaci&oacute;n:</td>
		                <td class="auto_BB_ID_412">
		                  <textarea class="auto_BB_ID_413" name="tObservacion" id="tObservacion" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_414">*</span>
		                  <bf:messages class="error-text auto_BB_ID_415">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_416">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		            </table>
<!-- TablaNuevoFin -->	  
	  </div>  
	</b:tab>
  </b:tabBox>																		
  </form>
								</b:box>
							</div>							
						</c:create>	    	
mya;
			return $cad;
	    }
	    
	    function bbEditar()
	    {
	    	$cmbOptTipoExpediente=$this->comboTipoExpediente;
	    	$cmbOptEstadoExpediente=$this->comboEstadoExpediente;
	    	
	    	$cad=<<<mya
										<c:create destination="id('area-usuario')" mode="replace">
											<div id="area-usuario">
												<b:box width="auto" height="auto" padding="10px">
													<form id="registro" name="registro" method="POST" action="expedienteOpciones.php?accion=mi" bf:destination="id('area-usuario')" bf:mode="replace">
													<input type="hidden" name="idExpediente" id="idExpediente" />

  <b:tabBox class="auto_BB_ID_288" height="400px" width="auto">
	<b:tab label="Datos Expediente" class="textBackground auto_BB_ID_389">
	  <div id="texpedientes" style="width:100%; height:100%;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;" class="auto_BB_ID_390">
	  <!-- TablaEdit -->
		      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_274">      
			    <tr>
				  <td>
					<table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_274">
		              <tr class="auto_BB_ID_275">
		                <td class="auto_BB_ID_276">Tipo Expediente:</td>
		                <td class="auto_BB_ID_277">
		                  <b:comboBox name="tTipexpId" id="tTipexpId" class="auto_BB_ID_278">
							$cmbOptTipoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_280">*</span>
		                  <bf:messages class="error-text auto_BB_ID_281">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_282">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>  
		              <tr class="auto_BB_ID_329">
		                <td class="auto_BB_ID_330">Estado Expediente:</td>
		                <td class="auto_BB_ID_331">
		                  <b:comboBox name="tEstexpId" id="tEstexpId" class="auto_BB_ID_332">
							$cmbOptEstadoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_334">*</span>
		                  <bf:messages class="error-text auto_BB_ID_335">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_336">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_337">
		                <td class="auto_BB_ID_338">Prefijo:</td>
		                <td class="auto_BB_ID_349">
		                  <input type="text" value="" name="tPrefijo" id="tPrefijo" class="auto_BB_ID_350" />  
		                  <span class="required auto_BB_ID_355">*</span>
		                  <bf:messages class="error-text auto_BB_ID_356">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_357">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>  
		              </tr>
		              <tr class="auto_BB_ID_361">
		                <td class="auto_BB_ID_362">Sufijo:</td>
		                <td class="auto_BB_ID_363">
		                  <input type="text" value="" name="tSufijo" id="tSufijo" class="auto_BB_ID_364"/>  
		                  <span class="required auto_BB_ID_365">*</span>
		                  <bf:messages class="error-text auto_BB_ID_366">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_367">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <input type="hidden" name="tFormato" id="tFormato" value="" />
		              <tr class="auto_BB_ID_375">
		                <td class="auto_BB_ID_376">NIG:</td>
		                <td class="auto_BB_ID_377">
		                  <input type="text" value="" name="tNig" id="tNig" class="auto_BB_ID_378"/>  
		                  <span class="required auto_BB_ID_379">*</span>
		                  <bf:messages class="error-text auto_BB_ID_380">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_381">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_382">
		                <td class="auto_BB_ID_383">Nro. Autos:</td>
		                <td class="auto_BB_ID_384">
		                  <input type="text" value="" name="tNroautos" id="tNroautos" class="auto_BB_ID_343"/>  
		                  <span class="required auto_BB_ID_385">*</span>
		                  <bf:messages class="error-text auto_BB_ID_386">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_387">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_388">
		                <td class="auto_BB_ID_389">Referencias:</td>
		                <td class="auto_BB_ID_339">
		                  <textarea class="auto_BB_ID_459" name="tReferencias" id="tReferencias" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_340">*</span>
		                  <bf:messages class="error-text auto_BB_ID_341">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_342">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_393">
		                <td class="auto_BB_ID_394">Fecha Apertura:</td>
		                <td class="auto_BB_ID_395">
		                  <b:calendar name="tFechaapertura" format="yyyy-MM-dd" id="tFechaapertura" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_435"/>
		                  <span class="required auto_BB_ID_396">*</span>
		                  <bf:messages class="error-text auto_BB_ID_397">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_402">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_403">
		                <td class="auto_BB_ID_404">Fecha Cierre:</td>
		                <td class="auto_BB_ID_405">
		                  <b:calendar name="tFechacierre" format="yyyy-MM-dd" id="tFechacierre" value="" class="auto_BB_ID_406"/>
		                  
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_410">
		                <td class="auto_BB_ID_411">Observaci&oacute;n:</td>
		                <td class="auto_BB_ID_412">
		                  <textarea class="auto_BB_ID_413" name="tObservacion" id="tObservacion" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_414">*</span>
		                  <bf:messages class="error-text auto_BB_ID_415">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_416">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		            </table>
			      </td>
				  <td>
				    Boton <br />
				    <b:button>
				      Do not push this button!
				      <e:handler event="click" type="application/xml">
				        <e:call method="setAttribute" with="id('modalPropios')" name="'open'" value="'true'" />
				      </e:handler>
				    </b:button>
				    <b:modal label="Warning" id="modalPropios" padding="10px" dragConstraint="/*" icon="icon-bb-window">
				      $this->cadModalPropios
				    </b:modal> 
				    
				  </td>
				</tr>
			  </table>
	  <!-- TablaEditFin -->	  
	  </div>  
	</b:tab>
  </b:tabBox>                                                    
                                                    
                                                    </form>
												</b:box>
											</div>
										</c:create>
mya;
			return $cad;
	    }
	    
	    function bbEliminar()
	    {
	    	$cmbOptTipoExpediente=$this->comboTipoExpediente;
	    	$cmbOptEstadoExpediente=$this->comboEstadoExpediente;
	    	
	    	$cad=<<<mya
										<c:create destination="id('area-usuario')" mode="replace">
											<div id="area-usuario">
												<b:box width="auto" height="auto" padding="10px">
													<form id="registro" name="registro" method="POST" action="expedienteOpciones.php?accion=md" bf:destination="id('area-usuario')" bf:mode="replace">
													<input type="hidden" name="idExpediente" id="idExpediente" />

  <b:tabBox class="auto_BB_ID_288" height="400px" width="auto">
	<b:tab label="Datos Expediente" class="textBackground auto_BB_ID_389">
	  <div id="texpedientes" style="width:100%; height:100%;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;" class="auto_BB_ID_390">
	  <!-- TablaEdit -->
		      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_274">      
			    <tr>
				  <td>
					<table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_274">
		              <tr class="auto_BB_ID_275">
		                <td class="auto_BB_ID_276">Tipo Expediente:</td>
		                <td class="auto_BB_ID_277">
		                  <b:comboBox name="tTipexpId" id="tTipexpId" class="auto_BB_ID_278">
							$cmbOptTipoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_280">*</span>
		                  <bf:messages class="error-text auto_BB_ID_281">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_282">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>  
		              <tr class="auto_BB_ID_329">
		                <td class="auto_BB_ID_330">Estado Expediente:</td>
		                <td class="auto_BB_ID_331">
		                  <b:comboBox name="tEstexpId" id="tEstexpId" class="auto_BB_ID_332">
							$cmbOptEstadoExpediente
		                  </b:comboBox>
		                  <span class="required auto_BB_ID_334">*</span>
		                  <bf:messages class="error-text auto_BB_ID_335">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_336">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_337">
		                <td class="auto_BB_ID_338">Prefijo:</td>
		                <td class="auto_BB_ID_349">
		                  <input type="text" value="" name="tPrefijo" id="tPrefijo" class="auto_BB_ID_350" />  
		                  <span class="required auto_BB_ID_355">*</span>
		                  <bf:messages class="error-text auto_BB_ID_356">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_357">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>  
		              </tr>
		              <tr class="auto_BB_ID_361">
		                <td class="auto_BB_ID_362">Sufijo:</td>
		                <td class="auto_BB_ID_363">
		                  <input type="text" value="" name="tSufijo" id="tSufijo" class="auto_BB_ID_364"/>  
		                  <span class="required auto_BB_ID_365">*</span>
		                  <bf:messages class="error-text auto_BB_ID_366">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_367">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <input type="hidden" name="tFormato" id="tFormato" value="" />
		              <tr class="auto_BB_ID_375">
		                <td class="auto_BB_ID_376">NIG:</td>
		                <td class="auto_BB_ID_377">
		                  <input type="text" value="" name="tNig" id="tNig" class="auto_BB_ID_378"/>  
		                  <span class="required auto_BB_ID_379">*</span>
		                  <bf:messages class="error-text auto_BB_ID_380">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_381">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_382">
		                <td class="auto_BB_ID_383">Nro. Autos:</td>
		                <td class="auto_BB_ID_384">
		                  <input type="text" value="" name="tNroautos" id="tNroautos" class="auto_BB_ID_343"/>  
		                  <span class="required auto_BB_ID_385">*</span>
		                  <bf:messages class="error-text auto_BB_ID_386">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_387">
		                      Ingrese valor
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_388">
		                <td class="auto_BB_ID_389">Referencias:</td>
		                <td class="auto_BB_ID_339">
		                  <textarea class="auto_BB_ID_459" name="tReferencias" id="tReferencias" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_340">*</span>
		                  <bf:messages class="error-text auto_BB_ID_341">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_342">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_393">
		                <td class="auto_BB_ID_394">Fecha Apertura:</td>
		                <td class="auto_BB_ID_395">
		                  <b:calendar name="tFechaapertura" format="yyyy-MM-dd" id="tFechaapertura" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_435"/>
		                  <span class="required auto_BB_ID_396">*</span>
		                  <bf:messages class="error-text auto_BB_ID_397">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_402">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_403">
		                <td class="auto_BB_ID_404">Fecha Cierre:</td>
		                <td class="auto_BB_ID_405">
		                  <b:calendar name="tFechacierre" format="yyyy-MM-dd" id="tFechacierre" value="" class="auto_BB_ID_406"/>
		                  
		                </td>
		              </tr>
		              <tr class="auto_BB_ID_410">
		                <td class="auto_BB_ID_411">Observaci&oacute;n:</td>
		                <td class="auto_BB_ID_412">
		                  <textarea class="auto_BB_ID_413" name="tObservacion" id="tObservacion" bf:required="true" bf:messagesRef="../bf:messages[1]" >
		                  </textarea>
		                  <span class="required auto_BB_ID_414">*</span>
		                  <bf:messages class="error-text auto_BB_ID_415">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_416">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
		                </td>
		              </tr>
		            </table>
			      </td>
				  <td>
				  Boton
				  </td>
				</tr>
			  </table>
	  <!-- TablaEditFin -->	  
	  </div>  
	</b:tab>
  </b:tabBox>                                                    
                                                    
                                                    </form>
												</b:box>
											</div>
										</c:create>
mya;
			return $cad;
	    }
	    
	    function bbListar()
	    {
	    	$cad=<<<mya
	    							<c:create destination="id('area-usuario')" mode="replace">
							<div id="area-usuario">
								<b:box width="auto" height="400px" backgroundColor="#FFFFFF"> 
									<b:listGrid id="lista-expediente" name="lista-expediente" width="auto" height="90%" readonly="true" rowClasses="rowClass1, rowClass2">
										<b:dataSource id="dsExpedientes" name="dsExpedientes" e:behavior="b:remoteData" url="expedienteOpciones.php?accion=l" dataType="application/xml" />
										<b:listGridCol select="idExpediente" label="Id" width="40px" />
										
										<b:listGridCol select="codigo" label="C&oacute;digo" width="100px" />
										<b:listGridCol select="tipexp" label="Tipo Expediente" width="150px" />
										<b:listGridCol select="estexp" label="Estado Expediente" width="130px" />
										<b:listGridCol select="nig" label="NIG" width="80px" />
                                        <b:listGridCol select="nroautos" label="Nro. Autos" width="80px" />
                                        <b:listGridCol select="referencias" label="Referencias" width="180px" />
                                        <b:listGridCol select="fechaapertura" label="F. Apertura" width="80px" />
                                        <b:listGridCol select="fechacierre" label="F. Cierre" width="80px" />
                                        <b:listGridCol select="observacion" label="Observaci&oacute;n" width="180px" />
									</b:listGrid>
									<e:handler event="click" type="application/javascript">
										var lista = bb.document.getElementById('lista-expediente');
										var sIndex = lista.getProperty('selectedIndex');
										indice = sIndex;
									</e:handler>
								</b:box>
							</div>
						</c:create>
mya;
	    	return $cad;
	    }
	    
	    function bbMostrarGrid()
	    {
	    	$cad=<<<mya
								<b:box width="auto" height="400px" backgroundColor="#FFFFFF"> 
									<b:listGrid id="lista-expediente" name="lista-expediente" width="auto" height="90%" readonly="true" rowClasses="rowClass1, rowClass2">
										<b:dataSource id="dsExpedientes" name="dsExpedientes" e:behavior="b:remoteData" url="expedienteOpciones.php?accion=l" dataType="application/xml" />
										<b:listGridCol select="idExpediente" label="Id" width="40px" />
										
										<b:listGridCol select="codigo" label="C&oacute;digo" width="100px" />
										<b:listGridCol select="tipexp" label="Tipo Expediente" width="150px" />
										<b:listGridCol select="estexp" label="Estado Expediente" width="130px" />
										<b:listGridCol select="nig" label="NIG" width="80px" />
                                        <b:listGridCol select="nroautos" label="Nro. Autos" width="80px" />
                                        <b:listGridCol select="referencias" label="Referencias" width="180px" />
                                        <b:listGridCol select="fechaapertura" label="F. Apertura" width="80px" />
                                        <b:listGridCol select="fechacierre" label="F. Cierre" width="80px" />
                                        <b:listGridCol select="observacion" label="Observaci&oacute;n" width="180px" />
									</b:listGrid>
									<e:handler event="click" type="application/javascript">
										var lista = bb.document.getElementById('lista-expediente');
										var sIndex = lista.getProperty('selectedIndex');
										indice = sIndex;
									</e:handler>
								</b:box>
mya;
	    	return $cad;
	    }
	    

	    function ModalPropios()
	    {
	    	$cad=<<<mya
		  <table>	
	    	<tr>
		      <td class="auto_BB_ID_418"> 
		        <b:button class="auto_BB_ID_421">Propios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b:button>
		        <br class="auto_BB_ID_422"/>
		        <b:button class="auto_BB_ID_423">Contrarios&nbsp;</b:button>
		        <br class="auto_BB_ID_424"/>
		        <b:button class="auto_BB_ID_426">Comunes&nbsp;&nbsp;&nbsp;</b:button>
		        <br class="auto_BB_ID_427"/>
		        <b:button class="auto_BB_ID_429">Asunto(s)&nbsp;&nbsp;</b:button>
		        <br class="auto_BB_ID_430"/>
		        <b:button class="auto_BB_ID_432">Acci&oacute;n(es)&nbsp;</b:button>
		        <br class="auto_BB_ID_433"/>
		        <b:button class="auto_BB_ID_419">Archivo(s)&nbsp;</b:button>
		      </td>
		    </tr>
		  
		  </table>
		  
mya;

	    	return($cad);
	    }
	    
	}
?>