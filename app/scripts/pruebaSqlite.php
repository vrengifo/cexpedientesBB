<?php
  /*
  $db=new PDO("sqlite:C://cexpedientes.sqlite");
  $result=$db->query("select * from estadocivil");
  $oo=$result->fetchAll();
  
  print_r($oo);
  
  $tamOO=count($oo);
  for($i=0;$i<$tamOO;$i++)
  {
  	$tupla=$oo[$i];
  	echo "<br>tupla: ".$i." ";
  	$tamTupla=count($tupla);
  	for($j=0;$j<$tamTupla;$j++)
  	{
  		echo($tupla[$j])."&nbsp;&nbsp;";
  	}
  	echo"<br>";  	
  }
  
  $result=null;
  
  $db=null;
  */
  
  //con clase
  include_once("class/c_conectaSQLite.php");
  echo "<br>Con clase <br>";
  $conn=new c_conectaSQLite("db/cexpedientes.sqlite");
  //$conn=new c_conectaSQLite("H://cep//EXPEDIENTES//Cexpedientes//php//cexpedientes//db//cexpedientes.sqlite");
  //$conn=new c_conectaSQLite("H:/cep/EXPEDIENTES/Cexpedientes/php/cexpedientes/db/cexpedientes.sqlite");
  //$conn=new c_conectaSQLite("H:\cep\EXPEDIENTES\Cexpedientes\php\cexpedientes\db\cexpedientes.sqlite");
  $conn->debug=1;
  //$res=$conn->execute("select * from estadocivil");
  $res=$conn->execute("SELECT tipcli_id,sex_id,estciv_id,cli_cedula,cli_ruc,cli_nombre,cli_apellido,cli_fechanacimiento,cli_direccion,cli_telefono,cli_email FROM cliente WHERE cli_id = 3");
  while(!$res->EOF)
  {
  	echo $res->fields[0]." ".$res->fields[1]."<br>";
  	
  	$res->next();
  }
  
  /*
  echo"<hr>Insertar<hr>";
  //insertar
  $sql="insert into estadocivil (estciv_id,estciv_nombre) values ('V','Vico') ";
  $resInsert=$conn->execute($sql);
  print_r($resInsert);
  */
  
  /*
  echo"<hr>Actualizar<hr>";
  //update
  $sql="update estadocivil set estciv_nombre='Vico Hugo' where estciv_id='V'";
  $resUpdate=$conn->execute($sql);
  print_r($resUpdate);
  */
?>