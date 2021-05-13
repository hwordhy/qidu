<?php

class JieqiPDODatabase extends JieqiObject
{
	/**
	 * 数据库连接资源
	 *
	 * @var resource
	 */
	public $conn;
	public $conn_m;
	public $conn_s;
	public $hid_s = -1;
    public $dbh = null;
    public $dbType = 'mysql';
	/**
	 * 数据库连接参数
	 *
	 * @var array
	 */
	public $dbset;
	/**
	 * 服务器数组
	 *
	 * @var array
	 */
	public $hosts;
	/**
	 * 服务器数量
	 *
	 * @var array
	 */
	public $hnum;

	public function __construct($db = "")
	{
		parent::__construct();
	}

	public function setDbset($dbset)
	{
		$this->dbset = $dbset;
        $this->connect();
		return true;
	}

    public function connect($master = false)
    {

        $dsn = $this->dbType.':host='.$this->dbset["dbhost"].';dbname='.$this->dbset["dbname"];
        $options = $this->dbset["dbpconnect"] ? array(PDO::ATTR_PERSISTENT=>true) : array();
        try {
            $this->conn = new PDO($dsn, $this->dbset["dbuser"], $this->dbset["dbpass"], $options);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            jieqi_printfail("Can not connect to database!<br /><br />error: " . $e->getMessage());
        }
        $this->connectcharset();

        if (!defined("JIEQI_DB_CONNECTED")) {
            @define("JIEQI_DB_CONNECTED", true);
        }

        return true;
    }

	public function reconnect()
	{
		if (!pdo_ping($this->conn)) {
			$this->close();
			return $this->connect();
		}
		else {
			$this->connectcharset();
			return true;
		}
	}

   
    public function pdo_ping($dbconn){
        try{
            $dbconn->getAttribute(PDO::ATTR_SERVER_INFO);
        } catch (PDOException $e) {
            if(strpos($e->getMessage(), 'MySQL server has gone away')!==false){
                return false;
            }
        }
        return true;
    }

    public function mysqlversion()
	{
        $mysql_version = $this->conn->getAttribute(PDO::ATTR_SERVER_VERSION);
        return $mysql_version;
	}

	public function connectcharset()
	{
		$mysql_version = $this->conn->getAttribute(PDO::ATTR_SERVER_VERSION);

		if ("4.1" < $mysql_version) {
			if (isset($this->dbset["dbcharset"])) {
				if ($this->dbset["dbcharset"] != "default") {
                    $this->conn->exec("SET character_set_connection=" . $this->dbset["dbcharset"] . ", character_set_results=" . $this->dbset["dbcharset"] . ", character_set_client=binary");
				}
			}
			else {
                $this->conn->exec("SET character_set_connection=" . JIEQI_SYSTEM_CHARSET . ", character_set_results=" . JIEQI_SYSTEM_CHARSET . ", character_set_client=binary");
			}
		}

		if ("5.0" < $mysql_version) {
            $this->conn->exec("SET sql_mode=''");
		}
	}

	public function genId($sequence = "")
	{
		return 0;
	}

	public function fetchRow($result)
	{
		return @$result->getColumnMeta();
	}

	public function fetchArray($result)
	{
		return @$result->fetch();
	}

	public function getInsertId()
	{
		return @mysqli_insert_id($this->conn);
	}

	public function getRowsNum($result)
	{
		return @$result->columnjieqi_count();
	}

	public function getAffectedRows()
	{
		return $this->conn->rowjieqi_count();
	}

	public function close()
	{
		@$this->conn = null;
	}

	public function freeRecordSet($result)
	{
		return @mysqli_free_result($result);
	}

	public function error()
	{
		return @$this->conn->errorCode();
	}

	public function errno()
	{
		return @$this->conn->errorInfo();
	}

	public function quoteString($str)
	{
		return "'" . jieqi_dbslashes($str) . "'";
	}

	public function sqllog($do = "add", $sql = "")
	{
		static $sqllog = array();

		switch ($do) {
		case "add":
			if (!empty($sql)) {
				$sqllog[] = $sql;
			}

			break;

		case "ret":
			return $sqllog;
			break;

		case "count":
			return jieqi_count($sqllog);
			break;

		case "show":
			echo "<br />queries: " . jieqi_count($sqllog);

			foreach ($sqllog as $sql ) {
				echo "<br />" . jieqi_htmlstr($sql);
			}

			break;
		}
	}

	public function query($sql, $limit = 0, $start = 0, $nobuffer = false)
	{
		if (!empty($this->dbset["dbusage"])) {
			$this->connect();
		}
		else if (strtoupper(substr(ltrim($sql), 0, 6)) == "SELECT") {
			$this->connect(false);
		}
		else {
			$this->connect(true);
		}

		if (!empty($limit)) {
			if (empty($start)) {
				$start = 0;
			}

			$sql .= " LIMIT " . (int) $start . ", " . (int) $limit;
		}

		if (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE)) {
			$this->sqllog("add", $sql);
		}

		if ($nobuffer) {
            $result = $this->conn->query($sql);
		}
		else {
            $result = $this->conn->query($sql);
		}

		if ($result) {
			return $result;
		}
		else {
			$errno = $this->conn->errorCode();
			if ($errno != '00000') {
				$this->reconnect();

				if ($nobuffer) {
					$result = $this->conn->query($sql);
				}
				else {
                    $result = $this->conn->query($sql);
				}

				if ($result) {
					return $result;
				}
			}

			if (defined("JIEQI_DEBUG_MODE") && (0 < JIEQI_DEBUG_MODE)) {
				jieqi_printfail("SQL: " . jieqi_htmlstr($sql) . "<br /><br />ERROR: " . $this->conn->errorInfo()  . "(" . $this->conn->errorInfo() . ")");
			}

			return false;
		}
	}
}


?>
