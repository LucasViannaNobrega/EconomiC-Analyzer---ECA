<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 23/05/2018
 * Time: 16:55
 */
//ini_set('display_errors', 0);

require_once "../relatorio/mpdf/mpdf.php";
require_once "../db/conection.php";
require_once "../db/tb_beneficiariesDAO.php";

ini_set('display_errors', 0);

$beneficiariesDAO = new tb_beneficiariesDAO();
$listObjs = $beneficiariesDAO->findAll();
$html = "<table border='1' cellspacing='3' cellpadding='4' >";
$html .= "<tr>
            <th>ID</th>
            <th>NIS</th>
            <th>NOME</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_beneficiaries</td>
                <td>$var->str_nis</td>
                <td>$var->str_name_person</td>
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
