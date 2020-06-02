 <?php  
abstract class DbObject
{   
    private $connection;
	abstract protected function getTableName();
	abstract protected function objectToArray();
	abstract protected function arrayToObject($arr);

    public function closeConnect() {
        $this->connection->close();
    }

	protected function connect() {  
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($this->connection->connect_errno) {
            die("Не удалось подключиться: " . $this->connection->connect_error);
        } 
	}

	protected function query($sql) {
		return $this->connection->query($sql);
	}

    public function getAll() {
    	$arr = $this->query("SELECT * FROM {$this->getTableName()}");
    	$objects = [];
    	while($row = $arr->fetch_assoc()) {
    		$objects[] = $this->arrayToObject($row);
    	}
    	return $objects;
    }   

    public function getById($id) {
    	$arr = $this->query("SELECT * FROM {$this->getTableName()} WHERE id={$id}");
    	$row = $arr->fetch_assoc();
    	return $this->arrayToObject($row);
    }

    public function insert() {
    	//$str = "";
    	$arr = $this->objectToArray();

    	/*foreach($arr as $value) {
    		$str .= "'$value'";
    		if ($value != end($arr)) $str .= ",";
    	}*/
        $str = "'".implode("','", $arr)."'";

    	$this->query("INSERT INTO {$this->getTableName()} VALUES ({$str})");
    	return $this->setId($this->connection->insert_id); //записуємо останню Ід
    }

    public function deleteById($id) {
    	return $this->query("DELETE FROM {$this->getTableName()} WHERE id={$id}");
    }

    public function update($obj) {
     	$str = "";
    	$arr = $obj->objectToArray();
        $flag = false;

    	foreach($arr as $key => $value) {
    		if($key == 'id') continue;
            if($value == null) continue;
            if($flag) $str .= ",";

            $str .= "$key = '$value'";
            $flag = true;

           /* if ($value != end($arr)) $str .= ",";*/


            /*if($value == null && ) { // for authorUpdate
                $str = substr($str,0,-1);
                $flag = true;
                continue;
            }
            if($flag) {
                $str .= ',';
                $flag = false;
            }

    		$str .= "$key = '$value'";
    		if ($value != end($arr)) $str .= ",";*/
    	}

        return $this->query("UPDATE {$this->getTableName()} SET {$str} WHERE id={$obj->getId()}");
    }
}
?>