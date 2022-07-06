<?php

namespace ConexaoPHPPostgres;

class UnidadeModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_unidade", "Nome","Endereco" FROM sbd."UNIDADE_BIBLIOTECA"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome' => $row['Nome'],
                'Endereco' => $row['Endereco'],
            ];
        }
        return $stocks;
    }

    public function insert($Nome_unidade, $Endereco)
    {
        $sql = 'INSERT INTO sbd."UNIDADE_BIBLIOTECA" ("Nome", "Endereco") VALUES (:Nome, :Endereco)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome', $Nome_unidade);
        $stmt->bindValue(':Endereco', $Endereco);
        $stmt->execute();
    }


    
    public function update($Cod_unidade, $Nome_unidade, $Endereco)
    {
        $sql = "UPDATE sbd.\"UNIDADE_BIBLIOTECA\" SET \"Nome\"='$Nome_unidade', \"Endereco\"='$Endereco' WHERE \"Cod_unidade\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function ddelete($Cod_unidade)
	{
        $sql = "DELETE FROM sbd.\"UNIDADE_BIBLIOTECA\" WHERE \"Cod_unidade\" = $Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}
