<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 06/06/2018
 * Time: 15:39
 */

require_once "conection.php";
require_once "classes/tb_user.php";
class tb_userDAO
{
    public function remover($tb_user){
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM tb_user WHERE id_user = :id");
            $statement->bindValue(":id", $tb_user->getIdUser());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }


    public function salvar($tb_user){
        global $pdo;
        try {
            if ($tb_user->getIdAction() != "") {
                $statement = $pdo->prepare("UPDATE tb_user SET  str_login=:login, str_senha=:senha, str_name=:nome,str_email=:email,int_reset=:reset, int_adm=:admin WHERE id_user = :id;");
                $statement->bindValue(":id", $tb_user->getIdUser());
            } else {
                $statement = $pdo->prepare("INSERT INTO tb_user (str_login, str_senha, str_name, str_email, int_reset, int_adm) VALUES (:login,:senha,:nome,:email,:reset,:admin)");
            }
            $statement->bindValue(":login",$tb_user->getStrLogin());
            $statement->bindValue(":senha",$tb_user->getStrSenha());
            $statement->bindValue(":nome",$tb_user->getStrName());
            $statement->bindValue(":email",$tb_user->getStrEmail());
            $statement->bindValue(":reset",$tb_user->getIntReset());
            $statement->bindValue(":admin",$tb_user->getIntAdm());
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
    public function atualizar($tb_user){
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT id_user, str_login, str_senha,str_name, str_email, int_reset, int_adm FROM tb_user WHERE id_user = :id");
            $statement->bindValue(":id", $tb_user->getIdUser());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $tb_user->setIdUser($rs->id_user);
                $tb_user->setStrLogin($rs->str_login);
                $tb_user->setStrSenha($rs->str_senha);
                $tb_user->setStrName($rs->str_name);
                $tb_user->setStrEmail($rs->str_email);
                $tb_user->setIntReset($rs->int_reset);
                $tb_user->setIntAdm($rs->int_adm);
                return $tb_user;
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
        $sql = "SELECT id_user, str_login, str_senha,str_name, str_email, int_reset, int_adm FROM tb_user LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);
        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM tb_user";
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
        <th>Login</th>
        <th>Senha</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Resetar</th>
        <th>Admin</th>
        <th colspan='2'>Usuários</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $inst):
                echo "<tr>
        <td>$inst->id_user</td>
        <td>$inst->str_login</td>
        <td>$inst->str_senha</td>
        <td>$inst->str_name</td>
        <td>$inst->str_email</td>
        <td>$inst->int_reset</td>
        <td>$inst->int_adm</td>
        <td><a href='?act=upd&id=$inst->id_user'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$inst->id_user'><i class='ti-close'></i></a></td>
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