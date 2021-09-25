<?php
    include "src/models/Publication.php";

    $Publication = new Publication();

    switch($action) {
        case "get" :

            switch($_SERVER['REQUEST_METHOD']){
                case "GET":

                    $result = $Publication->get();
                    $response["result"] = $result;
                    break;

                default:

                    $response["error"] = "Método no permitido";
                    break;

            }
            break;

        case "add":

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
            break;

        case "update":

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
            break;

        case "delete":

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
            break;

        default:

            $response["error"] = "La acción '" . $action . "' no existe en el controlador '" . $controller . "'";

    }
?>
