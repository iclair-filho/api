<?php

    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/db.php';
    include_once '../../class/usuarios.php';
    
    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuarios($db);
    

    
    $data = json_decode(file_get_contents("php://input"), TRUE);

    $usuario->cpf = $data['cpf'];
    $usuario->senha = $data['senha'];
    
    $usuario->Login();
    $nusuario = $usuario->Login()->rowCount(); 
    
    
    
  if($usuario->cpf!=''){
      if($nusuario==0){
      echo json_encode('Usuário não cadastrado');				
      }
      else{		
      echo json_encode('ok');				
      }
      
	}	
	else{
	  echo json_encode('Erro, tente novamente!');
	}
?>