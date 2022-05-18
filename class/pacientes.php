<?php
class Paciente{

    //Conexão com banco de dados
    private $conn;

    //Nome da Tabela
    private $db_tabela = "pacientes";

    //Colunas da Tabelas
    public $id;
    public $nome;
    public $cpf;
    public $cardsus;
    public $endereco;
    public $postoatendimento;
    public $dtnascimento;
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
                    nome = :nome, 
                    cpf = :cpf, 
                    cardsus = :cardsus, 
                    endereco = :endereco, 
                    postoatendimento = :postoatendimento, 
                    dtnascimento = :dtnascimento, 
                    created = :created";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->cardsus=htmlspecialchars(strip_tags($this->cardsus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->postoatendimento=htmlspecialchars(strip_tags($this->postoatendimento));
        $this->dtnascimento=htmlspecialchars(strip_tags($this->dtnascimento));
        $this->created=htmlspecialchars(strip_tags($this->created));
    
        // bind data
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cardsus", $this->cardsus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":postoatendimento", $this->postoatendimento);
        $stmt->bindParam(":dtnascimento", $this->dtnascimento);
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
                    nome = :nome, 
                    cpf = :cpf, 
                    cardsus = :cardsus, 
                    endereco = :endereco, 
                    postoatendimento = :postoatendimento, 
                    dtnascimento = :dtnascimento, 
                    created = :created
                WHERE
                    id = :id";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->cardsus=htmlspecialchars(strip_tags($this->cardsus));
        $this->endereco=htmlspecialchars(strip_tags($this->endereco));
        $this->postoatendimento=htmlspecialchars(strip_tags($this->postoatendimento));
        $this->dtnascimento=htmlspecialchars(strip_tags($this->dtnascimento));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind data
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":cardsus", $this->cardsus);
        $stmt->bindParam(":endereco", $this->endereco);
        $stmt->bindParam(":postoatendimento", $this->postoatendimento);
        $stmt->bindParam(":dtnascimento", $this->dtnascimento);
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
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->nome = $paciente['nome'];
        $this->cpf = $paciente['cpf'];
        $this->cardsus = $paciente['cardsus'];
        $this->endereco = $paciente['endereco'];
        $this->postoatendimento = $paciente['postoatendimento'];
        $this->dtnascimento = $paciente['dtnascimento'];
        $this->created = $paciente['created'];
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