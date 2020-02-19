<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	header('Content-Type: application/xml; charset=iso-8859-1');
	
	include_once("includes/conexion.php");
	include_once("class/clienteClase.php");
	$cliente = new cliente($conn);
	
?>
<div id="area-trabajo"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:b="http://www.backbase.com/2006/btl"
	xmlns:c="http://www.backbase.com/2006/command"
	xmlns:e="http://www.backbase.com/2006/xel"
	xmlns:bf="http://www.backbase.com/2007/forms"
	xmlns:xi="http://www.w3.org/2001/XInclude">
	<b:tabBox height="500px">
		<b:tab icon="backbaseWindow" label="Mantenimiento Clientes" class="textBackground">
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
													<c:load url="clienteMain.php" destination="id('area-trabajo')" mode="replace" />
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
									<c:load url="clienteMain.php" destination="id('area-trabajo')" mode="replace" />
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
									<form id="registro" name="registro" method="POST" action="clienteOpciones.php?accion=i" bf:destination="id('area-usuario')" bf:mode="replace">
  <b:tabBox class="auto_BB_ID_288" height="400px" width="480px">
	<b:tab label="Datos Cliente" class="textBackground auto_BB_ID_389">
	  <div id="tclientes" style="width:100%; height:100%;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;" class="auto_BB_ID_390">
	  
	  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_391">
		<tr class="auto_BB_ID_309">
		  <td class="auto_BB_ID_310">Tipo Cliente:</td>
		  <td class="auto_BB_ID_311">
		    <b:comboBox name="tTipcliId" class="auto_BB_ID_392" filter="true" id="tTipclidId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("tipocliente"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_398">*</span>
		    <bf:messages class="error-text auto_BB_ID_399">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_400">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_315">
		  <td class="auto_BB_ID_316">Sexo:</td>
		  <td class="auto_BB_ID_317">
		    <b:comboBox name="tSexId" class="auto_BB_ID_318" filter="true" id="tSexId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("sexo"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_394">*</span>
		    <bf:messages class="error-text auto_BB_ID_395">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_396">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_321">
		  <td class="auto_BB_ID_322">Estado Civil:</td>
		  <td class="auto_BB_ID_323">
		    <b:comboBox name="tEstcivId" class="auto_BB_ID_324" filter="true" id="tEstcivId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("estadocivil"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_401">*</span>
		    <bf:messages class="error-text auto_BB_ID_402">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_403">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_407">
		  <td class="auto_BB_ID_408">C&eacute;dula:</td>
		  <td class="auto_BB_ID_409">
		    <input type="text" name="tCedula" value="" class="auto_BB_ID_410" id="tCedula" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_411">*</span>
		    <bf:messages class="error-text auto_BB_ID_412">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_413">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_327">
		  <td class="auto_BB_ID_328">RUC:</td>
		  <td class="auto_BB_ID_329">
		    <input type="text" name="tRuc" value="" class="auto_BB_ID_380" id="tRuc" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_404">*</span>
		    <bf:messages class="error-text auto_BB_ID_405">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_406">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_414">
		  <td class="auto_BB_ID_415">Nombre:</td>
		  <td class="auto_BB_ID_416">
		    <input type="text" name="tNombre" value="" class="auto_BB_ID_417" id="tNombre" bf:required="false" bf:messagesRef="../bf:messages[1]"/>
		    
		    <bf:messages class="error-text auto_BB_ID_419">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_420">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_421">
		  <td class="auto_BB_ID_422">Apellido:</td>
		  <td class="auto_BB_ID_423">
		    <input type="text" name="tApellido" value="" class="auto_BB_ID_424" id="tApellido" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_425">*</span>
		    <bf:messages class="error-text auto_BB_ID_426">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_427">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_428">
		  <td class="auto_BB_ID_429">Fecha Nacimiento:</td>
		  <td class="auto_BB_ID_430">
		    <b:calendar name="tFechanacimiento" format="yyyy-MM-dd" id="tFechanacimiento" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_435"/>
		    <span class="required auto_BB_ID_432">*</span>
		    <bf:messages class="error-text auto_BB_ID_433">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_434">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_437">
		  <td class="auto_BB_ID_438">Direcci&oacute;n:</td>
		  <td class="auto_BB_ID_439">
		    <textarea class="auto_BB_ID_459" name="tDireccion" id="tDireccion" bf:required="true" bf:messagesRef="../bf:messages[1]" ></textarea>
		    <span class="required auto_BB_ID_441">*</span>
		    <bf:messages class="error-text auto_BB_ID_442">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_443">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>		  
		  </td>
		</tr>
		<tr class="auto_BB_ID_444">
		  <td class="auto_BB_ID_445">Tel&eacute;fono:</td>
		  <td class="auto_BB_ID_446">
		    <input type="text" name="tTelefono" value="" class="auto_BB_ID_447" id="tTelefono" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_448">*</span>
		    <bf:messages class="error-text auto_BB_ID_449">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_450">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_451">
		  <td class="auto_BB_ID_452">E-mail:</td>
		  <td class="auto_BB_ID_453">
		    <input type="text" name="tEmail" value="" class="auto_BB_ID_454" id="tEmail" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_455">*</span>
		    <bf:messages class="error-text auto_BB_ID_456">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_457">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
	  </table>
	  </div>  
	</b:tab>
  </b:tabBox>																		</form>
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
																	<c:load url="clienteMain.php" destination="id('area-trabajo')" mode="replace" />
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
											var lista = bb.document.getElementById('lista-cliente');
											var sIndex = lista.getProperty('selectedIndex');
											var oSource = bb.document.getElementById('dsClientes');
											var selectedCliente = btl.dataSource.getValue(oSource,  sIndex, 'idCliente');
											this._.selectedCliente = selectedCliente
										</e:script>
										<e:variable name="datosClientes">
											<e:call function="cargaDatosCliente">
												<e:with-argument name="idCliente" select="javascript:this._.selectedCliente" />
											</e:call>
										</e:variable>
										<c:create destination="id('area-usuario')" mode="replace">
											<div id="area-usuario">
												<b:box width="auto" height="auto" padding="10px">
													<form id="registro" name="registro" method="POST" action="clienteOpciones.php?accion=mi" bf:destination="id('area-usuario')" bf:mode="replace">
													<input type="hidden" name="idCliente" id="idCliente" />

  <b:tabBox class="auto_BB_ID_288" height="400px" width="480px">
	<b:tab label="Datos Cliente" class="textBackground auto_BB_ID_389">
	  <div id="tclientes" style="width:100%; height:100%;background-color:#f5f5f5;border :1px solid Silver;; overflow:auto;" class="auto_BB_ID_390">
	  
	  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" class="auto_BB_ID_391">
		<tr class="auto_BB_ID_309">
		  <td class="auto_BB_ID_310">Tipo Cliente:</td>
		  <td class="auto_BB_ID_311">
		    <b:comboBox name="tTipcliId" class="auto_BB_ID_392" filter="true" id="tTipcliId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("tipocliente"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_398">*</span>
		    <bf:messages class="error-text auto_BB_ID_399">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_400">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_315">
		  <td class="auto_BB_ID_316">Sexo:</td>
		  <td class="auto_BB_ID_317">
		    <b:comboBox name="tSexId" class="auto_BB_ID_318" filter="true" id="tSexId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("sexo"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_394">*</span>
		    <bf:messages class="error-text auto_BB_ID_395">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_396">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_321">
		  <td class="auto_BB_ID_322">Estado Civil:</td>
		  <td class="auto_BB_ID_323">
		    <b:comboBox name="tEstcivId" class="auto_BB_ID_324" filter="true" id="tEstcivId" bf:required="true" bf:messagesRef="../bf:messages[1]">
		      <?php
		        echo($cliente->bbComboOption("estadocivil"));
		      ?>
		    </b:comboBox>
		    <span class="required auto_BB_ID_401">*</span>
		    <bf:messages class="error-text auto_BB_ID_402">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_403">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_407">
		  <td class="auto_BB_ID_408">C&eacute;dula:</td>
		  <td class="auto_BB_ID_409">
		    <input type="text" name="tCedula" value="" class="auto_BB_ID_410" id="tCedula" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_411">*</span>
		    <bf:messages class="error-text auto_BB_ID_412">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_413">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_327">
		  <td class="auto_BB_ID_328">RUC:</td>
		  <td class="auto_BB_ID_329">
		    <input type="text" name="tRuc" value="" class="auto_BB_ID_380" id="tRuc" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_404">*</span>
		    <bf:messages class="error-text auto_BB_ID_405">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_406">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_414">
		  <td class="auto_BB_ID_415">Nombre:</td>
		  <td class="auto_BB_ID_416">
		    <input type="text" name="tNombre" value="" class="auto_BB_ID_417" id="tNombre" bf:required="false" bf:messagesRef="../bf:messages[1]"/>
		    
		    <bf:messages class="error-text auto_BB_ID_419">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_420">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_421">
		  <td class="auto_BB_ID_422">Apellido:</td>
		  <td class="auto_BB_ID_423">
		    <input type="text" name="tApellido" value="" class="auto_BB_ID_424" id="tApellido" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_425">*</span>
		    <bf:messages class="error-text auto_BB_ID_426">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_427">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_428">
		  <td class="auto_BB_ID_429">Fecha Nacimiento:</td>
		  <td class="auto_BB_ID_430">
		    <b:calendar name="tFechanacimiento" format="yyyy-MM-dd" id="tFechanacimiento" value="" bf:required="true" bf:messagesRef="../bf:messages[1]" class="auto_BB_ID_435"/>
		    <span class="required auto_BB_ID_432">*</span>
		    <bf:messages class="error-text auto_BB_ID_433">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_434">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_437">
		  <td class="auto_BB_ID_438">Direcci&oacute;n:</td>
		  <td class="auto_BB_ID_439">
		    <textarea class="auto_BB_ID_459" name="tDireccion" id="tDireccion" bf:required="true" bf:messagesRef="../bf:messages[1]" ></textarea>
		    <span class="required auto_BB_ID_441">*</span>
		    <bf:messages class="error-text auto_BB_ID_442">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_443">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>		  
		  </td>
		</tr>
		<tr class="auto_BB_ID_444">
		  <td class="auto_BB_ID_445">Tel&eacute;fono:</td>
		  <td class="auto_BB_ID_446">
		    <input type="text" name="tTelefono" value="" class="auto_BB_ID_447" id="tTelefono" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_448">*</span>
		    <bf:messages class="error-text auto_BB_ID_449">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_450">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
		<tr class="auto_BB_ID_451">
		  <td class="auto_BB_ID_452">E-mail:</td>
		  <td class="auto_BB_ID_453">
		    <input type="text" name="tEmail" value="" class="auto_BB_ID_454" id="tEmail" bf:required="true" bf:messagesRef="../bf:messages[1]"/>
		    <span class="required auto_BB_ID_455">*</span>
		    <bf:messages class="error-text auto_BB_ID_456">
		      <bf:message event="invalid" facet="required" class="auto_BB_ID_457">
		        Ingrese valor
		      </bf:message>
		    </bf:messages>
		  </td>
		</tr>
	  </table>
	  </div>  
	</b:tab>
  </b:tabBox>                                                    
                                                    
                                                    </form>
												</b:box>
											</div>
										</c:create>
										<e:variable name="idCliente" select="javascript:this._.selectedCliente" />
										<e:set property="value" with="id('idCliente')" select="$idCliente" />
										<e:set property="value" with="id('tTipcliId')" select="string($datosClientes//*[node-name(.) = 'tTipcliId'])" />
										<e:set property="value" with="id('tSexId')" select="string($datosClientes//*[node-name(.) = 'tSexId'])" />
										<e:set property="value" with="id('tEstcivId')" select="string($datosClientes//*[node-name(.) = 'tEstcivId'])" />
										<e:set property="value" with="id('tCedula')" select="string($datosClientes//*[node-name(.) = 'tCedula'])" />
										<e:set property="value" with="id('tRuc')" select="string($datosClientes//*[node-name(.) = 'tRuc'])" />
										<e:set property="value" with="id('tNombre')" select="string($datosClientes//*[node-name(.) = 'tNombre'])" />
										<e:set property="value" with="id('tApellido')" select="string($datosClientes//*[node-name(.) = 'tApellido'])" />
										<e:set property="value" with="id('tFechanacimiento')" select="string($datosClientes//*[node-name(.) = 'tFechanacimiento'])" />
                                        <e:set property="value" with="id('tDireccion')" select="string($datosClientes//*[node-name(.) = 'tDireccion'])" />
                                        <e:set property="value" with="id('tTelefono')" select="string($datosClientes//*[node-name(.) = 'tTelefono'])" />
                                        <e:set property="value" with="id('tEmail')" select="string($datosClientes//*[node-name(.) = 'tEmail'])" />
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
									<c:load url="clienteMain.php" destination="id('area-trabajo')" mode="replace" />
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
									<b:listGrid id="lista-cliente" name="lista-cliente" width="auto" height="90%" readonly="true" rowClasses="rowClass1, rowClass2">
										<b:dataSource id="dsClientes" name="dsClientes" e:behavior="b:remoteData" url="clienteOpciones.php?accion=l" dataType="application/xml" />
										<b:listGridCol select="idCliente" label="Cod." width="40px" />
										<b:listGridCol select="nombre" label="Razón Social" width="210px" />
										<b:listGridCol select="ciruc" label="CI / RUC" width="100px" />
										<b:listGridCol select="telefono" label="Telf." width="100px" />
										<b:listGridCol select="direccion" label="Direcci&oacute;n" width="200px" />
									</b:listGrid>
									<e:handler event="click" type="application/javascript">
										var lista = bb.document.getElementById('lista-cliente');
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