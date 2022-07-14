<?php

    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../config/db.php';
    include_once '../../class/usuarios.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $usuarios = new Usuarios($db);
    $usuarios = $usuarios->All();
    $nusuarios = $usuarios->rowCount();


    if ($nusuarios > 0) {
        
        //Criação de Arrays para apresentação da Json
        $usuarioArray = array();
        $usuarioArray["body"] = array();

        //Objeto para retornar o número de usuarios cadastrados
        $usuarioArray["nusuario"] = $nusuarios;

        while ($usuario = $usuarios->fetch(PDO::FETCH_ASSOC)) {
            //Extrair as linhas de registros
            extract($usuario);

            //Construção da Array
            $e = array(
                "idcadUsuarios" => $idcadUsuarios,
                "nomeUsuarios" => $nomeUsuarios,
                "cpf" => $cpf,
                "senha" => $senha,
                "tipo" => $tipo,
                "datacadUsuario" => $datacadUsuario
            );

            //Retorna da Array
            array_push($usuarioArray["body"], $e);
            
        }

        //View da Json
        echo json_encode($usuarioArray);

    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhum registro.")
        );
    }
    
?>