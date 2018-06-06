<?php
/**
 * Created by PhpStorm.
 * User: tassio
 * Date: 09/01/2018
 * Time: 09:49
 */
require_once "../grafico/PHPlot/phplot/phplot.php";
require_once "../db/conection.php";
require_once "../grafico/mem_image.php";

#Instancia o objeto e setando o tamanho do grafico na tela
$grafico = new \PHPlot(900,300);
#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle(utf8_decode("Beneficiários por Mes e Ano"));
//$grafico->SetTitle("Beneficiários por Mês e Ano");
$grafico->SetXTitle(utf8_decode("Mês e Ano"));

$grafico->SetYTitle(utf8_decode("Número Beneficiários"));

$query = "SELECT count(tb_beneficiaries_id_beneficiaries )as qtde, int_month as mes, int_year as ano FROM tb_payments group by int_month, int_year order by int_year asc, int_month asc;";
$statement = $pdo->prepare($query);

$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($rs as $value) {
    $resultado[] = $value;
}
$data = array();
if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [ $r['ano'].'/'.$r['mes'], $r['qtde']];
    }
} else {
    $data[]=[null,null];
}

//$grafico->SetDefaultTTFont('assets/fonts/Timeless.ttf');
$grafico->SetDataValues($data);
#Neste caso, usariamos o gráfico em barras
$grafico->SetPlotType("bars");
#Exibimos o gráfico
//Disable image output
$grafico->SetPrintImage(false);
//Draw the graph
$grafico->DrawGraph();

$pdf = new PDF_MemImage();
$pdf->AddPage();
$pdf->GDImage($grafico->img,30,20,140);
$pdf->Output();

