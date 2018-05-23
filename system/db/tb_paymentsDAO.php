<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 15/05/2018
 * Time: 09:56
 */

require_once "conection.php";
require_once "classes/tb_payments.php";

class tb_paymentsDAO
{
    public function remover($tb_payments){
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_payments WHERE id_payment = :id");
            $statement->bindValue(":id", $tb_payments->getIdSPayment());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }


    public function salvar($tb_payments){
        global $pdo;
        try {
            if ($tb_payments->getIdAction() != "") {
                $statement = $pdo->prepare("UPDATE tb_payments SET  tb_city_id_city=:city, tb_functon_id_function=:function, tb_subfunction_id_subfunction=:subfunction,tb_program_id_program=:program,tb_action_id_action=:action, tb_beneficiaries_id_beneficiaries=:beneficiaries,tb_source_id_source=:source,tb_files_id_file=:file,db_value=:value WHERE id_payment = :id;");
                $statement->bindValue(":id", $tb_payments->getIdPayment());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_payments (tb_city_id_city, tb_functon_id_function, tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file, db_value ) VALUES (:city,:function,:subfunction,:program,:action,:beneficiaries,:source,:file,:value)");
            }
            $statement->bindValue(":city",$tb_payments->getTbCityIdCity());
            $statement->bindValue(":function",$tb_payments->getTbFunctonIdFunction());
            $statement->bindValue(":subfunction",$tb_payments->getTbSubfunctionIdSubfunction());
            $statement->bindValue(":program",$tb_payments->getTbProgramIdProgram());
            $statement->bindValue(":action",$tb_payments->getTbActionIdAction());
            $statement->bindValue(":beneficiaries",$tb_payments->getTbBeneficiariesIdBeneficiaries());
            $statement->bindValue(":source",$tb_payments->getTbSourceIdSource());
            $statement->bindValue(":file",$tb_payments->getTbFilesIdFile());
            $statement->bindValue(":value",$tb_payments->getDbValue());
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
    public function atualizar($tb_payments){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_payment, tb_city_id_city, tb_functon_id_function,tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file, db_value FROM tb_payments WHERE id_payment = :id");
            $statement->bindValue(":id", $tb_payments->getIdPayment());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $tb_payments->setIdPayment($rs->id_payment);
                $tb_payments->setTbCityIdCity($rs->tb_city_id_city);
                $tb_payments->setTbFunctonIdFunction($rs->tb_functon_id_function);
                $tb_payments->setTbSubfunctionIdSubfunction($rs->tb_subfunction_id_subfunction);
                $tb_payments->setTbProgramIdProgram($rs->tb_program_id_program);
                $tb_payments->setTbActionIdAction($rs->tb_action_id_action);
                $tb_payments->setTbBeneficiariesIdBeneficiaries($rs->tb_beneficiaries_id_beneficiaries);
                $tb_payments->setTbSourceIdSource($rs->tb_source_id_source);
                $tb_payments->setTbFilesIdFile($rs->tb_files_id_file);
                $tb_payments->setDbValue($rs->db_value);
                return $tb_payments;
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
        $sql = "SELECT id_payment, tb_city_id_city, tb_functon_id_function,tb_subfunction_id_subfunction, tb_program_id_program, tb_action_id_action, tb_beneficiaries_id_beneficiaries, tb_source_id_source ,tb_files_id_file, db_value  FROM tb_payments LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);
        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_payments";
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
        <th>Cidade</th>
        <th>Função</th>
        <th>Subfunção</th>
        <th>Programa</th>
        <th>Ação</th>
        <th>Beneficiário</th>
        <th>Fonte</th>
        <th>Arquivo</th>
        <th>Valor</th>
        <th colspan='2'>Cidades</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_payment</td>
        <td>$inst->tb_city_id_city</td>
        <td>$inst->tb_functon_id_function</td>
        <td>$inst->tb_subfunction_id_subfunction</td>
        <td>$inst->tb_program_id_program</td>
        <td>$inst->tb_action_id_action</td>
        <td>$inst->tb_beneficiaries_id_beneficiaries</td>
        <td>$inst->tb_source_id_source</td>
        <td>$inst->tb_files_id_file</td>
        <td>$inst->db_value</td>
        <td><a href='?act=upd&id=$inst->id_payment'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->id_payment'><i class='ti-close'></i></a></td>
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
}