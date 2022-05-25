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

    //Arquivo ou URL para Buscar os dados Inputs
    $usuarioJson = file_get_contents("php://input");

    
    $data = json_decode($usuarioJson);

    $usuario->nomeUsuarios = $data->nomeUsuarios;
    $usuario->cpf = $data->cpf;
    $usuario->senha = $data->senha;
    $usuario->tipo = $data->tipo;
    $usuario->datacadUsuario = date('Y-m-d H:i:s');
    
    if($usuario->Save()){
        echo json_encode ('Usuario cadastrado com Sucesso!.');
    } else{
        echo json_encode ('Erro, não foi possível cadastrar!');
    }

?>