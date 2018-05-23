<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 14:41
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_actionDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_actionDAO();
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_action = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_cod_action = (isset($_POST["code"]) && $_POST["code"] != null) ? $_POST["code"] : "";
    $str_name_action = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_action = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_cod_action = NULL;
    $str_name_action = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_action != "") {
    $tb_action = new tb_action($id_action, '','');
    $resultado = $object->atualizar($tb_action);
    $str_cod_action = $resultado->getStrCodAction();
    $str_name_action = $resultado->getStrNameAction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_action != "") {
    $tb_action = new tb_action($id_action, $str_cod_action,$str_name_action );
    $msg =$object->salvar($tb_action);
    $id_action = null;
    $str_cod_action = null;
    $str_name_action = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_action != "") {
    $tb_action = new tb_action($id_action, '', '');
    $msg = $object->remover($tb_action);
    $id_action = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Ações</h4>
                            <p class='category'>Lista de ações do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_action) && ($id_action != null || $id_action != "")) ? $id_action : '';
                                ?>" />
                                Código:
                                <input type="text" size="10" name="code" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_cod_action) && ($str_cod_action != null || $str_cod_action != "")) ? $str_cod_action : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_action) && ($str_name_action != null || $str_name_action != "")) ? $str_name_action : '';
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