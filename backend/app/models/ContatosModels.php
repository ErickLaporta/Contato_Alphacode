<?php

class ContatosModels {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    private function bindParams($stmt, $dados) {
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':telefone', $dados['telefone']);
        $stmt->bindParam(':celular', $dados['celular']);
        $stmt->bindParam(':profissao', $dados['profissao']);
        $stmt->bindParam(':nascimento', $dados['nascimento']);
        $stmt->bindParam(':whatsapp', $dados['whatsapp']);
        $stmt->bindParam(':sms', $dados['sms']);
        $stmt->bindParam(':notificarEmail', $dados['notificarEmail']);
    }

    public function cadastrarContato($dados) {       
        $sql = "INSERT INTO contatos(nome, email, telefone, celular, profissao, nascimento, whatsapp, sms, notificarEmail)
        VALUES (:nome, :email, :telefone, :celular, :profissao, :nascimento, :whatsapp, :sms, :notificarEmail)";
    
        $stmt = $this->pdo->prepare($sql);
        
        $this->bindParams($stmt, $dados);
            
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    public function editarContato($id, $dados) {
        $sql = "UPDATE contatos SET nome = :nome, email = :email, telefone = :telefone, celular = :celular, profissao = :profissao, nascimento = :nascimento, whatsapp = :whatsapp, sms = :sms, notificarEmail = :notificarEmail 
        WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        $this->bindParams($stmt, $dados);
   
        return $stmt->execute();
    }

    public function listarContatos() {
        $sql = "SELECT * FROM contatos ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluirContato($id) {
        $sql = "DELETE FROM contatos WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}

?>