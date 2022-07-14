<?php
class Paciente{

    //Conexão com banco de dados
    private $conn;

    //Nome da Tabela
    private $db_tabela = "cadpacientes";

    //Colunas da Tabelas
    public $idcadPacientes;
    public $nomePacientes;
    public $cpf;
    public $cartaoSus;
    public $endereco;
    public $telefone;
    public $postoAtendimento;
    public $dataNascimento;
    public $datacadPaciente;

    // Conexão com o Banco
    public function __construct($db){
        $this->conn = $db;
    }

    //Lista Todos os Registros
    public function All(){
        $sql = "SELECT * FROM " . $this->db_tabela . "";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }


    // Criar registro de paciente
    public function Save(){
        $sql = "INSERT INTO
                    ". $this->db_tabela ."
                SET
                    nomePacientes = :nomePacientes, 
                    cpf = :cpf, 
                    cartaoSus = :cartaoSus, 
                    endereco = :endereco, 
                    telefone = :telefone, 
                    postoAtendimento = :postoAtendimento, 
                    dataNascimento = :dataNascimento";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomePacientes=htmlspecialchars(strip_tags($this->nomePacientes));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->cartaoSus=htmlspecialchars(strip_tags($this->cartaoSus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));
        $this->postoAtendimento=htmlspecialchars(strip_tags($this->postoAtendimento));
        $this->dataNascimento=htmlspecialchars(strip_tags($this->dataNascimento));
        
    
        // bind data
        $stmt->bindParam(":nomePacientes", $this->nomePacientes);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cartaoSus", $this->cartaoSus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":postoAtendimento", $this->postoAtendimento);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        
    
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
                    nomePacientes = :nomePacientes, 
                    cartaoSus = :cartaoSus, 
                    endereco = :endereco, 
                    telefone = :telefone, 
                    postoAtendimento = :postoAtendimento, 
                    dataNascimento = :dataNascimento, 
                WHERE
                    cpf = :cpf";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomePacientes=htmlspecialchars(strip_tags($this->nomePacientes));
        $this->cartaoSus=htmlspecialchars(strip_tags($this->cartaoSus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));
        $this->postoAtendimento=htmlspecialchars(strip_tags($this->postoAtendimento));
        $this->dataNascimento=htmlspecialchars(strip_tags($this->dataNascimento));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
    
        // bind data
        $stmt->bindParam(":nomePacientes", $this->nomePacientes);
        $stmt->bindParam(":cartaoSus", $this->cartaoSus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":postoAtendimento", $this->postoAtendimento);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":cpf", $this->cpf);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Lista apenas um registro

    public function SingleOn(){
        $sql = "SELECT * FROM " . $this->db_tabela . " WHERE cpf = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->cpf);
        $stmt->execute();
        $cadpacientes = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->idcadPacientes = $cadpacientes['idcadPacientes'];
        $this->nomePacientes = $cadpacientes['nomePacientes'];
        $this->cpf = $cadpacientes['cpf'];
        $this->cartaoSus = $cadpacientes['cartaoSus'];
        $this->endereco = $cadpacientes['endereco'];
        $this->telefone = $cadpacientes['telefone'];
        $this->postoAtendimento = $cadpacientes['postoAtendimento'];
        $this->dataNascimento = $cadpacientes['dataNascimento'];
        $this->datacadPaciente = $cadpacientes['datacadPaciente'];
        
        
    }


    // Deletar registro de paciente
    public function Delete(){
        $sql = "DELETE FROM
                    ". $this->db_tabela ."
                WHERE
                    idcadPacientes = :idcadPacientes";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->idcadPacientes=htmlspecialchars(strip_tags($this->idcadPacientes));
    
        // bind data
        $stmt->bindParam(":idcadPacientes", $this->idcadPacientes);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
        //Fazer BUscarPacienete
    
    public function BuscarPaciente(){
        $sql = "SELECT * FROM " . $this->db_tabela . " WHERE cpf = :cpf";
        $stmt = $this->conn->prepare($sql);
        
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->execute();

        return $stmt;
    }

}
?>