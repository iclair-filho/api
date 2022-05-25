<?php


    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Importar as Classes
    include_once '../../config/db.php';
    include_once '../../class/usuarios.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuarios($db);
    $usuario->idcadUsuarios = isset($_GET['idcadUsuarios']) ? $_GET['idcadUsuarios'] : die();
    
    $usuario->SingleOn();
    
    if ($usuario->nome != NULL) {
           //Construção da Array
            $e = array(
                "idcadUsuarios" => $usuario->idcadUsuarios,
                "nomeUsuarios" => $usuario->nomeUsuarios,
                "cpf" => $usuario->cpf,
                "senha" => $usuario->senha,
                "tipo" => $usuario->tipo,
                "datacadUsuario" => $usuario->datacadUsuarios
            );

        
        //View da Json
        http_response_code(200);
        echo json_encode($e);

    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhum registro.")
        );
    }
    
?>