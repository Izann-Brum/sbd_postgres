<?php

namespace ConexaoPHPPostgres;

class EditoraModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_editora", "Nome", "Endereco", "Telefone" FROM sbd."EDITORA"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_editora' => $row['Cod_editora'],
                'Nome' => $row['Nome'],
                'Endereco' => $row['Endereco'],
                'Telefone' => $row['Telefone']
            ];
        }
        return $stocks;
    }

    public function ddelete($Cod_editora)
    {
        $sql = "DELETE FROM sbd.\"EDITORA\" WHERE \"Cod_editora\"=$Cod_editora";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
       
    }

    public function insert($Nome_editora, $Endereco, $Telefone)
    {
        $sql = "INSERT INTO sbd.\"EDITORA\" (\"Nome\",\"Endereco\",\"Telefone\") VALUES (:Nome, :Endereco, :Telefone);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome', $Nome_editora);
        $stmt->bindValue(':Endereco', $Endereco);
        $stmt->bindValue(':Telefone', $Telefone);
        $stmt->execute();
    }

    public function update($Cod_editora, $Nome, $Endereco, $Telefone){
        $sql = "SELECT DISTINCT \"Nome\" FROM sbd.\"EDITORA\" WHERE \"Cod_editora\"=$Cod_editora;";
        $stmt = $this->pdo->query($sql);

        $stocks = [];
      
        // output data of each row
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Nome' => $row['Nome'],
            ];
            
        }
        if (empty($stocks)) {
            header("Location: ../../pages/CadAutor.php?MSG=Editora não encontrada");
        }
        
        $auxiliar = implode(',', $stocks[0]);

        $sql = "UPDATE sbd.\"LIVRO\" SET \"Nome_editora\"='$Nome' WHERE \"Nome_editora\"='$auxiliar';";
        $stmt = $this->pdo->query($sql);
        

        $sql = "UPDATE sbd.\"EDITORA\" SET \"Nome\"='$Nome', \"Endereco\"='$Endereco', \"Telefone\"='$Telefone' WHERE \"Cod_editora\"=$Cod_editora";
        $stmt = $this->pdo->query($sql);
        
    }

}
