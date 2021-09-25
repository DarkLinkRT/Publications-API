<?php

    require "vendor/autoload.php";
    use \Firebase\JWT\JWT;

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $controller = "";
    $action= "";
    $param= "";
    $response = [];

    $route = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $route_array = explode("?",$route);
    $request = explode("/",$route_array[1]);

    if( $request != null){
        $controller = $request[0];
        $action = $request[1];
    }

    $jwt = null;

    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    $arr = explode(" ", $authHeader);

    $jwt = $arr[1];

    function checkJWT($token){

        $secret_key = "ZURA";

        if($token){

            try {
        
                $decoded = JWT::decode($token, $secret_key, array('HS256'));
                
                return 1;
                
        
            }catch (Exception $e){
        
                return $e->getMessage();
            }
        
        }
        return $e->getMessage();

    }

    switch($controller) {
        case "Publications": 
            include "src/controllers/PublicationsController.php"; 
            break;
        case "Users": 
            include "src/controllers/UsersController.php"; 
            break;
        default :
            $response["error"] = "El controlador '" . $controller . "' no existe.";
            break;
    }


    ob_clean();
    echo json_encode($response , JSON_UNESCAPED_UNICODE );

?>
