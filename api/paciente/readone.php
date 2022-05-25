<?php
    include_once '../../config/db.php';
    include_once '../../class/pacientes.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $paciente = new Paciente($db);
    $paciente->idcadPacientes = isset($_GET['idcadPacientes']) ? $_GET['idcadPacientes'] : die();
    
    $paciente->SingleOn();
    
    if ($paciente->nome != NULL) {
           //Construção da Array
            $e = array(
                "idcadPacientes" => $paciente->idcadPacientes,
                "nomePacientes" => $paciente->nomePacientes,
                "cpf" => $paciente->cpf,
                "cartaoSus" => $paciente->cartaoSus,
                "endereco" => $paciente->endereco,
                "telefone" => $paciente->telefone,
                "postoAtendimento" => $paciente->postoAtendimento,
                "dataNascimento" => $paciente->dataNascimento,
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