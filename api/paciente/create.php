<?php
    include_once '../../config/db.php';
    include_once '../../class/pacientes.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $paciente = new Paciente($db);

    //Arquivo ou URL para Buscar os dados Inputs
    $pacienteJson = file_get_contents("php://input");

    
    $data = json_decode($pacienteJson);

    $paciente->nome = $data->nome;
    $paciente->cpf = $data->cpf;
    $paciente->cardsus = $data->cardsus;
    $paciente->endereco = $data->endereco;
    $paciente->postoatendimento = $data->postoatendimento;
    $paciente->dtnascimento = $data->dtnascimento;
    $paciente->created = date('Y-m-d H:i:s');
    
    if($paciente->Save()){
        echo json_encode ('Paciente cadastrado com Sucesso!.');
    } else{
        echo json_encode ('Erro, não foi possível cadastrar!');
    }

?>