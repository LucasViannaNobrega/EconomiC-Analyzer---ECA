<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 01/06/2018
 * Time: 16:55
 */
//So funciona se desativar os erros!
ini_set('display_errors', 0);
require_once "../relatorio/mpdf/mpdf.php";
require_once "../db/relatorioDAO.php";
$dao = new relatorioDAO();

$listObjs = $dao->relatorio07();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='3' cellpadding='3' >";
$html .= "<tr>
            <th>VALOR TOTAL PAGO</th>
            <th>NOME DO ESTADO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->valor</td>
                <td>$var->str_name</td>
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