<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 06/06/2018
 * Time: 15:50
 */

//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_userDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_userDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $str_login = (isset($_POST["login"]) && $_POST["login"] != null) ? $_POST["login"] : "";
    $str_senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
    $str_name = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $str_email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $int_reset = (isset($_POST["reset"]) && $_POST["reset"] != null) ? $_POST["reset"] : "";
    $int_adm = (isset($_POST["admin"]) && $_POST["admin"] != null) ? $_POST["admin"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_user = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $str_login = NULL;
    $str_senha = NULL;
    $str_name = NULL;
    $str_email = NULL;
    $int_reset = NULL;
    $int_adm = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_user != "") {
    $tb_user = new tb_user($id_user, '','','','','','');
    $resultado = $object->atualizar($tb_user);
    $str_login = $resultado->getStrLogin();
    $str_senha = $resultado->getStrSenha();
    $str_name = $resultado->getStrName();
    $str_email = $resultado->getStrEmail();
    $int_reset = $resultado->getIntReset();
    $int_adm = $resultado->getIntAdm();
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $str_senha != "") {
    $tb_user = new tb_user($id_user, $str_login,$str_senha,$str_name,$str_email,$int_reset,$int_adm);
    $msg =$object->salvar($tb_user);
    $id_user = null;
    $str_login = null;
    $str_senha = null;
    $str_name = null;
    $str_email = null;
    $int_reset = null;
    $int_adm = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_user != "") {
    $tb_user = new tb_user($id_user, '','','','','','');
    $msg = $object->remover($tb_user);
    $id_user = null;
}
?>
    <div class='content' xmlns="http://www.w3.org/1999/html">
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h4 class='title'>Pagamentos</h4>
                            <p class='category'>Lista de pagamentos do sistema</p>

                        </div>
                        <div class='content table-responsive'>

                            <form reset="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_user) && ($id_user != null || $id_user != "")) ? $id_user : '';
                                ?>" />
                                Login:
                                <input type="text" size="10" name="login" value="<?php
                                // Preenche o code no campo code com um valor "login"
                                echo (isset($str_login) && ($str_login != null || $str_login != "")) ? $str_login : '';
                                ?>" />
                               Senha:
                                <input type="text" size="10" name="senha" value="<?php
                                // Preenche o code no campo code com um valor "senha"
                                echo (isset($str_senha) && ($str_senha != null || $str_senha != "")) ? $str_senha : '';
                                ?>" />
                                Nome:
                                <input type="text" size="40" name="nome" value="<?php
                                // Preenche o code no campo code com um valor "nome"
                                echo (isset($str_name) && ($str_name != null || $str_name != "")) ? $str_name : '';
                                ?>" />
                                Email:
                                <input type="email" size="30" name="email" value="<?php
                                // Preenche o code no campo code com um valor "email"
                                echo (isset($str_email) && ($str_email != null || $str_email != "")) ? $str_email : '';
                                ?>" />
                                <input type="hidden" size="5" name="reset" value="<?php
                                // Preenche o code no campo code com um valor "reset"
                                echo (isset($int_reset) && ($int_reset != null || $int_reset != "")) ? $int_reset : '';
                                ?>" />
                                <input type="hidden" size="5" name="admin" value="<?php
                                // Preenche o code no campo code com um valor "admin"
                                echo (isset($int_adm) && ($int_adm != null || $int_adm != "")) ? $int_adm : '';
                                ?>" />
                                <?php
                                echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';
                                //chamada a paginação
                                $object->tabelapaginada();
                                ?>
                                <input type="submit" VALUE="Cadastrar"/>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$template->footer();
?>