<?php

    require "vendor/autoload.php";
    include 'src/connection/connection.php';

    use \Firebase\JWT\JWT;

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json ; charset=utf-8');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $controller = "";
    $action= "";
    $param= "";
    $response = [];

    $route = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $route_array = explode("Api/",$route);
    $request = explode("/",$route_array[1]);

    if( $request != null){
        $controller = $request[0];
        $action = $request[1];
    }
   
    $role_user = "";
    $id_user = "";

    $jwt = null;

    if($_SERVER['HTTP_AUTHORIZATION']){
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
    
        $jwt = $arr[1];    
    }

    // VERIFICACION DEL TOKEN
    function checkJWT($token){

        global $role_user , $id_user;

        $secret_key = "ZURA";

        if($token){

            try {
        
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
                
                $GLOBALS['role_user'] = $decoded->role_id;
                $GLOBALS['id_user'] = $decoded->user_id;

                //return hasPermission($role_user);
                if(hasPermission($role_user)){
                    return 1;
                }
                else{
                    return "No tienes permisos para realizar esta acción";                
                }
            }catch (Exception $e){
        
                return $e->getMessage();
            }
        
        }
        return $e->getMessage();

    }

    // CHECAR PERMISOS
    function hasPermission($role){

        global $controller;
        global $action;

        $Connection = new Connection();

        $SQL = 'SELECT * FROM roles_permissions RolesPermissions 
                INNER JOIN
                permissions Permissions on RolesPermissions.permission_id = Permissions.id 
                WHERE RolesPermissions.role_id = "' . $role . '"';

        $result_query = $Connection->Mysql_Exec($SQL);
        
        while($row = $result_query->fetch_assoc()){
            
            if($controller == $row["controller"] && $action == $row["action"]){
                return true;
            }
        }
    
        return false;
    }

    // RUTAS DE CONTROLADORES Y ACCIONES

    switch($controller) {
        case "Publications": 
            include "src/controllers/PublicationsController.php"; 
            break;
        case "Users": 
            include "src/controllers/UsersController.php"; 
            break;
        default :
            $response["error"] = "El controlador '" . $request . "' no existe.";
            break;
    }


    ob_clean();
    echo json_encode($response , JSON_UNESCAPED_UNICODE );

?>
