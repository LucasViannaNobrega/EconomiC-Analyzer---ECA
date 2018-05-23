<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 16/05/2018
 * Time: 09:37
 */
//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_cityDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_cityDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_city = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_name_city = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $str_cod_siafi_city = (isset($_POST["code"]) && $_POST["code"] != null) ? $_POST["code"] : "";
    $tb_state_id_state = (isset($_POST["state"]) && $_POST["state"] != null) ? $_POST["state"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_city = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_name_city = NULL;
    $str_cod_siafi_city = NULL;
    $tb_state_id_state = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_city != "") {
    $tb_city = new tb_city($id_city, '','','');
    $resultado = $object->atualizar($tb_city);
    $str_name_city = $resultado->getStrNameCity();
    $str_cod_siafi_city = $resultado->getStrCodSiafiCity();
    $tb_state_id_state = $resultado->getTbStateIdState();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_cod_siafi_city != "") {
    $tb_city = new tb_city($id_city, $str_name_city,$str_cod_siafi_city,$tb_state_id_state);
    $msg =$object->salvar($tb_city);
    $id_city = null;
    $str_name_city = null;
    $str_cod_siafi_city = null;
    $tb_state_id_state = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_city != "") {
    $tb_city = new tb_city($id_city, '', '','');
    $msg = $object->remover($tb_city);
    $id_city = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Cidades</h4>
                            <p class='category'>Lista de cidades do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_city) && ($id_city != null || $id_city != "")) ? $id_city : '';
                                ?>" />
                                Nome:
                                <input type="text" size="30" name="nome" value="<?php
                                // Preenche o nome no campo nome com um valor "value"
                                echo (isset($str_name_city) && ($str_name_city != null || $str_name_city != "")) ? $str_name_city : '';
                                ?>" />
                                Código:
                                <input type="text" size="10" name="code" value="<?php
                                // Preenche o code no campo code com um valor "value"
                                echo (isset($str_cod_siafi_city) && ($str_cod_siafi_city != null || $str_cod_siafi_city != "")) ? $str_cod_siafi_city : '';
                                ?>" />
                                Estado:
                                <select name="state"><?php
                                    $query = "SELECT * FROM tb_state order by str_name;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_state == $tb_state_id_state) {
                                                echo "<option value='$rs->id_state' selected>$rs->str_name</option>";
                                            } else {
                                                echo "<option value='$rs->id_state'>$rs->str_name</option>";
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