<?php
    include "../../../../src/models/Publication.php";

    $Publication = new Publication();

    $tokenResponse = checkJWT($jwt);

    switch($action) {
        case "get" :

            if($tokenResponse == 1){
                switch($_SERVER['REQUEST_METHOD']){

                    case "GET":
    
                        $result = $Publication->get();
                        $response["result"] = $result;
                        break;
    
                    default:
    
                        $response["error"] = "Método no permitido";
                        break;
    
                }
            } else{
                $response["error"] = "Acceso denegado";
                $response["tokenMessage"] = $tokenResponse;
            }
            $response["tokenMessage"] = $tokenResponse;
            break;

        case "add":

            if($tokenResponse == 1){
                switch($_SERVER['REQUEST_METHOD']){
                    case "POST":

                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $Publication->add($data);
                        $response["status"] = $result;
                        break;

                    default:

                        $response["error"] = "Método no permitido";
                        break;

                }
            } else{
                $response["error"] = "Acceso denegado";
                $response["tokenMessage"] = $tokenResponse;
            }
            $response["tokenMessage"] = $tokenResponse;
            break;

        case "update":

            if($tokenResponse == 1){
                switch($_SERVER['REQUEST_METHOD']){
                    case "PUT":

                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $Publication->update($data);
                        $response["status"] = $result;
                        break;

                    default:

                        $response["error"] = "Método no permitido";
                        break;

                }
            } else{
                $response["error"] = "Acceso denegado";
                $response["tokenMessage"] = $tokenResponse;
            }
            $response["tokenMessage"] = $tokenResponse;
            break;

        case "delete":

            if($tokenResponse == 1){
                switch($_SERVER['REQUEST_METHOD']){
                    case "DELETE":

                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $Publication->delete($data);
                        $response["status"] = $result;
                        break;

                    default:

                        $response["error"] = "Método no permitido";
                        break;

                }
            } else{
                $response["error"] = "Acceso denegado";
                $response["tokenMessage"] = $tokenResponse;
            }
            $response["tokenMessage"] = $tokenResponse;
            break;

        default:

            $response["error"] = "La acción '" . $action . "' no existe en el controlador '" . $controller . "'";

    }
?>
