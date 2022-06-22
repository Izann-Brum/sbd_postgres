<?php

namespace ConexaoPHPPostgres;

class LivroModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

     public function getLivroAutor()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Titulo", "Nome_autor", "Nome_editora" FROM sbd."LIVRO_AUTOR" INNER JOIN sbd."LIVRO" ON "Nome_autor"="Nome";');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_autor' => $row['Nome_autor'],
                'Nome_editora' => $row['Nome_editora'],
            ];
        }
        return $stocks;
    }

    public function QuantidadeCopias($Cod_unidade, $Cod_livro)
    {      
       $stmt = $this->pdo->query("SELECT DISTINCT \"Qt_copia\" FROM sbd.\"UNIDADE_BIBLIOTECA\" 
       INNER JOIN sbd.\"LIVRO_COPIAS\" AS lc ON lc.\"Cod_unidade\"=$Cod_unidade 
       INNER JOIN sbd.\"LIVRO\" ON lc.\"Cod_livro\"=$Cod_livro;"); 
       $stock = []; 
       
      while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stock[] = [
                'Qt_copia' => $row['Qt_copia'],
            ];
        }
        
        if(empty($stock)) {
            $zero = 0;
            return $zero;
        }else{
            $arrayToString = implode(',', $stock[0]);
            $stringToInteger = intval($arrayToString);
            return $stringToInteger;
        }
    }

     public function getLivroCopias()
    {
        $stmt = $this->pdo->query("SELECT DISTINCT lc.\"Cod_livro\", \"Titulo\", \"Cod_autor\", \"Nome_autor\", ub.\"Cod_unidade\", ub.\"Nome\" AS \"Nome_unidade\", \"Qt_copia\" 
        FROM sbd.\"LIVRO_COPIAS\" AS lc 
        INNER JOIN sbd.\"LIVRO\" AS l ON l.\"Cod_livro\"=lc.\"Cod_livro\" 
        INNER JOIN sbd.\"LIVRO_AUTOR\" ON \"Nome\"=\"Nome_autor\"  
        INNER JOIN sbd.\"UNIDADE_BIBLIOTECA\" AS ub ON lc.\"Cod_unidade\"=ub.\"Cod_unidade\" ORDER BY \"Nome_unidade\" ASC;");
        
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Cod_autor' => $row['Cod_autor'],
                'Nome_autor' => $row['Nome_autor'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Qt_copia' => $row['Qt_copia'],
            ];
        }
        return $stocks;
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Titulo", "Nome_editora", "Nome_autor" FROM sbd."LIVRO"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Nome_editora' => $row['Nome_editora'],
                'Nome_autor' => $row['Nome_autor'],
            ];
        }
        return $stocks;
    }

    public function insert($Titulo, $Nome_editora, $Nome_autor)
    {
        $sql = "INSERT INTO sbd.\"LIVRO\" (\"Titulo\",\"Nome_editora\",\"Nome_autor\") VALUES (:Titulo, :Nome_editora, :Nome_autor)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':Titulo', $Titulo);
        $stmt->bindValue(':Nome_editora', $Nome_editora);
        $stmt->bindValue(':Nome_autor', $Nome_autor);
        $stmt->execute();
    }

    public function update($Cod_livro, $Titulo){
        $sql = "UPDATE sbd.\"LIVRO\" SET \"Titulo\"='$Titulo' WHERE \"Cod_livro\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

      public function ddelete($Cod_livro)
    {
        $sql = "DELETE FROM sbd.\"LIVRO\" WHERE \"Cod_livro\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $sql = "DELETE FROM sbd.\"LIVRO_COPIAS\" WHERE \"Cod_livro\"=$Cod_livro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function insertInLivroCopias($Cod_livro, $Cod_unidade, $Quantidade)
    {
        $sql = "INSERT INTO sbd.\"LIVRO_COPIAS\" (\"Cod_livro\",\"Cod_unidade\",\"Qt_copia\") VALUES ($Cod_livro, $Cod_unidade, $Quantidade);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

      public function ddeleteFromCopias($Cod_livro, $Cod_unidade)
    {
        $sql = "DELETE FROM sbd.\"LIVRO_COPIAS\" WHERE \"Cod_livro\"=$Cod_livro AND \"Cod_unidade\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function updateCopias($Cod_livro, $Cod_unidade, $Quantidade){
        $sql = "UPDATE sbd.\"LIVRO_COPIAS\" SET \"Qt_copia\"='$Quantidade' WHERE \"Cod_livro\"=$Cod_livro AND \"Cod_unidade\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }
    
}

// SELECT DISTINCT LIVRO.Cod_livro, Titulo, Nome_autor, UNIDADE_BIBLIOTECA.Cod_unidade, UNIDADE_BIBLIOTECA.Nome_unidade, Qt_copia FROM LIVRO_COPIAS INNER JOIN LIVRO ON LIVRO_COPIAS.Cod_livro=LIVRO.Cod_livro INNER JOIN LIVRO_AUTOR ON LIVRO.Nome_autor_l=LIVRO_AUTOR.Nome_autor INNER JOIN UNIDADE_BIBLIOTECA ON LIVRO_COPIAS.Cod_unidade=UNIDADE_BIBLIOTECA.Cod_unidade;