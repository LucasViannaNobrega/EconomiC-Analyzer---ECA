<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 21/05/2018
 * Time: 10:29
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_subfunctionDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_subfunctionDAO();
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_subfunction = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_cod_subfunction = (isset($_POST["code"]) && $_POST["code"] != null) ? $_POST["code"] : "";
    $str_name_subfunction = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_subfunction = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_cod_subfunction = NULL;
    $str_name_subfunction = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_subfunction != "") {
    $tb_subfunction = new tb_subfunction($id_subfunction, '','');
    $resultado = $object->atualizar($tb_subfunction);
    $str_cod_subfunction = $resultado->getStrCodSubfunction();
    $str_name_subfunction = $resultado->getStrNameSubfunction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_subfunction != "") {
    $tb_subfunction = new tb_subfunction($id_subfunction, $str_cod_subfunction,$str_name_subfunction );
    $msg =$object->salvar($tb_subfunction);
    $id_subfunction = null;
    $str_cod_subfunction = null;
    $str_name_subfunction = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_subfunction != "") {
    $tb_subfunction = new tb_subfunction($id_subfunction, '', '');
    $msg = $object->remover($tb_subfunction);
    $id_subfunction = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>SubFunções</h4>
                            <p class='category'>Lista de subfunções do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_subfunction) && ($id_subfunction != null || $id_subfunction != "")) ? $id_subfunction : '';
                                ?>" />
                                Código:
                                <input type="text" size="10" name="code" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_cod_subfunction) && ($str_cod_subfunction != null || $str_cod_subfunction != "")) ? $str_cod_subfunction : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_subfunction) && ($str_name_subfunction != null || $str_name_subfunction != "")) ? $str_name_subfunction : '';
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