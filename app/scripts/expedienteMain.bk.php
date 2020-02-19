<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	header('Content-Type: application/xml; charset=iso-8859-1');
	
	include_once("includes/conexion.php");
	include_once("class/expedienteClase.php");
	$expediente = new expediente($conn);
	/*
	$cmbOptTipoExpediente=$expediente->bbComboOption("tipoexpediente");
	$cmbOptEstadoExpediente=$expediente->bbComboOption("estadoexpediente");	
    */
	
?>
<div id="area-trabajo"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:b="http://www.backbase.com/2006/btl"
	xmlns:c="http://www.backbase.com/2006/command"
	xmlns:e="http://www.backbase.com/2006/xel"
	xmlns:bf="http://www.backbase.com/2007/forms"
	xmlns:xi="http://www.w3.org/2001/XInclude">
	<b:tabBox height="auto" width="auto">
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
<?=$expediente->bbNuevo();?>
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
                                    <c:destroy with="id('tbEliminar')" />
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
																Volver a Principal
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
<?=$expediente->bbEditar();?>
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
							<b:toolBarButton icon="icon-eliminar" id="tbEliminar">
								<e:handler event="click">
									<e:if test="javascript:indice>=0">
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.show();
										</e:script>
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
<?=$expediente->bbEliminar();?>
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
								Eliminar
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
<?=$expediente->bbListar();?>
						<c:destroy with="id('tbNuevo')" />
						<c:destroy with="id('tbListar')" />
						<e:script type="application/javascript">
							var oLoadingMessage = bb.document.getElementById('mensajeespera');
							oLoadingMessage.hide();
						</e:script>
					</e:handler>
					Administrar
				</b:toolBarButton>
			</b:toolBar>
			<div id="area-usuario" >
<?=$expediente->bbMostrarGrid();?>            
            </div>
		</b:tab>
	</b:tabBox>
</div>