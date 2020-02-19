<?php
 class c_conectaSQLite
 {
    // Variables de la conexi�n a la BD
    var $path;
	var $dbconnection;
	
	var $debug;

	
	//constructor
	function c_conecta($path)
	{
	  $this->__construct($path);
	} 
	
	//constructor
	function __construct($path)
	{
	  $this->path=$path;
	  $this->connect();
	  
	  $this->debug=0;
	  //echo"<hr>Conexion Instanciada: $this->dbconnection<hr>";
	} 
	
 	function connect()
	{
		$this->dbconnection=new PDO("sqlite:".$this->path);
    }
    
    function execute($sql)
	{
	  
	  $rs=new recordset($this->dbconnection);
	  if($this->debug)
	  {
	    echo "<hr>sqlite: ".$this->path." <hr>";
	  	echo "<hr>sqlite: $sql <hr>";
	  }
	  $rs->execute($sql);
	  return($rs);
	}
	
	/**
	 * Ejecuta una instrucci�n sql INSERT y retorna el id del dato insertado
	 *
	 * @param string $sql
	 * @return int
	 */
	function insertId($sql)
	{
	  $rs=new recordset($this->dbconnection);
	  if($this->debug)
	  {
	    echo "<hr>mysql: $sql <hr>";
	  }
	  $rs->execute($sql);
	  $idInsert=mysql_insert_id($this->dbconnection);
	  return($idInsert);
	}
    
    function close() 
	{
		return mysql_close($this->dbconnection);
	}
 }
 
 class recordset
 {
	var $dbConnection;
 	var $dbStmt;
 	var $dbRes;
	
	var $EOF;
	var $fields;
	var $size;
	var $indice;
	
	function recordset($con)
	{
	  $this->dbConnection=$con;
	  $this->EOF=0;
	  $this->dbStmt=null;
	  $this->dbRes=null;
	  $this->size=0;
	  $this->indice=0;
	}
 	
	function execute($sql)
	{
	  $this->dbStmt=$this->dbConnection->query($sql);
	  
	  $this->dbRes=$this->dbStmt->fetchAll();
	  //print_r($this->dbRes);
	  
      $this->size=$this->total_records();
      if($this->size==0)
        $this->EOF=1;
      else
      {
        $this->EOF=0;
        $this->fields=$this->retrieve();
      }
	  return($rs);
	}
	
	function total_records() 
	{
		return count($this->dbRes);
	}
	
	function retrieve()
	{
	  if(!$this->EOF)
	  {
		$row=$this->fields=$this->dbRes[$this->indice++];
	    if($this->fields==0)
	    {
	      $this->EOF=1;
	      $this->dbres=null;
	    }
	  }
	  else
	  {
	  	$this->dbres=null;
	  	$row=0;
	  }
	  return($row);
	}
	
	function next()
	{
	  return($this->retrieve());	
	}
}

class c_funcion
{
	function getPage($vCad)
	{
		$arr=explode("/",$vCad);
		$tam=count($arr);
		$aux=$arr[($tam-1)];
		
		$pos=strpos($aux,"?");
		if(!$pos)
		  $pos=strlen($aux);
		$res=substr($aux,0,$pos);
		return ($res);
	}
	
}
?>
