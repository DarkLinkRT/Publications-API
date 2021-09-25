<?php
    include "src/models/User.php";

    $User = new User();

    switch($action) {
        case "login":

            switch($_SERVER['REQUEST_METHOD']){
                case "POST":

                    $data = json_decode(file_get_contents('php://input'), true);
                    $result = $User->login($data);
                    $response["status"] = $result;
                    break;

                default:

                    $response["error"] = "Método no permitido";
                    break;

            }
            break;

        default:

            $response["error"] = "La acción '" . $action . "' no existe en el controlador '" . $controller . "'";
            break;

    }
?>
