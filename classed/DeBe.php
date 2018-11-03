<?php


if (!defined('Copyright') && Copyright != 'Sorry, the page wrong path')
exit('Sorry, the page wrong path');
if (!defined('ROOT_PATH'))
exit('Sorry, the page wrong path');
//网站logo名称：
$logo="龙源";

class DB 
{

	//数据库地址
	private $dbHost = 'localhost';
	
	//MySql数据库用户名
	private $dbUser = 'root';
	
	 //MySql数据库密码 
	private $dbPwd = '123123';
	
	//MySql数据库名称
	private $dbName = 'xyp';	
	
	public $conn = NULL;
	
	
	public function DB() //初始化
	{
		//echo "dbint";
		$this->connect();

	}
	public function close() //关闭
	{
	//echo "数据库关闭回调";
	}
	
	private function connect () //连接
	{
		global $db;
		if(!isset($db))
		{
			$this->conn = mysql_connect($this->dbHost, $this->dbUser, $this->dbPwd) or die ("Could not connect"); 
			mysql_select_db($this->dbName, $this->conn) or die ("Could not selectDB");
			mysql_set_charset('utf8', $this->conn); 
			//mysql_query("SET NAMES UTF8;") or die ("Could not UTF8");
			register_shutdown_function(array(&$this, 'close'));  //数据关闭回调
			
			//echo $this->conn;
		}
		else
			$this->conn=$db->conn;
		return $this->conn;
	}
	
	public function query ($sql, $parameter)//查询
	{
		$result = NULL;
		//$this->conn = $this->connect();
		mysql_query("SET @@sql_mode=\"NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION\";",$this->conn);
		$query = mysql_query ($sql,$this->conn) or die ("Invalid query：".$sql."|".mysql_error());
		switch ($parameter)
		{
			case 0 : 
				while (!!$row = mysql_fetch_row($query)) { $result[] = $row; }
				break;
			case 1 :
				while (!!$row = mysql_fetch_assoc($query)){ $result[] = $row; }
				 break;
			case 2 : $result = mysql_affected_rows($this->conn); //返回 INERT UPDATE DELETE 響應行數
				break;
			case 3 : $result = mysql_num_rows($query); 
				break;
			case 4 : $result = mysql_insert_id($this->conn);
			break;
			case 5 : while (!!$row = mysql_fetch_field($query)){$result[] = $row->name;}
		}
		return $result;
	}
	
	/**
	 * 得到表結構
	 */
	public function GetTables() //取表
	{
		//$conn = $this->connect();
		//$tables = mysql_list_tables($this->dbName);
		$database = $this->dbName;
		$tables = mysql_query("SHOW TABLES FROM $database");
		while (!!$row = mysql_fetch_row($tables)){ 
			$result[] = $row[0]; 
		}
		return $result;
	}
	
/**
	 * SELECT 查詢語句
	 * @param String $param
	 * @param String $from
	 * @param Int $limit
	 * @param String $where
	 * @param Int $parameter
	 */
	public function Select ($param, $from, $limit, $where=null, $parameter=1) //选择查询
	{
		//$db = new DB();
		$sql = $where == null ? " SELECT {$param} FROM {$from} LIMIT = $limit ":
											 " SELECT {$param} FROM {$from} WHERE {$where} LIMIT $limit ";
		return $this->query($sql, $parameter);
	}
	
	/**
	 * UPDATE 更改語句
	 * @param String $param
	 * @param String $from
	 * @param Int $limit
	 * @param String $where
	 */
	public function Update ($set, $from, $where, $limit) //更新数据
	{
		//$db = new DB();
		$sql = " UPDATE {$from} SET {$set} WHERE {$where} LIMIT $limit";
		return $this->query($sql, 2);
	}
}




?>