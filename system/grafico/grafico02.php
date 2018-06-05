<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 09:49
 */
require_once "../grafico/PHPlot/phplot/phplot.php";
require_once "../db/conection.php";


$query = "SELECT s.str_name estado, sum(p.tb_beneficiaries_id_beneficiaries) qtde, p.int_month mes FROM tb_payments p  inner join tb_city c  inner join tb_state s where p.tb_city_id_city = c.id_city and c.tb_state_id_state = s.id_state group by s.id_state, p.int_month;";

$statement = $pdo->prepare($query);
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rs as $value) {
    $resultado[] = $value;
}

if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = null;
    }
} else {
    $data[]=[null,null];
}


