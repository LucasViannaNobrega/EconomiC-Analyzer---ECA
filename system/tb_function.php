<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 21/05/2018
 * Time: 10:49
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_functionDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_functionDAO();
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_function = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_cod_function = (isset($_POST["code"]) && $_POST["code"] != null) ? $_POST["code"] : "";
    $str_name_function = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_function = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_cod_function = NULL;
    $str_name_function = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_function != "") {
    $tb_function = new tb_function($id_function, '','');
    $resultado = $object->atualizar($tb_function);
    $str_cod_function = $resultado->getStrCodFunction();
    $str_name_function = $resultado->getStrNameFunction();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_function != "") {
    $tb_function = new tb_function($id_function, $str_cod_function,$str_name_function );
    $msg =$object->salvar($tb_function);
    $id_function = null;
    $str_cod_function = null;
    $str_name_function = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_function != "") {
    $tb_function = new tb_function($id_function, '', '');
    $msg = $object->remover($tb_function);
    $id_function = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Funções</h4>
                            <p class='category'>Lista de funções do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_function) && ($id_function != null || $id_function != "")) ? $id_function : '';
                                ?>" />
                                Código:
                                <input type="text" size="10" name="code" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_cod_function) && ($str_cod_function != null || $str_cod_function != "")) ? $str_cod_function : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_function) && ($str_name_function != null || $str_name_function != "")) ? $str_name_function : '';
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