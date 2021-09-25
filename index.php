<?php

    header("Content-Type: text/html;charset=utf-8");

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

    switch($controller) {
        case "Publications": 
            include "src/controllers/PublicationsController.php"; 
            break;
        default :
            $response["error"] = "El controlador '" . $controller . "' no existe.";
            break;
    }

    ob_clean();
    echo json_encode($response , JSON_UNESCAPED_UNICODE );

?>
