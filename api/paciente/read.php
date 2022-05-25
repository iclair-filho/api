<?php

    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../config/db.php';
    include_once '../../class/pacientes.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $pacientes = new Paciente($db);
    $pacientes = $pacientes->All();
    $npacientes = $pacientes->rowCount();


    if ($npacientes > 0) {
        
        //Criação de Arrays para apresentação da Json
        $pacienteArray = array();
        $pacienteArray["body"] = array();

        //Objeto para retornar o número de pacientes cadastrados
        $pacienteArray["npaciente"] = $npacientes;

        while ($paciente = $pacientes->fetch(PDO::FETCH_ASSOC)) {
            //Extrair as linhas de registros
            extract($paciente);

            //Construção da Array
            $e = array(
                "idcadPacientes" => $idcadPacientes,
                "nomePacientes" => $nomePacientes,
                "cpf" => $cpf,
                "cartaoSus" => $cartaoSus,
                "endereco" => $endereco,
                "telefone" => $telefone,
                "postoAtendimento" => $postoAtendimento,
                "dataNascimento" => $dataNascimento,
                "datacadPaciente" => $datacadPaciente
            );

            //Retorna da Array
            array_push($pacienteArray["body"], $e);
            
        }

        //View da Json
        echo json_encode($pacienteArray);

    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhum registro.")
        );
    }
    
?>