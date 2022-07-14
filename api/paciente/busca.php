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
    $paciente= new Paciente($db);
    

    
    $data = json_decode(file_get_contents("php://input"), TRUE);

    $paciente->cpf = $data['cpf'];
    
    $paciente->BuscarPaciente();
    $npaciente = $paciente->BuscarPaciente()->rowCount(); 
    
    
    
  if($paciente->cpf!=''){
      if($npaciente==0){
      echo json_encode('Paciente não cadastrado! Cadastre-o.');				
      }
      else{		
      echo json_encode('ok');				
      }
      
	}	
	else{
	  echo json_encode('Erro, tente novamente!');
	}
?>