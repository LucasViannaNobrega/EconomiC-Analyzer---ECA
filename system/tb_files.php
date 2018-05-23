<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 21/05/2018
 * Time: 10:01
 */
//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_filesDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_filesDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_file = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_nome_file = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $str_month = (isset($_POST["month"]) && $_POST["month"] != null) ? $_POST["month"] : "";
    $str_year = (isset($_POST["year"]) && $_POST["year"] != null) ? $_POST["year"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_file = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_nome_file = NULL;
    $str_month = NULL;
    $str_year = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_file != "") {
    $tb_file = new tb_file($id_file, '','','');
    $resultado = $object->atualizar($tb_file);
    $str_nome_file = $resultado->getStrNameFile();
    $str_month = $resultado->getStrMmonth();
    $str_year = $resultado->getStrYear();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_month != "") {
    $tb_file = new tb_file($id_file, $str_nome_file,$str_month,$str_year);
    $msg =$object->salvar($tb_file);
    $id_file = null;
    $str_nome_file = null;
    $str_month = null;
    $str_year = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_file != "") {
    $tb_file = new tb_file($id_file, '', '','');
    $msg = $object->remover($tb_file);
    $id_file = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Arquivos</h4>
                            <p class='category'>Lista de arquivos do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_file) && ($id_file != null || $id_file != "")) ? $id_file : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="uf" value="<?php
                                // Preenche o uf no campo uf com um valor "value"
                                echo (isset($str_nome_file) && ($str_nome_file != null || $str_nome_file != "")) ? $str_nome_file : '';
                                ?>" />
                                Mês:
                                <input type="text" size="10" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_month) && ($str_month != null || $str_month != "")) ? $str_month : '';
                                ?>" />
                                Ano:
                                <input type="text" size="10" name="region" value="<?php
                                // Preenche o region no campo region com um valor "value"
                                echo (isset($str_year) && ($str_year != null || $str_year != "")) ? $str_year : '';
                                ?>" />
                                <input type="submit" VALUE="Cadastrar"/>
                                <hr>
                            </form>
                            <?php
                            echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                            //chamada a paginação
                            $object->tabelapaginada();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$template->footer();
?>