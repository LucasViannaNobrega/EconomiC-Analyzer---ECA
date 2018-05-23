<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/05/2018
 * Time: 16:31
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_beneficiariesDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_beneficiariesDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_beneficiaries = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_nis = (isset($_POST["nis"]) && $_POST["nis"] != null) ? $_POST["nis"] : "";
    $str_name_person = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_beneficiaries = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_nis = NULL;
    $str_name_person = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_beneficiaries != "") {
    $tb_beneficiaries = new tb_beneficiaries($id_beneficiaries, '','');
    $resultado = $object->atualizar($tb_beneficiaries);
    $str_nis = $resultado->getStrNis();
    $str_name_person = $resultado->getStrNamePerson();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_person != "") {
    $tb_beneficiaries = new tb_beneficiaries($id_beneficiaries, $str_nis,$str_name_person );
    $msg =$object->salvar($tb_beneficiaries);
    $id_beneficiaries = null;
    $str_nis = null;
    $str_name_person = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_beneficiaries != "") {
    $tb_beneficiaries = new tb_beneficiaries($id_beneficiaries, '', '');
    $msg = $object->remover($tb_beneficiaries);
    $id_beneficiaries = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Beneficiários</h4>
                            <p class='category'>Lista de beneficiários do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_beneficiaries) && ($id_beneficiaries != null || $id_beneficiaries != "")) ? $id_beneficiaries : '';
                                ?>" />
                                NIS:
                                <input type="text" size="10" name="nis" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_nis) && ($str_nis != null || $str_nis != "")) ? $str_nis : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_person) && ($str_name_person != null || $str_name_person != "")) ? $str_name_person : '';
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