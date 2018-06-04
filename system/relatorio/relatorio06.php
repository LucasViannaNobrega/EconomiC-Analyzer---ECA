<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 01/06/2018
 * Time: 16:43
 */
//So funciona se desativar os erros!
ini_set('display_errors', 0);
require_once "../relatorio/mpdf/mpdf.php";
require_once "../db/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio06();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='0' cellpadding='2' bordercolor='666633'>";
$html .= "<tr>
            <th colspan='3' align='center'>TOTAL DE PAGAMENTOS POR REGIÃO</th>
        </tr>";
$html .= "<tr>
            <th>TOTAL PAGO</th>
            <th>REGIÃO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->valor</td>
                <td>$var->str_name_region</td>
            </tr>";
endforeach;
$html .= "</table>";

$mpdf = new mPDF();
$mpdf->SetCreator(PDF_CREATOR);
$mpdf->SetAuthor('Lucas Vianna');
$mpdf->SetTitle('TCPDF Beneficiários');
$mpdf->SetSubject('TCPDF Beneficiários');
$mpdf->SetKeywords('TCPDF, PDF, beneficiarios');
$mpdf->SetDisplayMode('fullpage');
$mpdf->nbpgPrefix = ' de ';
$mpdf->setFooter('Página {PAGENO}{nbpg}');
$mpdf->WriteHTML($html);
$mpdf->Output('Exemplo.pdf', 'I');

exit;