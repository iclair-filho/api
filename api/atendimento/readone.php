<?php


    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    // Importar as Classes
    include_once '../../config/db.php';
    include_once '../../class/atendimento.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $atendimento = new Atendimento($db);
    $atendimento->idcadPacientes = isset($_GET['idcadPacientes']) ? $_GET['idcadPacientes'] : die();
    
    $atendimento->SingleOn();
    
    
    
    if ($atendimento->idcadPacientes != NULL) {
        
        $atendimentoArray = array();
        $atendimentoArray["body"] = array();
           //Construção da Array
           $e = array(
            "idcadAtendimento" => $atendimento->idcadAtendimento,
            "idcadPacientes" => $atendimento->idcadPacientes,
            "pressaoarterial" => $atendimento->pressaoarterial,
            "glicemia" => $atendimento->glicemia,
            "dataatendimento" => $atendimento->dataatendimento,
            "localdeatedimento" => $atendimento->localdeatedimento,
            "sacolamedicamento" => $atendimento->sacolamedicamento,
            
            );

            array_push($atendimentoArray["body"], $e);

        
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