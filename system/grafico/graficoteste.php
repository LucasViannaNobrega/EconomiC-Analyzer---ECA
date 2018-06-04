<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 09/01/2018
 * Time: 09:49
 */
require_once "PHPlot/phplot/phplot.php";
require_once "../db/conection.php";
#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new PHPlot(600,400);
#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Beneficiarios");
$grafico->SetXTitle("Mes");
$grafico->SetYTitle("Beneficiarios");
$statement = $pdo->prepare("SELECT f.str_month,COUNT(p.tb_beneficiaries_id_beneficiaries) FROM tb_payments p INNER JOIN tb_files f WHERE p.tb_files_id_file = f.id_file GROUP BY f.str_month,f.str_year;");
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($rs as $value) {
    $resultado[$i] = $value;
}
$data = array();
if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [$r['f.str_month'],$r['p.tb_beneficiaries_id_beneficiaries']];
    }
} else {
    $data[]=[null,null];
}
$grafico->SetDefaultTTFont('assets/fonts/Timeless.ttf');
$grafico->SetDataValues($data);
#Neste caso, usariamos o gráfico em barras
$grafico->SetPlotType("bars");
#Exibimos o gráfico
$grafico->DrawGraph();





