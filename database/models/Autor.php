<?php

namespace ConexaoPHPPostgres;

class AutorModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_autor", "Nome" FROM sbd."LIVRO_AUTOR";');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_autor' => $row['Cod_autor'],
                'Nome' => $row['Nome'],
            ];
        }
        return $stocks;
    }
    
    public function autorWithTitle(){
        $sql = 'SELECT DISTINCT "Cod_autor", "Nome_autor", "Titulo" FROM sbd."LIVRO" INNER JOIN sbd."LIVRO_AUTOR" ON "Nome"="Nome_autor" ORDER BY "Cod_autor" ASC;';
        $stmt = $this->pdo->query($sql);

        $stocks = [];
       
        // output data of each row
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_autor' => $row['Cod_autor'],
                'Nome_autor' => $row['Nome_autor'],
                'Titulo' => $row['Titulo'],
                ];
        }
        
        return $stocks;
    }

    public function teste($Nome_autor){
        $sql = "SELECT DISTINCT \"Cod_livro\", \"Titulo\" FROM sbd.\"LIVRO\"AS l INNER JOIN sbd.\"LIVRO_AUTOR\" ON l.\"Nome_autor\"='$Nome_autor';";
        $stmt = $this->pdo->query($sql);

        $stocks = [];
       
        // output data of each row
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Titulo' => $row['Titulo'],
                'Cod_livro' => $row['Cod_livro'],
                ];
        }
        
        return $stocks;
    }
    

    public function insert($Nome_autor)
    {
        $sql = "INSERT INTO sbd.\"LIVRO_AUTOR\" (\"Nome\") VALUES (:Nome);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Nome', $Nome_autor);
        $stmt->execute();
    }

    public function update($Cod_autor, $Nome_autor){
        $sql = "SELECT DISTINCT \"Nome\" FROM sbd.\"LIVRO_AUTOR\" WHERE \"Cod_autor\"=$Cod_autor;";
        $stmt = $this->pdo->query($sql);

        $stocks = [];
      
        // output data of each row
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Nome' => $row['Nome'],
            ];
            
        }
        if (empty($stocks)) {
            header("Location: ../../pages/CadAutor.php?MSG=Autor não encontrado");
        }
        
        $auxiliar = implode(',', $stocks[0]);

        $sql = "UPDATE sbd.\"LIVRO\" SET \"Nome_autor\"='$Nome_autor' WHERE \"Nome_autor\"='$auxiliar';";
        $stmt = $this->pdo->query($sql);
        
        $sql = "UPDATE sbd.\"LIVRO_AUTOR\" SET \"Nome\"='$Nome_autor' WHERE \"Cod_autor\"=$Cod_autor;";
        $stmt = $this->pdo->query($sql);
       
    }
    
     public function ddelete($Cod_autor)
    {
        $sql = "DELETE FROM sbd.\"LIVRO_AUTOR\" WHERE \"Cod_autor\"=$Cod_autor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
}
