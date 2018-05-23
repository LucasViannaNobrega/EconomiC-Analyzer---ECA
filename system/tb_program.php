<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 16:13
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_programDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_programDAO();
// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_program = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_cod_program = (isset($_POST["code"]) && $_POST["code"] != null) ? $_POST["code"] : "";
    $str_name_program = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_program = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_cod_program = NULL;
    $str_name_program = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_program != "") {
    $tb_program = new tb_program($id_program, '','');
    $resultado = $object->atualizar($tb_program);
    $str_cod_program = $resultado->getStrCodProgram();
    $str_name_program = $resultado->getStrNameProgram();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_program != "") {
    $tb_program = new tb_program($id_program, $str_cod_program,$str_name_program );
    $msg =$object->salvar($tb_program);
    $id_program = null;
    $str_cod_program = null;
    $str_name_program = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_program != "") {
    $tb_program = new tb_program($id_program, '', '');
    $msg = $object->remover($tb_program);
    $id_program = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Programas</h4>
                            <p class='category'>Lista de programas do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_program) && ($id_program != null || $id_program != "")) ? $id_program : '';
                                ?>" />
                                Código:
                                <input type="text" size="10" name="code" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_cod_program) && ($str_cod_program != null || $str_cod_program != "")) ? $str_cod_program : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_program) && ($str_name_program != null || $str_name_program != "")) ? $str_name_program : '';
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