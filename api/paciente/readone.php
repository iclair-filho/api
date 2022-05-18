<?php
    include_once '../../config/db.php';
    include_once '../../class/pacientes.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $paciente = new Paciente($db);
    $paciente->id = isset($_GET['id']) ? $_GET['id'] : die();
    
    $paciente->SingleOn();
    
    if ($paciente->nome != NULL) {
           //Construção da Array
            $e = array(
                "id" => $paciente->id,
                "nome" => $paciente->nome,
                "cpf" => $paciente->cpf,
                "cardsus" => $paciente->cardsus,
                "endereco" => $paciente->endereco,
                "postoatendimento" => $paciente->postoatendimento,
                "dtnascimento" => $paciente->dtnascimento,
                "created" => $paciente->created
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