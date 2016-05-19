<?php
class Database
{

  private $host = "localhost";
  private $db_name = "carpoolingdb";
  private $username = "carpoolingusr";
  private $password = "carpoolingusr";
  public  $conn;
  private static $instance = null;

  private function __construct()
  {
    $this->conn = null;
    try
    {
      $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $exception)
    {
      echo "Connection error: " . $exception->getMessage();
    }
    return $this->conn;
  }

  //return: PDOStatement
  public function prepare($sql)
  {
  	$stmt = $this->conn->prepare($sql);
		return $stmt;
  }

  //input: query, parameters, resultset (byref), return: number of rows
  public function fetch($sql, $paramarray, &$rows)
  {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($paramarray);
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt->rowCount();
  }

  //input: query, parameters, json string (byref), return: number of rows
  public function fetchJson($sql, $paramarray, &$json)
  {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($paramarray);
    $emparray = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $emparray[] = $row;
    }
    $json = json_encode($emparray);
    return $stmt->rowCount();
  }

  //return: string
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}

  //return: Database (singleton)
  public static function getInstance()
  {
    if(self::$instance == null)
    {
      $c = __CLASS__;
      self::$instance = new $c;
    }
    return self::$instance;
  }
}
?>
