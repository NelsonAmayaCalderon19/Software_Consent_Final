<?php

class conexion{
    /*private $host = "localhost"; 
    private $database="gastroqu_informed_consent";
	private $user='gastroqu_inform';
	private $password='gastro_informed';
    private $conect;*/

    private $host = "localhost"; 
    private $database="consentimiento_db";
	private $user='root';
	private $password='';
    private $conect;
public function __construct(){
    $connectionString = "mysql:host=".$this->host.";dbname=".$this->database.";charset=utf8";
try {
	
	$this->conect = new PDO($connectionString,$this->user,$this->password);
    $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    $this->conect = 'Error de Conexion';
	echo "Error".$e->getMessage();
}
    }
    public function connect(){
        return $this->conect;
    }
    
}
function conexion()
	{
		return $conexion=mysqli_connect("localhost","root","","consentimiento_db");
	}
?>