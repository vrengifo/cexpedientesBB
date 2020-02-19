<?php
	Header('Cache-Control: no-cache');
  	Header('Pragma: no-cache');
	header('Content-Type: application/xml; charset=iso-8859-1');
?>
<div id="funciones"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:c="http://www.backbase.com/2006/command"
	xmlns:e="http://www.backbase.com/2006/xel">
	
	<e:function name="cargaDatosCliente">
		<e:argument name="idCliente" required="true" />
		<e:body>
			<e:variable name="datosClientes">
				<c:load url="{concat('clienteOpciones.php?accion=mc&amp;idCliente=',$idCliente)}" type="text/xml" />
			</e:variable>
			<e:return select="$datosClientes" />
		</e:body>
	</e:function>
	<e:function name="cargaDatosExpediente">
		<e:argument name="idExpediente" required="true" />
		<e:body>
			<e:variable name="datosExpedientes">
				<c:load url="{concat('expedienteOpciones.php?accion=mc&amp;idExpediente=',$idExpediente)}" type="text/xml" />
			</e:variable>
			<e:return select="$datosExpedientes" />
		</e:body>
	</e:function>
	<e:function name="eliminaDatosExpediente">
		<e:argument name="idExpediente" required="true" />
		<e:body>
			<e:variable name="datosExpedientes">
				<c:load url="{concat('expedienteOpciones.php?accion=md&amp;idExpediente=',$idExpediente)}" type="text/xml" />
			</e:variable>
			<e:return select="$datosExpedientes" />
		</e:body>
	</e:function>
</div>

    <!--
    <e:function name="cargaDatos">
		<e:argument name="idCorreo" required="true" />
		<e:argument name="idUsuario" required="true" />
		<e:body>
			<e:variable name="datosUsuarios">
				<c:load url="{concat('usuariosOpciones.php?accion=mc&amp;correo=',$idCorreo)}" type="text/xml" />
			</e:variable>
			<c:load url="{$idUsuario}" type="text/xml" />
			<e:return select="$datosUsuarios" />
		</e:body>
	</e:function>
	-->