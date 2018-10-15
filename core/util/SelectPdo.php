<?php

class SelectPdo
{
	private $host = '127.0.0.1';
	private $dbname = 'test';
	private $username = 'root';
	private $password = '';
	private $charset = 'utf8';
	private $collate = 'utf8_unicode_ci';
	
	private $pdocnx;
	private $dsn;
	
	
	private $_table;
	private $_where;
	private $_exp;
	
	public function config($config){
		$this->host = $config['host'];
		$this->dbname = $config['dbname'];
		$this->username = $config['username'];
		$this->password = $config['pwd'];
		// $this->charset = ($config['charset']=='') ? 'utf8' : $config['charset'];
		// $this->collate = ($config['collate']=='') ? 'utf8_unicode_ci' : $config['collate'];
		$this->dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
		$options = [
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_PERSISTENT => false,
		    PDO::ATTR_EMULATE_PREPARES => false,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $this->charset COLLATE $this->collate"
		];
		//var_dump($this->dsn);exit;
		try {
		    $this->pdocnx = new PDO($this->dsn, $this->username, $this->password, $options);
			$db_cnn = $this->pdocnx;
		}
		catch( PDOException $Exception ) {
			// require_once(LIB.DS."exception_db.php");
		 //   new exception_db($Exception->getMessage(),$Exception->getCode());
			return false;
		}
		
		if(file_exists(LIB.DS."Select.php")){
			require_once(LIB.DS."Select.php");
		}else{
			echo "No se encontro el archivo Select.php";
		}
		
		$select = (new Select($db_cnn));
		
		return $select;
	}
	

}