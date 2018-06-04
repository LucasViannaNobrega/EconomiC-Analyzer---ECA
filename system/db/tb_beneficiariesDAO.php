<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 25/05/2018
 * Time: 10:21
 */

require_once "conection.php";
require_once "../classes/tb_beneficiaries.php";


class tb_beneficiariesDAO
{
    public function remover($tb_beneficiaries){
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_beneficiaries WHERE id_beneficiaries = :id");
            $statement->bindValue(":id", $tb_beneficiaries->getIdBeneficiaries());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }


    public function salvar($tb_beneficiaries){
        global $pdo;
        try {
            if ($tb_beneficiaries->getIdBeneficiaries() != "") {
                $statement = $pdo->prepare("UPDATE tb_beneficiaries SET str_nis=:code, str_name_person=:nome WHERE id_beneficiaries = :id;");
                $statement->bindValue(":id", $tb_beneficiaries->getIdBeneficiaries());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_beneficiaries (str_nis, str_name_person) VALUES (:code,:nome)");
            }
            $statement->bindValue(":code",$tb_beneficiaries->getStrNis());
            $statement->bindValue(":nome",$tb_beneficiaries->getStrNamePerson());
            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
    public function atualizar($tb_beneficiaries){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_beneficiaries, str_nis, str_name_person FROM tb_beneficiaries WHERE id_beneficiaries = :id");
            $statement->bindValue(":id", $tb_beneficiaries->getIdBeneficiaries());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $tb_beneficiaries->setIdBeneficiaries($rs->id_beneficiaries);
                $tb_beneficiaries->setStrNis($rs->str_nis);
                $tb_beneficiaries->setStrNamePerson($rs->str_name_person);
                return $tb_beneficiaries;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }
    public function tabelapaginada() {
        //carrega o banco
        global $pdo;
        //endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];
        /* Constantes de configuração */
        define('QTDE_REGISTROS', 10);
        define('RANGE_PAGINAS', 1);
        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;
        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT id_beneficiaries, str_nis, str_name_person FROM tb_beneficiaries LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);
        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_beneficiaries";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);
        /* Idêntifica a primeira página */
        $primeira_pagina = 1;
        /* Cálcula qual será a última página */
        $ultima_pagina  = ceil($valor->total_registros / QTDE_REGISTROS);
        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;
        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;
        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;
        /* Cálcula qual será a página final do nosso range */
        $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;
        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';
        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';
        if (!empty($dados)):
            echo "
     <table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>ID</th>
        <th>Código</th>
        <th>Nome</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_beneficiaries</td>
        <td>$inst->str_nis</td>
        <td>$inst->str_name_person</td>
        <td><a href='?act=upd&id=$inst->id_beneficiaries'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->id_beneficiaries'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo"
     </tbody>
     </table>
     <div class='box-paginacao'>
       <a class='box-navegacao  $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";
            /* Loop para montar a páginação central com os números */
            for ($i=$range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;
                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;
            echo "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
     <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>
     ";
        endif;
    }

    public function findAll()
    {
        global $pdo;
        try {
            $statement = $pdo->prepare('SELECT id_beneficiaries, str_nis,str_name_person FROM tb_beneficiaries ORDER BY str_name_person');
            if ($statement->execute()) {
                $lista = $statement->fetchAll(PDO::FETCH_OBJ);
                return $lista;
            }else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        }catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function findId($id)
    {
        $beneficiaries = new tb_beneficiaries();
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_beneficiaries, str_nis, str_name_person FROM tb_beneficiaries WHERE id_beneficiaries = $id");
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $beneficiaries->setIdBeneficiaries($rs->id_beneficiaries);
                $beneficiaries->setStrNis($rs->str_nis);
                $beneficiaries->setStrNamePerson($rs->str_name_person);

                return $beneficiaries;
            } else {
                throw new PDOException("<script> alert('Erro: Não foi possível executar a declaração sql'); </script>");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

}