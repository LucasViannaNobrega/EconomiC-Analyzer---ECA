<?php
/**
 * Created by PhpStorm.
 * User: lucas.vianna
 * Date: 01/06/2018
 * Time: 15:43
 */
//So funciona se desativar os erros!
ini_set('display_errors', 0);
require_once "../relatorio/mpdf/mpdf.php";
require_once "../db/relatorioDAO.php";

$dao = new relatorioDAO();

$listObjs = $dao->relatorio03();
$data = $dao ->dataAtual();
$hr = $dao ->horaAtual();

$html = "<p>Data/Hora Base: $data - $hr</p>";
$html .= "<table border='1' cellspacing='3' cellpadding='3' >";
$html .= "<tr>
            <th>ID PAGAMENTO</th>
            <th>CIDADE</th>
            <th>FUNÇÃO</th>
            <th>SUB-FUNCAO</th>
            <th>PROGRAMA</th>
            <th>AÇÃO</th>
            <th>BENEFICIARIES</th>
            <th>NIS</th>
            <th>ARQUIVO</th>
        </tr>";
foreach ($listObjs as $var):
    $html.= "<tr>
                <td>$var->id_payment</td>
                <td>$var->str_name_city</td>
                <td>$var->str_name_function</td>
                <td>$var->str_name_subfunction</td>
                <td>$var->str_name_program</td>
                <td>$var->str_name_action</td>
                <td>$var->str_name_person</td>
                <td>$var->str_goal</td>
                <td>$var->str_name_file</td>
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