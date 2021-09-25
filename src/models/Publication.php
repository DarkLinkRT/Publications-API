<?php

 class Publication{

    private $table = "publications";

    function get(){

        $SQL = 'SELECT * FROM ' . $this->table .' WHERE active = 1 and deleted = 0';
		$Connection = new Connection();
		$rs = $Connection->Mysql_Exec($SQL);
		$result_query = array();
		while($row = $rs->fetch_assoc()){
			$result_query[] = $row;
		}
        return $result_query;
    }

    function add($data){

        global $id_user;

        $fields = "";
        $values = "";

        foreach($data as $field => $value){
            if($field != "user_id"){
                $fields.=  $field . ',';
                $values.= '"' . $value . '",';
            }
        }

        $fields = rtrim($fields, ",");
        $values = rtrim($values, ",");

        $SQL='INSERT INTO ' . $this->table .' ( id , ' . $fields . ' , user_id ) VALUES ( "'.$this->uuid().'",' . $values . ' , "' . $id_user . '")'; 
		$Connection = new Connection();
        $result_query = $Connection->Mysql_Exec($SQL);
        return $result_query;

    }

    function update($data){

        global $id_user;

        $id = "";

        $fields = "";
        $values = "";

        foreach($data as $field => $value){
            if($field != "user_id"){
                $values.= $field . ' = "' . $value . '" ,';
                if( $field == "id" ){
                    $id = $value;
                }
            }
        }

        $values = rtrim($values, ",");

        if($id != "") {
            $SQL='UPDATE ' . $this->table .' SET ' . $values . ' WHERE id = "' . $id . '"'; 
		    $Connection = new Connection();
            $result_query = $Connection->Mysql_Exec($SQL);
        } else{
            return false;
        }
        
        return $result_query;

    }

    function delete($data){

        $id = "";

        $fields = "";
        $values = "";

        foreach($data as $field => $value){
            if( $field == "id" ){
                $id = $value;
            }
        }

        if($id != "") {
            $SQL='UPDATE ' . $this->table .' SET deleted = 1 , active = 0 WHERE id = "' . $id . '"'; 
		    $Connection = new Connection();
            $result_query = $Connection->Mysql_Exec($SQL);
        } else{
            return false;
        }
        
        return $result_query;

    }

    function uuid($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    

}

?>