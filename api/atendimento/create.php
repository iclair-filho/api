<?php

    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    


    include_once '../../config/db.php';
    include_once '../../class/atendimento.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $atendimento = new Atendimento($db);

    //Arquivo ou URL para Buscar os dados Inputs
    $data = json_decode(file_get_contents("php://input"), TRUE);

    $atendimento->idcadPacientes = $data['idcadPacientes'];
    $atendimento->pressaoarterial = $data['pressaoarterial'];
    $atendimento->glicemia = $data['glicemia'];
    $atendimento->localdeatedimento = $data['localdeatedimento'];
    $atendimento->sacolamedicamento = $data['sacolamedicamento'];
    
    
    if($atendimento->Save()){
        echo json_encode ('Consulta cadastrado com Sucesso!.');
    } else{
        echo json_encode ('Erro, não foi possível cadastrar!');
    }

?>