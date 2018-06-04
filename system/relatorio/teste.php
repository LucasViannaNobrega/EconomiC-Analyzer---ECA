<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 01/06/2018
 * Time: 14:48
 */
require_once "../relatorio/mpdf/mpdf.php";
require_once "../db/conection.php";
require_once "../db/tb_paymentsDAO.php";

ini_set('display_errors', 0);

$paymentsDAO = new tb_paymentsDAO();
$listObjs = $paymentsDAO->findByMesAno();
$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>NOME</th>
            <th>QTD PAGAMENTOS</th>
            <th>VALOR TOTAL</th>
            <th>MÊS</th>
            <th>ANO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->tb_beneficiaries</td>
                <td>$var->QTD</td>
                <td>$var->SOMA</td>
                <td>$var->int_month</td>
                <td>$var->int_year</td>
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