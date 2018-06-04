<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 21/05/2018
 * Time: 14:13
 */
//carrega o cabeçalho e menus do site
include_once 'estrutura/template.php';
//Class
require_once 'db/tb_paymentsDAO.php';
$template = new Template();
$template->header();
$template->sidebar();
$template->mainpanel();
$object = new tb_paymentsDAO();

// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_payment = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $tb_city_id_city = (isset($_POST["city"]) && $_POST["city"] != null) ? $_POST["city"] : "";
    $tb_functon_id_function = (isset($_POST["function"]) && $_POST["function"] != null) ? $_POST["function"] : "";
    $tb_subfunction_id_subfunction = (isset($_POST["subfunction"]) && $_POST["subfunction"] != null) ? $_POST["subfunction"] : "";
    $tb_program_id_program = (isset($_POST["program"]) && $_POST["program"] != null) ? $_POST["program"] : "";
    $tb_action_id_action = (isset($_POST["action"]) && $_POST["action"] != null) ? $_POST["action"] : "";
    $tb_beneficiaries_id_beneficiaries = (isset($_POST["beneficiaries"]) && $_POST["beneficiaries"] != null) ? $_POST["beneficiaries"] : "";
    $tb_source_id_source = (isset($_POST["source"]) && $_POST["source"] != null) ? $_POST["source"] : "";
    $tb_files_id_file = (isset($_POST["file"]) && $_POST["file"] != null) ? $_POST["file"] : "";
    $int_month = (isset($_POST["month"]) && $_POST["month"] != null) ? $_POST["month"] : "";
    $int_year= (isset($_POST["year"]) && $_POST["year"] != null) ? $_POST["year"] : "";
    $db_value = (isset($_POST["value"]) && $_POST["value"] != null) ? $_POST["value"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id_payment = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $tb_city_id_city = NULL;
    $tb_functon_id_function = NULL;
    $tb_subfunction_id_subfunction = NULL;
    $tb_program_id_program = NULL;
    $tb_action_id_action = NULL;
    $tb_beneficiaries_id_beneficiaries = NULL;
    $tb_source_id_source = NULL;
    $tb_files_id_file = NULL;
    $int_month = NULL;
    $int_year = NULL;
    $db_value = NULL;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id_payment != "") {
    $tb_payments = new tb_payments($id_payment, '','','','','','','','','');
    $resultado = $object->atualizar($tb_payments);
    $tb_city_id_city = $resultado->getTbCityIdCity();
    $tb_functon_id_function = $resultado->getTbFunctonIdFunction();
    $tb_subfunction_id_subfunction = $resultado->getTbSubfunctionIdSubfunction();
    $tb_program_id_program = $resultado->getTbProgramIdProgram();
    $tb_action_id_action = $resultado->getTbActionIdAction();
    $tb_beneficiaries_id_beneficiaries = $resultado->getTbBeneficiariesIdBeneficiaries();
    $tb_source_id_source = $resultado->getTbSourceIdSource();
    $tb_files_id_file =$resultado->getTbFilesIdFile();
    $int_month =$resultado->getIntMonth();
    $int_year =$resultado->getIntYear();
    $db_value = $resultado->getDbValue();

}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $tb_functon_id_function != "") {
    $tb_payments = new tb_payments($id_payment, $tb_payments_id_city,$tb_functon_id_function,$tb_subfunction_id_subfunction,$tb_program_id_program,$tb_action_id_action,$tb_beneficiaries_id_beneficiaries,$tb_source_id_source,$tb_files_id_file,$db_value);
    $msg =$object->salvar($tb_payments);
    $id_payment = null;
    $tb_city_id_city = null;
    $tb_functon_id_function = null;
    $tb_subfunction_id_subfunction = null;
    $tb_program_id_program = null;
    $tb_action_id_action = null;
    $tb_beneficiaries_id_beneficiaries = null;
    $tb_source_id_source = null;
    $tb_files_id_file = null;
    $int_month = null;
    $int_year = null;
    $db_value = null;
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id_payment != "") {
    $tb_payments = new tb_payments($id_payment, '','','','','','','','','','','');
    $msg = $object->remover($tb_payments);
    $id_payment = null;
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

                            <form action="?act=save" method="POST" name="form1" >
                                <hr>
                                <i class="ti-save"></i>
                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id_payment) && ($id_payment != null || $id_payment != "")) ? $id_payment : '';
                                ?>" />
                                Cidade:
                                <select name="city"><?php
                                    $query = "SELECT * FROM tb_city order by str_name_city;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_city == $tb_city_id_city) {
                                                echo "<option value='$rs->id_city' selected>$rs->str_name_city</option>";
                                            } else {
                                                echo "<option value='$rs->id_city'>$rs->str_name_city</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Função:
                                <select name="function"><?php
                                    $query = "SELECT * FROM tb_functions order by str_name_function;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_function == $tb_functon_id_function) {
                                                echo "<option value='$rs->id_function' selected>$rs->str_name_function</option>";
                                            } else {
                                                echo "<option value='$rs->id_function'>$rs->str_name_function</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                SubFunção:
                                <select name="subfunction"><?php
                                    $query = "SELECT * FROM tb_subfunctions order by str_name_subfunction;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_subfunction == $tb_subfunction_id_subfunction) {
                                                echo "<option value='$rs->id_subfunction' selected>$rs->str_name_subfunction</option>";
                                            } else {
                                                echo "<option value='$rs->id_subfunction'>$rs->str_name_subfunction</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Programa:
                                <select name="program"><?php
                                    $query = "SELECT * FROM tb_program order by str_name_program;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_program == $tb_program_id_program) {
                                                echo "<option value='$rs->id_program' selected>$rs->str_name_program</option>";
                                            } else {
                                                echo "<option value='$rs->id_program'>$rs->str_name_program</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Ação:
                                <select name="action"><?php
                                    $query = "SELECT * FROM tb_action order by str_name_action;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_action == $tb_action_id_action) {
                                                echo "<option value='$rs->id_action' selected>$rs->str_name_action</option>";
                                            } else {
                                                echo "<option value='$rs->id_action'>$rs->str_name_action</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Beneficiario:
                                <select name="beneficiaries"><?php
                                    $query = "SELECT * FROM tb_beneficiaries order by str_name_person;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_beneficiaries == $tb_beneficiaries_id_beneficiaries) {
                                                echo "<option value='$rs->id_beneficiaries' selected>$rs->str_name_person</option>";
                                            } else {
                                                echo "<option value='$rs->id_beneficiaries'>$rs->str_name_person</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Fonte:
                                <select name="source"><?php
                                    $query = "SELECT * FROM tb_source order by str_goal;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_source == $tb_source_id_source) {
                                                echo "<option value='$rs->id_source' selected>$rs->str_goal</option>";
                                            } else {
                                                echo "<option value='$rs->id_source'>$rs->str_goal</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Arquivos:
                                <select name="state"><?php
                                    $query = "SELECT * FROM tb_files order by str_name_file;";
                                    $statement = $pdo->prepare($query);
                                    if ($statement->execute()) {
                                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($result as $rs) {
                                            if ($rs->id_file == $tb_files_id_file) {
                                                echo "<option value='$rs->id_file' selected>$rs->str_name_file</option>";
                                            } else {
                                                echo "<option value='$rs->id_file'>$rs->str_name_file</option>";
                                            }
                                        }
                                    } else {
                                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                                    }
                                    ?>
                                </select>
                                Mês:
                                <input type="text" size="5" name="value" value="<?php
                                // Preenche o code no campo code com um valor "value"
                                echo (isset($int_month) && ($int_month != null || $int_month != "")) ? $int_month : '';
                                ?>" />
                                Ano:
                                <input type="text" size="10" name="value" value="<?php
                                // Preenche o code no campo code com um valor "value"
                                echo (isset($int_year) && ($int_year != null || $int_year != "")) ? $int_year : '';
                                ?>" />
                                Valor:
                                <input type="text" size="10" name="value" value="<?php
                                // Preenche o code no campo code com um valor "value"
                                echo (isset($db_value) && ($db_value != null || $db_value != "")) ? $db_value : '';
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