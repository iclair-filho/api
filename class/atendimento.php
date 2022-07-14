<?php
class Atendimento{

    //Conexão com banco de dados
    private $conn;

    //Nome da Tabela
    private $db_tabela = "cadatendimento";

    //Colunas da Tabelas
    public $idcadAtendimento;
    public $idcadPacientes;
    public $pressaoarterial;
    public $glicemia;
    public $dataatendimento;
    public $localdeatedimento;
    public $sacolamedicamento;
    

    // Conexão com o Banco
    public function __construct($db){
        $this->conn = $db;
    }


    //Lista Todos os Registros
    public function All(){
        $sql = "SELECT * FROM ' . $this->db_tabela . '";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }



    // Criar registro de paciente
    public function Save(){
        $sql = "INSERT INTO
                    ". $this->db_tabela ."
                SET
                    idcadPacientes = :idcadPacientes, 
                    pressaoarterial = :pressaoarterial, 
                    glicemia = :glicemia, 
                    localdeatedimento = :localdeatedimento,
                    sacolamedicamento = :sacolamedicamento";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->idcadPacientes=htmlspecialchars(strip_tags($this->idcadPacientes));
        $this->pressaoarterial=htmlspecialchars(strip_tags($this->pressaoarterial));
        $this->glicemia=htmlspecialchars(strip_tags($this->glicemia));
        $this->localdeatedimento=htmlspecialchars(strip_tags($this->localdeatedimento));
        $this->sacolamedicamento=htmlspecialchars(strip_tags($this->sacolamedicamento));
        
    
        // bind data
        $stmt->bindParam(":idcadPacientes", $this->idcadPacientes);
        $stmt->bindParam(":pressaoarterial", $this->pressaoarterial);
        $stmt->bindParam(":glicemia", $this->glicemia);
        $stmt->bindParam(":localdeatedimento", $this->localdeatedimento);
        $stmt->bindParam(":sacolamedicamento", $this->sacolamedicamento);
        
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Alterar registro de paciente
    public function Update(){
        $sql = "UPDATE INTO
                    ". $this->db_tabela ."
                SET
                    pressaoarterial = :pressaoarterial, 
                    glicemia = :glicemia, 
                    dataatendimento = :dataatendimento, 
                    localdeatedimento = :localdeatedimento,
                    sacolamedicamento = :sacolamedicamento
                WHERE
                    idcadPacientes = :idcadPacientes";
    
        $stmt = $this->conn->prepare($sql);
    
         // sanitize
         $this->idcadAtendimento=htmlspecialchars(strip_tags($this->idcadAtendimento));
         $this->idcadPacientes=htmlspecialchars(strip_tags($this->idcadPacientes));
         $this->pressaoarterial=htmlspecialchars(strip_tags($this->pressaoarterial));
         $this->glicemia=htmlspecialchars(strip_tags($this->glicemia));
         $this->dataatendimento=htmlspecialchars(strip_tags($this->dataatendimento));
         $this->localdeatedimento=htmlspecialchars(strip_tags($this->localdeatedimento));
         $this->sacolamedicamento=htmlspecialchars(strip_tags($this->sacolamedicamento));
    
          // bind data
          $stmt->bindParam(":idcadAtendimento", $this->idcadAtendimento);
          $stmt->bindParam(":idcadPacientes", $this->idcadPacientes);
          $stmt->bindParam(":pressaoarterial", $this->pressaoarterial);
          $stmt->bindParam(":glicemia", $this->glicemia);
          $stmt->bindParam(":dataatendimento", $this->dataatendimento);
          $stmt->bindParam(":localdeatedimento", $this->localdeatedimento);
          $stmt->bindParam(":sacolamedicamento", $this->sacolamedicamento);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Lista apenas um registro

    public function SingleOn(){
        $sql = "SELECT * FROM " . $this->db_tabela . " WHERE idcadPacientes = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->idcadPacientes);
        $stmt->execute();
        $atendimento = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->idcadAtendimento = $atendimento['idcadAtendimento'];
        $this->idcadPacientes = $atendimento['idcadPacientes'];
        $this->pressaoarterial = $atendimento['pressaoarterial'];
        $this->glicemia = $atendimento['glicemia'];
        $this->dataatendimento = $atendimento['dataatendimento'];
        $this->localdeatedimento = $atendimento['localdeatedimento'];
        $this->sacolamedicamento = $atendimento['sacolamedicamento'];
        
        
    }
  

    
}
?>