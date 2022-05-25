<?php


    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    

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
    $paciente->datacadPaciente = date('Y-m-d H:i:s');
    
    if($paciente->Update()){
        echo json_encode ('Paciente atualizado com Sucesso!.');
    } else{
        echo json_encode ('Erro, não foi possível atualizar!');
    }

?>