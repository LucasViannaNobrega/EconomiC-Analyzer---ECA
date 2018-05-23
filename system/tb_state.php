<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 16/05/2018
 * Time: 10:38
 */
//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_stateDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_stateDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_state = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_uf = (isset($_POST["uf"]) && $_POST["uf"] != null) ? $_POST["uf"] : "";
    $str_name = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $tb_region_id_region = (isset($_POST["region"]) && $_POST["region"] != null) ? $_POST["region"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_state = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_uf = NULL;
    $str_name = NULL;
    $tb_region_id_region = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_state != "") {
    $tb_state = new tb_state($id_state, '','','');
    $resultado = $object->atualizar($tb_state);
    $str_uf = $resultado->getStrUf();
    $str_name = $resultado->getStrName();
    $tb_region_id_region = $resultado->getTbRegionIdRegion();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_name != "") {
    $tb_state = new tb_state($id_state, $str_uf,$str_name,$tb_region_id_region);
    $msg =$object->salvar($tb_state);
    $id_state = null;
    $str_uf = null;
    $str_name = null;
    $tb_region_id_region = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_state != "") {
    $tb_state = new tb_state($id_state, '', '','');
    $msg = $object->remover($tb_state);
    $id_state = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Estados</h4>
                            <p class='category'>Lista de estados do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_state) && ($id_state != null || $id_state != "")) ? $id_state : '';
                                ?>" />
                                Uf:
                                <input type="text" size="10" name="uf" value="<?php
                                // Preenche o uf no campo uf com um valor "value"
                                echo (isset($str_uf) && ($str_uf != null || $str_uf != "")) ? $str_uf : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name) && ($str_name != null || $str_name != "")) ? $str_name : '';
                                ?>" />
                                Região:
                                <select name="region"><?php
                                    $query = "SELECT * FROM tb_region order by str_name_region;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_region == $tb_region_id_region) {
                                                echo "<option value='$rs->id_region' selected>$rs->str_name_region</option>";
                                            } else {
                                                echo "<option value='$rs->id_region'>$rs->str_name_region</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
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