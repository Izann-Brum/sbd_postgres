<?php

namespace ConexaoPHPPostgres;

class EmprestimoModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function diminuirCopias($Cod_livro, $Cod_unidade)
    {
        $sql = "UPDATE sbd.\"LIVRO_COPIAS\" SET \"Qt_copia\" = \"Qt_copia\" - 1 WHERE \"Cod_livro\"=$Cod_livro AND \"Cod_unidade\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function aumentarCopias($Cod_livro, $Cod_unidade)
    {
        $sql = "UPDATE sbd.\"LIVRO_COPIAS\" SET \"Qt_copia\" = \"Qt_copia\" + 1 WHERE \"Cod_livro\"=$Cod_livro AND \"Cod_unidade\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function getULA()
    {
        $stmt = $this->pdo->query('SELECT DISTINCT le."Num_cartao", U."Nome" , le."Cod_livro", LV."Titulo", le."Cod_unidade", UB."Nome" "Nome_unidade", to_char("Data_emprestimo", \'DD-MM-YYYY\')"Data_emprestimo", to_Char("Data_devolucao", \'DD-MM-YYYY\')"Data_devolucao" 
        FROM sbd."LIVRO_EMPRESTIMO" AS le
        INNER JOIN sbd."UNIDADE_BIBLIOTECA" AS UB ON UB."Cod_unidade"=le."Cod_unidade"
        INNER JOIN sbd."USUARIO" AS U ON  U."Num_cartao"=le."Num_cartao"
        INNER JOIN sbd."LIVRO" AS LV ON LV."Cod_livro"=le."Cod_livro" ORDER BY "Data_devolucao" ASC;');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Num_cartao' => $row['Num_cartao'],
                'Nome' => $row['Nome'],
                'Cod_livro' => $row['Cod_livro'],
                'Titulo' => $row['Titulo'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Nome_unidade' => $row['Nome_unidade'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        return $stocks;
    }
    
    public function all()
    {
        $stmt = $this->pdo->query('SELECT "Cod_livro", "Cod_unidade", "Num_cartao", to_char("Data_emprestimo", \'DD-MM-YYYY\')"Data_emprestimo", to_Char("Data_devolucao", \'DD-MM-YYYY\')"Data_devolucao" FROM sbd."LIVRO_EMPRESTIMO"');
        $stocks = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $stocks[] = [
                'Cod_livro' => $row['Cod_livro'],
                'Cod_unidade' => $row['Cod_unidade'],
                'Num_cartao' => $row['Num_cartao'],
                'Data_emprestimo' => $row['Data_emprestimo'],
                'Data_devolucao' => $row['Data_devolucao']
            ];
        }
        return $stocks;
    }

    public function ddelete($Numero_cartao, $Cod_livro, $Cod_unidade)
    {
        $sql = "DELETE from sbd.\"LIVRO_EMPRESTIMO\" WHERE \"Cod_livro\"=$Cod_livro AND \"Cod_unidade\"=$Cod_unidade AND \"Num_cartao\"=$Numero_cartao";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }   

    public function insert($Cod_livro, $Cod_unidade, $Numero_cartao, $Data_emprestimo, $Data_devolucao)
    {
        $sql = "INSERT INTO sbd.\"LIVRO_EMPRESTIMO\" (\"Cod_livro\", \"Cod_unidade\", \"Num_cartao\", \"Data_emprestimo\", \"Data_devolucao\") VALUES ($Cod_livro, $Cod_unidade, $Numero_cartao, TO_DATE('$Data_emprestimo','DD-MM-YYYY'), TO_DATE('$Data_devolucao','DD-MM-YYYY'));";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function update($Data_emprestimo, $Data_devolucao, $Cod_livro, $Cod_unidade){
        $ano = substr($Data_emprestimo,0,4);
        $ano = $ano+(1);
        $Data_devolucao = $ano.substr($Data_emprestimo,4);
        $sql = "UPDATE \"Livro_emprestimo\" SET \"Data_emprestimo\"=TO_DATE ('$Data_emprestimo','DD-MM-YYYY'), \"Data_devolucao\"=TO_DATE ('$Data_devolucao','DD-MM-YYYY') WHERE \"Cod_livro_emprestimo\"=$Cod_livro AND \"Cod_unidade_emprestimo\"=$Cod_unidade";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

}