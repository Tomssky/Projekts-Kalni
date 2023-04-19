<?php

Class db{   
    
    public $conn = false;
	public $debug = false;

    private function dbConect(){

		$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD ,DB_NAME) or die ('Neizdevas savienoties ar datubazi!!');
		
		/* check connection */
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		
		mysqli_set_charset($this->conn,'utf8');
		
		return $this->conn;
    }
	
	function dbclose(){
		if($this->conn){
			mysqli_close($this->conn); 
		}
	}
		
	function getArray($query,$error=false){ 
		$data = array();

		$result=$this->result($query,$error);
			
		if ($result){
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$data[] = $row;	
			}
		}

		return $data;
	}
		
	function getArrayFirst($query,$error = false){
		$data=array();
		
		$data = $this->getArray($query,$error);	
		if ($data){
			return $data[0];
		}
		return $data;
	}
			
	function chekArray($table,$dataArray,$error){
		$columns = $this->getArray('SHOW FIELDS FROM '.$table,$error);
		$column_array = array();
		foreach($columns AS $field){
			$column_array[] = $field['Field'];
		}
		
		$array = array();
		foreach($dataArray AS $key => $value){
			if (!in_array($key, $column_array)) {
			    unset($dataArray[$key]);
			}
		}
		
		return $dataArray;
	}
	
	function insert($table,$dataArray,$error = false,$ignore = false){      
		$dataArray = $this->chekArray($table,$dataArray,$error);
		
		$query = 'INSERT '.($ignore ? 'IGNORE' : '' ).' INTO ' . $table . ' SET ';
		$fields = array();
		foreach($dataArray as $key => $value ){
			$fields[] = '`'.$key . '`=\'' . str_replace("'","\'",$value) . "'" ;				
		}

		$query .= implode(', ', $fields);

        if($this->result($query,$error)){
            return mysqli_insert_id($this->conn);            
		}
		
		return false;
	}
	
/*	
function update($table,$dataArray,$where,$error = false){
		if(is_int($where)){
			$id = $where;
			$where = ' WHERE id="'.$where.'"';
		}
		
		if ($this->getCount('SELECT * FROM '.$table.' '.$where,$error) > 0){
			$query = 'UPDATE ' . $table . ' SET ';
			$fields = array();
            
            $autoincName = $this->getTableIdcolumn($table);
			if($autoincName){
            	$id = $this->getArrayFirst('SELECT `'.$autoincName.'` FROM '.$table.' '.$where,true);     
            	$id = $id[$autoincName];
            }
            
            if(!isset($id)){
				$id = $where;	
			}
			
			$dataArray = $this->chekArray($table,$dataArray,$error);
			foreach($dataArray as $key => $value ){
				$fields[] = '`'.$key . '`=\'' . str_replace("'","\'",$value) . "'";			
			}

			$query .= implode(', ', $fields);
			$query .= ' '.$where;
			
			if($this->result($query,$error)){
                return true;
			}
			
			return false;
		}
		return false;
	}
*/
function update($table, $dataArray, $where, $error = false) {
    $dataArray = $this->chekArray($table, $dataArray, $error);

    $query = "UPDATE $table SET ";
    $set = array();
    foreach ($dataArray as $key => $value) {
        $set[] = "`$key`='" . mysqli_real_escape_string($this->conn, $value) . "'";
    }
    $query .= implode(', ', $set);
    $query .= " WHERE $where";

    return $this->result($query, $error);
}
	
	function save($table,$dataArray,$where,$error = false){
		$save = $this->update($table,$dataArray,$where,$error);
		if (!$save){
			$save = $this->insert($table,$dataArray,$error);
			if (!$save){
				return false;
			}
			
			return $save;
		}
		
		return $save;
	}

	function delete($table,$where,$error = false,$disable_forign_key = false){
		
		$conect = $this->dbConect();

		if($disable_forign_key){
			mysqli_query($conect,'SET FOREIGN_KEY_CHECKS=0') or die("<b>" . $query . "</b><br>" . mysqli_error($conect));
		}
		
		$result = mysqli_query($conect,'DELETE FROM ' . $table . ' ' . $where.';') or die("<b>" . $query . "</b><br>" . mysqli_error($conect));
		
		if($disable_forign_key){
			mysqli_query($conect,'SET FOREIGN_KEY_CHECKS=1') or die("<b>" . $query . "</b><br>" . mysqli_error($conect));
		}	

        return $result;
	}

	function result($query,$error = false){
		if ($query){
			$conect = $this->dbConect();
			mysqli_query($conect,'SET SESSION sql_mode = ""');
			if ($error || $this->debug){
				//if(isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] == 1){
					$result=mysqli_query($conect,$query) or die("<b>" . $query . "</b><br>" . mysqli_error($conect));
				//}else{
				//	$result=mysqli_query($conect,$query);	
				//}
			}else{
				$result=mysqli_query($conect,$query);	
			}

			return $result;	
		}

		return false;
	}
	
	function getTableIdcolumn($table){
		$result = 'SELECT column_name
		FROM information_schema.columns
		WHERE table_schema=DATABASE() AND table_name="'.$table.'" AND extra="auto_increment"';
		$id = $this->getArrayFirst($result,true);
		if($id){
			return $id['column_name'];
		}else{
			return false;
		} 
	}

	function getTablePriColumn($table){
		$data = $this->getArray('SELECT `COLUMN_NAME`
		FROM `information_schema`.`COLUMNS`
		WHERE (`TABLE_NAME` = "'.$table.'") AND (`COLUMN_KEY` = "PRI")');
		return $data;
	}
}
