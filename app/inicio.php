<?php
	//include("scripts/includes/controlAcceso.php");
?>
<!-- -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:e="http://www.backbase.com/2006/xel"
	xmlns:xi="http://www.w3.org/2001/XInclude">
	<head>
		<script type="text/javascript" src="backbase/engine/boot.js" release="false"></script>
		<link rel="stylesheet" type="text/css" href="css/basic.css" />
		<link rel="stylesheet" type="text/css" href="css/app.css" />
		<link rel="stylesheet" type="text/css" href="css/icons.css" />
	</head>
	<body>
		<div id="loadingMessageContainer">
			<div id="loadingMessage"><img src="resources/media/loading.gif" />&#160;&#160;Un momento cargando la aplicaci&oacute;n...</div>
		</div>
		<script type="text/backbase+xml" e:onload="document.getElementById('loadingMessageContainer').style.display = 'none'" style="height:100%">
			<xi:include href="backbase/bindings/config.xhtml_btl.chameleon.xml" />
			<xi:include href="scripts/funciones.php" />
			<xi:include href="scripts/app.php" />
		</script>
	</body>
</html>