<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
?>
<e:fragment
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:b="http://www.backbase.com/2006/btl"
	xmlns:c="http://www.backbase.com/2006/command"
	xmlns:e="http://www.backbase.com/2006/xel"
	xmlns:xi="http://www.w3.org/2001/XInclude">
	<div id="appHeader">
		<div class="appHeaderLogo"></div> 
		<div class="appHeaderText">CEP Expedientes</div>
	</div>
	<b:stretch>
		<b:panelSet columns="260px *">
			<b:panel class="btl-border-right">
				<b:accordion height="100%">
					<b:accordionItem icon="backbaseWindow" label="Agenda">
						<b:tree height="auto">
							<b:treeLeaf label="Agenda">
								<e:handler event="click">									
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.show();
								</e:script>
								<!--
                                <c:load url="../agenda.xml" destination="id('area-trabajo')" mode="replace" />
                                                                            -->
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.hide();
								</e:script>										
								</e:handler>
							</b:treeLeaf>
                            <b:treeLeaf label="Notificaciones">								
                                <e:handler event="click">
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.show();
								</e:script>                                
									<!--<c:load url="formacentroCosto.php" destination="id('area-trabajo')" mode="replace" />-->
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.hide();
								</e:script>
								</e:handler>
							</b:treeLeaf>
                            <b:treeLeaf label="Plazos">
								<e:handler event="click">
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.show();
								</e:script>
									<!--<c:load url="formacentroCosto.php" destination="id('area-trabajo')" mode="replace" />-->
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.hide();
								</e:script>
								</e:handler>
							</b:treeLeaf>
                            <b:treeLeaf label="Citaciones">
								<e:handler event="click">
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.show();
								</e:script>
									<!--<c:load url="formacentroCosto.php" destination="id('area-trabajo')" mode="replace" />-->
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.hide();
								</e:script>
								</e:handler>
							</b:treeLeaf>
                            <b:treeLeaf label="Tareas">
								<e:handler event="click">
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.show();
								</e:script>
									<!--<c:load url="formacentroCosto.php" destination="id('area-trabajo')" mode="replace" />-->
								<e:script type="application/javascript">
									var oLoadingMessage = bb.document.getElementById('mensajeespera');
									oLoadingMessage.hide();
								</e:script>
								</e:handler>
							</b:treeLeaf>
<!--
						   	<b:treeBranch label="Novedades" open="false">
							   <b:treeLeaf label="Registro Novedades">
									<e:handler event="click">
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.show();
										</e:script>
										<c:load url="novedad/formaNovedad.php" destination="id('area-trabajo')" mode="replace" />
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.hide();
										</e:script>
									</e:handler>
							   </b:treeLeaf>
							   <b:treeLeaf label="Consulta Novedades">
									<e:handler event="click">
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.show();
										</e:script>
										<c:load url="vales.php" destination="id('area-trabajo')" mode="replace" />
										<e:script type="application/javascript">
											var oLoadingMessage = bb.document.getElementById('mensajeespera');
											oLoadingMessage.hide();
										</e:script>
									</e:handler>
							   </b:treeLeaf>	
							</b:treeBranch>
							<b:treeBranch label="Reportes" open="false">
                            
							   <b:treeLeaf label="Tipos de Gasto por Centro de Costo">
									<e:handler event="click">
										<c:load url="tipoGastoxCC.php" destination="id('area-trabajo')" mode="replace" />
									</e:handler>
								</b:treeLeaf>
								<b:treeLeaf label="Tipos de Gasto por ciudad">
									<e:handler event="click">
										<c:load url="../movimientoxCiudad.xml" destination="id('area-trabajo')" mode="replace" />
									</e:handler>
								</b:treeLeaf>								
							</b:treeBranch>									
-->						
                        </b:tree>
					</b:accordionItem>
                    <b:accordionItem icon="backbaseWindow" label="Expedientes / Casos">
						<b:tree height="auto">
                            <b:treeLeaf label="Todos" >
								<e:handler event="click">
								  <!-- mostrar mensajeEspera -->
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.show();
								  </e:script>                                
								<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
								  <!-- ocultar mensajeEspera -->
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.hide();
								  </e:script>                                
                                </e:handler>							   
							</b:treeLeaf>  
						    <b:treeLeaf label="Abiertos" >
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
							</b:treeLeaf>
                            <b:treeLeaf label="Inactivos" >
								<e:handler event="click">
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.show();
								  </e:script>                             
								<c:load url="expedienteMain.php" destination="id('area-trabajo')" mode="replace" />
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.show();
								  </e:script>                             
                                </e:handler>							   
							</b:treeLeaf>
						</b:tree>
					</b:accordionItem>
					<b:accordionItem icon="backbaseWindow" label="Contactos">
						<b:tree height="auto">
                            <b:treeLeaf label="Clientes" >
								<e:handler event="click">
								  <!-- mostrar mensajeEspera -->
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.show();
								  </e:script>
								    <!-- accion -->
								    <c:load url="clienteMain.php" destination="id('area-trabajo')" mode="replace" />
								  <!-- ocultar mensajeEspera -->
								  <e:script type="application/javascript">
								    var oLoadingMessage = bb.document.getElementById('mensajeespera');
								    oLoadingMessage.hide();
								  </e:script>
                                </e:handler>							   
							</b:treeLeaf>
						</b:tree>
					</b:accordionItem>
				</b:accordion>
				<b:loadingMessage id="mensajeespera"> 
					Un momento por favor...
				</b:loadingMessage>
			</b:panel>
			<b:panel class="btl-border-left">			
				<div id="area-trabajo" />
			</b:panel>
		</b:panelSet>
	</b:stretch>
</e:fragment>