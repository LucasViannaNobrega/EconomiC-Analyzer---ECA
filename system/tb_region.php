<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 16/05/2018
 * Time: 09:50
 */
//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_regionDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_regionDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_region = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_name_region = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_region = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_name_region = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_region != "") {
    $tb_region = new tb_region($id_region, '');
    $resultado = $object->atualizar($tb_region);
    $str_name_region = $resultado->getStrNameRegion();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name_region != "") {
    $tb_region = new tb_region($id_region, $str_name_region);
    $msg =$object->salvar($tb_region);
    $id_region = null;
    $str_name_region = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_region != "") {
    $tb_region = new tb_region($id_region, '');
    $msg = $object->remover($tb_region);
    $id_region = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Regiões</h4>
                            <p class='category'>Lista de regiões do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_region) && ($id_region != null || $id_region != "")) ? $id_region : '';
                                ?>" />
                                Nome:
                                <input type="text" size="10" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_region) && ($str_name_region != null || $str_name_region != "")) ? $str_name_region : '';
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