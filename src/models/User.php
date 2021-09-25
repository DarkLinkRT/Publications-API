<?php

use \Firebase\JWT\JWT;

 class User{

    private $table = "users";

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
                    // "user_id" => $datos["id"],
                    "token_access" => $jwt
                );
                   
            }
            else{
                http_response_code(401);
                return array("message" => "Acceso denegado.");
            }
        }
        
    }
    
}

?>