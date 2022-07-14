<?php

    //Cabeçalho Obrigatório para leitura em JSON
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../../config/db.php';
    include_once '../../class/atendimento.php';

    //Instanciar as Classes
    $database = new Database();
    $db = $database->getConnection();
    $atendimentos = new Atendimento($db);
    $atendimentos = $atendimentos->All();
    $natendimentos = $atendimentos->rowCount();

    

    if ($natendimentos > 0) {
        
        //Criação de Arrays para apresentação da Json
        $atendimentoArray = array();
        $atendimentoArray["body"] = array();

        //Objeto para retornar o número de atendimento cadastrados
        $atendimentoArray["natendimento"] = $natendimentos;

        while ($atendimento = $atendimentos->fetch(PDO::FETCH_ASSOC)) {
            //Extrair as linhas de registros
            extract($atendimento);

            //Construção da Array
            $e = array(
                "idcadAtendimento" => $idcadAtendimento,
                "idcadPacientes" => $idcadPacientes,
                "pressaoarterial" => $pressaoarterial,
                "glicemia" => $glicemia,
                "dataatendimento" => $dataatendimento,
                "localdeatedimento" => $localdeatedimento,
                "sacolamedicamento" => $sacolamedicamento,
                
            );

            //Retorna da Array
            array_push($atendimentoArray["body"], $e);
            
        }

        //View da Json
        echo json_encode($atendimentoArray);

    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhum registro.")
        );
    }
    
?>