<?php
class Paciente{

    //Conexão com banco de dados
    private $conn;

    //Nome da Tabela
    private $db_tabela = "cadpacientes";

    //Colunas da Tabelas
    public $id;
    public $nomePacientes;
    public $cpf;
    public $cartaoSus;
    public $endereco;
    public $telefone;
    public $postoatendimento;
    public $dataNascimento;
    public $created;

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
                    telefone = :telefone, 
                    endereco = :endereco, 
                    postoAtendimento = :postoAtendimento, 
                    dataNascimento = :dataNascimento, 
                    created = :created";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomePacientes=htmlspecialchars(strip_tags($this->nomePacientes));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->cartaoSus=htmlspecialchars(strip_tags($this->cartaoSus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));
        $this->postoAtendimento=htmlspecialchars(strip_tags($this->postoAtendimento));
        $this->dataNascimento=htmlspecialchars(strip_tags($this->dataNascimento));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind data
        $stmt->bindParam(":nomePacientes", $this->nomePacientes);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cartaoSus", $this->cartaoSus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":postoAtendimento", $this->postoAtendimento);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":created", $this->created);
    
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
                    cpf = :cpf, 
                    cartaoSus = :cartaoSus, 
                    endereco = :endereco, 
                    telefone = :telefone, 
                    postoAtendimento = :postoAtendimento, 
                    dataNascimento = :dataNascimento, 
                    created = :created
                WHERE
                    id = :id";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomePacientes=htmlspecialchars(strip_tags($this->nomePacientes));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->cartaoSus=htmlspecialchars(strip_tags($this->cartaoSus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));
        $this->postoAtendimento=htmlspecialchars(strip_tags($this->postoAtendimento));
        $this->dataNascimento=htmlspecialchars(strip_tags($this->dataNascimento));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind data
        $stmt->bindParam(":nomePacientes", $this->nomePacientes);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cartaoSus", $this->cartaoSus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":postoAtendimento", $this->postoAtendimento);
        $stmt->bindParam(":dataNascimento", $this->dataNascimento);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Lista apenas um registro

    public function SingleOn(){
        $sql = "SELECT * FROM " . $this->db_tabela . " WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $cadpacientes = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->nomePacientes = $cadpacientes['nomePacientes'];
        $this->cpf = $cadpacientes['cpf'];
        $this->cartaoSus = $cadpacientes['cartaoSus'];
        $this->endereco = $cadpacientes['endereco'];
        $this->telefone = $cadpacientes['telefone'];
        $this->postoAtendimento = $cadpacientes['postoAtendimento'];
        $this->dataNascimento = $cadpacientes['dataNascimento'];
        $this->created = $cadpacientes['created'];
    }


    // Deletar registro de paciente
    public function Delete(){
        $sql = "DELETE FROM
                    ". $this->db_tabela ."
                WHERE
                    id = :id";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind data
        $stmt->bindParam(":id", $this->id);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }



    
}
?>