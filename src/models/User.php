<?php

use \Firebase\JWT\JWT;

 class User{

    private $table = "users";

    function add($data){

        $fields = "";
        $values = "";

        foreach($data as $field => $value){
            if($field != "id"){
                if($field == "password"){
                    $fields.=  $field . ',';
                    $values.= '"' . password_hash( $value, PASSWORD_DEFAULT) . '",';
                } else{
                    $fields.=  $field . ',';
                    $values.= '"' . $value . '",';
                }
            } 
        }

        $fields = rtrim($fields, ",");
        $values = rtrim($values, ",");

        $SQL='INSERT INTO ' . $this->table .' ( id , ' . $fields . '  ) VALUES ( "'.$this->uuid().'",' . $values . ')'; 
		$Connection = new Connection();
        $result_query = $Connection->Mysql_Exec($SQL);

        return $result_query;
    }

    function login($data){

        $user = '';
        $password = '';

        $Connection = new Connection();
    
        $user = $data['user'];
        $password = $data['password'];

        $SQL = 'SELECT user, password , id , role_id FROM ' . $this->table . ' WHERE user = "' . $user . '" LIMIT 1';

        $result_query = $Connection->Mysql_Exec($SQL);
        
        $resultado = mysqli_fetch_row($result_query);
            
        $datos = array(
            "user" => utf8_encode($resultado[0]),
            "password" => utf8_encode($resultado[1]),
            "id" => utf8_encode($resultado[2]),
            "role_id" => utf8_encode($resultado[3])
        );

        if($datos['user']  !=  "" || $datos['user' != null]){
        
            $password2 = $datos['password'];

            if(password_verify($password, $password2))
            {
                $secret_key = "ZURA";
                $issuer_claim = "JORGE"; // this can be the servername
                $audience_claim = "AUDIENCE";
                $issuedat_claim = time(); // issued at
                $notbefore_claim = $issuedat_claim + 10; //not before in seconds
                $expire_claim = $issuedat_claim + (60*60); // expire time in seconds
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "user_id" => $datos["id"],
                    "role_id" => $datos["role_id"]
                );

                http_response_code(200);

                $jwt = JWT::encode($token, $secret_key);
                return  array(
                    "message" => "Acceso correcto.",
                    "token_access" => $jwt
                );
                   
            }
            else{
                http_response_code(401);
                return array("message" => "Acceso denegado.");
            }
        }
        return  array(
            "message" => "Acceso denegado."
        );
        
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