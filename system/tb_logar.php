<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 10/01/2018
 * Time: 11:11
 */

require_once "db/conection.php";

session_start();
$login = $_POST['usuario'];
$passwd = $_POST['senha'];

try {
    $statement = $pdo->prepare("SELECT id_user, str_login, str_senha,str_name, int_adm FROM tb_user WHERE  str_login = :login and str_senha = :senha");
    $statement->bindValue(":login", $login);
    $statement->bindValue(":senha", sha1($passwd));
    if ($statement->execute()) {
        $rs = $statement->fetch(PDO::FETCH_OBJ);
        $usuario = $rs->Usuario;
        $nome = $rs->Nome;
        $senha = $rs->Senha;
        $perfil = $rs->perfil;
        if( $usuario!=null and $senha != null)
        {
            $_SESSION['login'] = $nome;
            $_SESSION['senha'] = $senha;
            header('location:index.php');
        }
        else{
            unset ($_SESSION['login']);
            unset ($_SESSION['senha']);
            header('location:dashboard.php');

        }
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}

?>