<?php
class Usuarios{

    //Conexão com banco de dados
    private $conn;

    //Nome da Tabela
    private $db_tabela = "cadusuarios";

    //Colunas da Tabelas
    public $idcadUsuarios;
    public $nomeUsuarios;
    public $cpf;
    public $senha;
    public $tipo;
    public $datacadUsuarios;

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
                    nomeUsuarios = :nomeUsuarios, 
                    cpf = :cpf, 
                    senha = :senha, 
                    tipo = :tipo, 
                    telefone = :telefone, 
                    postoAtendimento = :postoAtendimento, 
                    dataNascimento = :dataNascimento";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomeUsuarios=htmlspecialchars(strip_tags($this->nomeUsuarios));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->senha=htmlspecialchars(strip_tags($this->senha));
        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        
    
        // bind data
        $stmt->bindParam(":nomeUsuarios", $this->nomeUsuarios);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":tipo", $this->tipo);
        
    
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
                    nomeUsuarios = :nomeUsuarios, 
                    cpf = :cpf, 
                    senha = :senha, 
                    tipo = :tipo, 
                WHERE
                    idcadUsuarios = :idcadUsuarios";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->nomeUsuarios=htmlspecialchars(strip_tags($this->nomeUsuarios));
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->senha=htmlspecialchars(strip_tags($this->senha));
        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        $this->idcadUsuarios=htmlspecialchars(strip_tags($this->idcadUsuarios));
    
        // bind data
        $stmt->bindParam(":nomeUsuarios", $this->nomeUsuarios);
        $stmt->bindParam(":cpf", $this->cpf);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":idcadUsuarios", $this->idcadUsuarios);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    //Lista apenas um registro

    public function SingleOn(){
        $sql = "SELECT * FROM " . $this->db_tabela . " WHERE idcadUsuarios = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->idcadUsuarios);
        $stmt->execute();
        $cadpacientes = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->nomeUsuarios = $cadpacientes['nomeUsuarios'];
        $this->cpf = $cadpacientes['cpf'];
        $this->senha = $cadpacientes['senha'];
        $this->tipo = $cadpacientes['tipo'];
        $this->datacadUsuarios = $cadpacientes['datacadUsuarios'];
    }


    // Deletar registro de paciente
    public function Delete(){
        $sql = "DELETE FROM
                    ". $this->db_tabela ."
                WHERE
                    idcadUsuarios = :idcadUsuarios";
    
        $stmt = $this->conn->prepare($sql);
    
        // sanitize
        $this->idcadUsuarios=htmlspecialchars(strip_tags($this->idcadUsuarios));
    
        // bind data
        $stmt->bindParam(":idcadUsuarios", $this->idcadUsuarios);
    
        if($stmt->execute()){
            return true;
        }
        return false;
    }



    
}
?>