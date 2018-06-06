<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 06/06/2018
 * Time: 14:38
 */

require_once "../grafico/PHPlot/phplot/phplot.php";
require_once "../db/conection.php";
require_once "../grafico/mem_image.php";



$query = "SELECT s.str_name estado, sum(p.tb_beneficiaries_id_beneficiaries) qtde, p.int_month mes
FROM tb_payments p 
inner join tb_city c 
inner join tb_state s 
where p.tb_city_id_city = c.id_city and c.tb_state_id_state = s.id_state
group by s.id_state, p.int_month;";

$statement = $pdo->prepare($query);
$statement->execute();
$rs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rs as $value) {
    $resultado[] = $value;
}

if(isset($resultado)) {
    foreach ($resultado as $r){
        $data[] = [utf8_decode($r['estado']) . ' mes: ' . $r['mes'], $r['qtde']];
    }
} else {
    $data[]=[null,null];
}

$grafico = new \PHPlot(800,400);
//$grafico = new PHPlot(800, 400);
$grafico->SetImageBorderType('plain');
$grafico->SetPlotType('bars');
$grafico->SetDataType('text-data');
$grafico->SetDataValues($data);
$grafico->SetTitle(utf8_decode("Beneficiaries by state"));

# Turn off X tick labels and ticks because they don't apply here:
$grafico->SetXTickLabelPos('none');
$grafico->SetXTickPos('none');
$grafico->SetXLabelAngle(90);
# Make sure Y=0 is displayed:
$grafico->SetPlotAreaWorld(NULL, 0);
# Y Tick marks are off, but Y Tick Increment also controls the Y grid lines:
$grafico->SetYTickIncrement(100);

# Turn on Y data labels:
$grafico->SetYDataLabelPos('plotin');

# With Y data labels, we don't need Y ticks or their labels, so turn them off.
$grafico->SetYTickLabelPos('none');
$grafico->SetYTickPos('none');

# Format the Y Data Labels as numbers with 1 decimal place.
# Note that this automatically calls SetYLabelType('data').
$grafico->SetPrecisionY(1);

//Disable image output
$grafico->SetPrintImage(true);
//Draw the graph
$grafico->DrawGraph();

$pdf = new PDF_MemImage();
$pdf->AddPage();
$pdf->GDImage($grafico->img,30,20,140);
$pdf->Output();
return $grafico->EncodeImage('base64');

