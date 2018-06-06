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
$grafico = new \PHPlot(800,400);
#Indicamos o títul do gráfico e o título dos dados no eixo X e Y do mesmo
$grafico->SetTitle("Valor por Estado");
$grafico->SetXTitle("Estado");
$grafico->SetYTitle("Valor");

$query = "SELECT s.str_uf state, sum(p.db_value) valor FROM tb_payments p inner join tb_city c inner join tb_state s where p.tb_city_id_city = c.id_city and c.tb_state_id_state = s.id_state group by s.id_state ;";
$statement = $pdo->prepare($query);
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rs as $value) {
    $resultado[] = $value;
}

$data = array();

if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [$r['state'], $r['valor']];
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