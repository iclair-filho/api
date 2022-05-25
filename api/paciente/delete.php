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

    
    if($paciente->Delete()){
        echo json_encode("Paciente Deletado.");
    } else{
        echo json_encode("Não foi possível deletar o paciente!");
    }

?>