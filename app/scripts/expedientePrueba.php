<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	//header('Content-Type: application/xml; charset=iso-8859-1');
	
	include_once("includes/conexion.php");
	include_once("class/expedienteClase.php");
	$conn->debug=1;
	$expediente = new expediente($conn);
	
	$cmbOptTipoExpediente=$expediente->bbComboOption("tipoexpediente");
	$cmbOptEstadoExpediente=$expediente->bbComboOption("estadoexpediente");	
	
	$cmbOptTipoExpediente="";
	$cmbOptEstadoExpediente="";
	
?>
<div id="area-trabajo"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:b="http://www.backbase.com/2006/btl"
	xmlns:c="http://www.backbase.com/2006/command"
	xmlns:e="http://www.backbase.com/2006/xel"
	xmlns:bf="http://www.backbase.com/2007/forms"
	xmlns:xi="http://www.w3.org/2001/XInclude">
	<b:tabBox height="500px">
		<b:tab icon="backbaseWindow" label="Mantenimiento Expedientes / Casos" class="textBackground">
			<b:toolBar id="mainToolBar">
				<b:toolBarButton icon="icon-nuevo" id="tbNuevo">
					<e:script type="application/javascript">
						var oLoadingMessage = bb.document.getElementById('mensajeespera');
						oLoadingMessage.show();
					</e:script>
					<e:handler event="click">
						<c:create destination="id('mainToolBar')" mode="firstChild">
							<b:toolBarButton icon="icon-guardar" id="tbGuardar">
								<e:handler event="click">
									<e:script event="click" type="application/javascript">
										forma = bb.document.getElementById("registro");
										var saveok = 0;
										if(forma.validate()) {
											saveok = 1;
											forma.submit();		
										}
										this._.saveok = saveok;
									</e:script>
									<e:if test="javascript:this._.saveok==1">
										<c:create destination="id('mainToolBar')" mode="firstChild">
											<b:toolBarButton icon="icon-nuevo" id="tbNuevo">
												<e:handler event="click">
													<e:script type="application/javascript">
														var oLoadingMessage = bb.document.getElementById('mensajeespera');
														oLoadingMessage.show();
													</e:script>
													<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
													<e:script type="application/javascript">
														var oLoadingMessage = bb.document.getElementById('mensajeespera');
														oLoadingMessage.hide();
													</e:script>
												</e:handler>
												Nuevo
											</b:toolBarButton>
										</c:create>
										<c:destroy with="id('tbCancelar')" />
										<c:destroy with="id('tbGuardar')" />
									</e:if>
								</e:handler>
								Guardar
							</b:toolBarButton>
							<b:toolBarButton icon="icon-cancelar" id="tbCancelar">
								<e:handler event="click">
									<e:script type="application/javascript">
										var oLoadingMessage = bb.document.getElementById('mensajeespera');
										oLoadingMessage.show();
									</e:script>
									<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
									<e:script type="application/javascript">
										var oLoadingMessage = bb.document.getElementById('mensajeespera');
										oLoadingMessage.hide();
									</e:script>
								</e:handler>
								Cancelar
							</b:toolBarButton>				
						</c:create>
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
							<?=$cmbOptTipoExpediente ?>
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
							<?=$cmbOptEstadoExpediente ?>
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
		                  <b:calendar name="tFechacierre" format="yyyy-MM-dd" id="tFechacierre" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_406"/>
		                  <span class="required auto_BB_ID_407">*</span>
		                  <bf:messages class="error-text auto_BB_ID_408">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_409">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
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
						<c:destroy with="id('tbListar')" />		
						<c:destroy with="id('tbNuevo')" />
						<e:script type="application/javascript">
							var oLoadingMessage = bb.document.getElementById('mensajeespera');
							oLoadingMessage.hide();
						</e:script>
					</e:handler>
					Nuevo
				</b:toolBarButton>
				<b:toolBarButton icon="icon-listar" id="tbListar">
					<e:variable name="indice" select="'-1'" />
					<e:handler event="click">
						<e:script type="application/javascript">
							var oLoadingMessage = bb.document.getElementById('mensajeespera');
							oLoadingMessage.show();
						</e:script>
						<c:create destination="id('mainToolBar')" mode="lastChild">
							<b:toolBarButton icon="icon-editar" id="tbEditar">
								<e:handler event="click">
									<e:if test="javascript:indice>=0">
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.show();
										</e:script>
										<c:create destination="id('mainToolBar')" mode="firstChild">
											<b:toolBarButton icon="icon-guardar" id="tbGuardar">
												<e:handler event="click">
													<e:script type="application/javascript">
														var oLoadingMessage = bb.document.getElementById('mensajeespera');
														oLoadingMessage.show();
													</e:script>
													<e:script event="click" type="application/javascript">
														forma = bb.document.getElementById("registro");
														var saveok = 0;
														if(forma.validate()) {
															saveok = 1;
															forma.submit();		
														}
														this._.saveok = saveok;
													</e:script>
													<e:if test="javascript:this._.saveok==1">
														<c:create destination="id('mainToolBar')" mode="firstChild">
															<b:toolBarButton icon="icon-nuevo" id="tbNuevo">
																<e:handler event="click">
																	<e:script type="application/javascript">
																		var oLoadingMessage = bb.document.getElementById('mensajeespera');
																		oLoadingMessage.show();
																	</e:script>
																	<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
																	<e:script type="application/javascript">
																		var oLoadingMessage = bb.document.getElementById('mensajeespera');
																		oLoadingMessage.hide();
																	</e:script>
																</e:handler>
																Nuevo
															</b:toolBarButton>
														</c:create>
														<c:destroy with="id('tbCancelar')" />
														<c:destroy with="id('tbGuardar')" />
													</e:if>
													<e:script type="application/javascript">
														var oLoadingMessage = bb.document.getElementById('mensajeespera');
														oLoadingMessage.hide();
													</e:script>
												</e:handler>
												Guardar
											</b:toolBarButton>
										</c:create>
										<e:script type="application/javascript">
											var lista = bb.document.getElementById('lista-expediente');
											var sIndex = lista.getProperty('selectedIndex');
											var oSource = bb.document.getElementById('dsExpedientes');
											var selectedExpediente = btl.dataSource.getValue(oSource,  sIndex, 'idExpediente');
											this._.selectedExpediente = selectedExpediente
										</e:script>
										<e:variable name="datosExpedientes">
											<e:call function="cargaDatosExpediente">
												<e:with-argument name="idExpediente" select="javascript:this._.selectedExpediente" />
											</e:call>
										</e:variable>
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
							<?=$cmbOptTipoExpediente ?>
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
							<?=$cmbOptEstadoExpediente ?>
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
		                  <b:calendar name="tFechacierre" format="yyyy-MM-dd" id="tFechacierre" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_406"/>
		                  <span class="required auto_BB_ID_407">*</span>
		                  <bf:messages class="error-text auto_BB_ID_408">
		                    <bf:message event="invalid" facet="required" class="auto_BB_ID_409">
		                      Ingrese valor 
		                    </bf:message>
		                  </bf:messages>
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
										<!-- carga data Forma -->
										<e:variable name="idExpediente" select="javascript:this._.selectedExpediente" />
										<e:set property="value" with="id('idExpediente')" select="$idExpediente" />
										<e:set property="value" with="id('tTipexpId')" select="string($datosExpedientes//*[node-name(.) = 'tTipexpId'])" />
										<e:set property="value" with="id('tEstexpId')" select="string($datosExpedientes//*[node-name(.) = 'tEstexpId'])" />
										<e:set property="value" with="id('tPrefijo')" select="string($datosExpedientes//*[node-name(.) = 'tPrefijo'])" />
										<e:set property="value" with="id('tSufijo')" select="string($datosExpedientes//*[node-name(.) = 'tSufijo'])" />
										<e:set property="value" with="id('tFormato')" select="string($datosExpedientes//*[node-name(.) = 'tFormato'])" />
										<e:set property="value" with="id('tNig')" select="string($datosExpedientes//*[node-name(.) = 'tNig'])" />
										<e:set property="value" with="id('tNroautos')" select="string($datosExpedientes//*[node-name(.) = 'tNroautos'])" />
										<e:set property="value" with="id('tReferencias')" select="string($datosExpedientes//*[node-name(.) = 'tReferencias'])" />
                                        <e:set property="value" with="id('tFechaapertura')" select="string($datosExpedientes//*[node-name(.) = 'tFechaapertura'])" />
                                        <e:set property="value" with="id('tFechacierre')" select="string($datosExpedientes//*[node-name(.) = 'tFechacierre'])" />
                                        <e:set property="value" with="id('tObservacion')" select="string($datosExpedientes//*[node-name(.) = 'tObservacion'])" />										
										<c:destroy with="id('tbEditar')" />
									</e:if>
									<e:if test="javascript:indice==-1">
										<c:alert select="'No existe un registro seleccionado...!!!'" />
									</e:if>
									<e:script type="application/javascript">
										var oLoadingMessage = bb.document.getElementById('mensajeespera');
										oLoadingMessage.hide();
									</e:script>
								</e:handler>
								Editar
							</b:toolBarButton>
							<b:toolBarButton icon="icon-cancelar" id="tbCancelar">
								<e:handler event="click">
									<e:script type="application/javascript">
										var oLoadingMessage = bb.document.getElementById('mensajeespera');
										oLoadingMessage.show();
									</e:script>
									<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
									<e:script type="application/javascript">
										var oLoadingMessage = bb.document.getElementById('mensajeespera');
										oLoadingMessage.hide();
									</e:script>
								</e:handler>
								Cancelar
							</b:toolBarButton>
						</c:create>
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
						<c:destroy with="id('tbNuevo')" />
						<c:destroy with="id('tbListar')" />
						<e:script type="application/javascript">
							var oLoadingMessage = bb.document.getElementById('mensajeespera');
							oLoadingMessage.hide();
						</e:script>
					</e:handler>
					Listar
				</b:toolBarButton>
			</b:toolBar>
			<div id="area-usuario" />
		</b:tab>
	</b:tabBox>
</div>