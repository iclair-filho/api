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

    $paciente->idcadPacientes = $data->idcadPacientes;

    //Valores a atualizar
    $paciente->nomePacientes = $data->nomePacientes;
    $paciente->cpf = $data->cpf;
    $paciente->cartaoSus = $data->cartaoSus;
    $paciente->endereco = $data->endereco;
    $paciente->telefone = $data->telefone;
    $paciente->postoAtendimento = $data->postoAtendimento;
    $paciente->dataNascimento = $data->dataNascimento;
    $paciente->created = date('Y-m-d H:i:s');
    
    if($paciente->Update()){
        echo json_encode ('Paciente atualizado com Sucesso!.');
    } else{
        echo json_encode ('Erro, não foi possível atualizar!');
    }

?>