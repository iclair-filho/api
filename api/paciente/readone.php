<?php


    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Importar as Classes
    include_once '../../config/db.php';
    include_once '../../class/pacientes.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $paciente = new Paciente($db);
    $paciente->cpf = isset($_GET['cpf']) ? $_GET['cpf'] : die();
    
    $paciente->SingleOn();
    
    
    
    if ($paciente->cpf != NULL) {
        
        $pacienteArray = array();
        $pacienteArray["body"] = array();
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
                "datacadPaciente" => $paciente->datacadPaciente
            );
            array_push($pacienteArray["body"], $e);

        
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