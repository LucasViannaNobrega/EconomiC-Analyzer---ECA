<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 21/05/2018
 * Time: 10:53
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_sourceDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_sourceDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_source = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_goal = (isset($_POST["goal"]) && $_POST["goal"] != null) ? $_POST["goal"] : "";
    $str_origin = (isset($_POST["origin"]) && $_POST["origin"] != null) ? $_POST["origin"] : "";
    $str_periodicity = (isset($_POST["periodicity"]) && $_POST["periodicity"] != null) ? $_POST["periodicity"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_source = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_goal = NULL;
    $str_origin = NULL;
    $str_periodicity = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_source != "") {
    $tb_source = new tb_source($id_source, '','','');
    $resultado = $object->atualizar($tb_source);
    $str_goal = $resultado->getStrGoal();
    $str_origin = $resultado->getStrOrigin();
    $str_periodicity = $resultado->getStrPeriodicity();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_origin != "") {
    $tb_source = new tb_source($id_source, $str_goal,$str_origin,$str_periodicity);
    $msg =$object->salvar($tb_source);
    $id_source = null;
    $str_goal = null;
    $str_origin = null;
    $str_periodicity = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_source != "") {
    $tb_source = new tb_source($id_source, '', '','');
    $msg = $object->remover($tb_source);
    $id_source = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Fonte</h4>
                            <p class='category'>Lista de fonte do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_source) && ($id_source != null || $id_source != "")) ? $id_source : '';
                                ?>" />
                                Objetivo:
                                <input type="text" size="40" name="goal" value="<?php
                                // Preenche o uf no campo uf com um valor "value"
                                echo (isset($str_goal) && ($str_goal != null || $str_goal != "")) ? $str_goal : '';
                                ?>" />
                                Origem:
                                <input type="text" size="10" name="oringin" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_origin) && ($str_origin != null || $str_origin != "")) ? $str_origin : '';
                                ?>" />
                                Periodicidade:
                                <input type="text" size="10" name="periodicity" value="<?php
                                // Preenche o region no campo region com um valor "value"
                                echo (isset($str_periodicity) && ($str_periodicity != null || $str_periodicity != "")) ? $str_periodicity : '';
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