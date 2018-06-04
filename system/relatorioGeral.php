<?php

require_once "estrutura/template.php";

$template = new Template();

$template->header();
$template->sidebar();
$template->mainpanel();
?>

<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Relatório</h4>
                        <p class='category'>Lista de relatórios do sistema</p>
                    </div>

                    <div class='content table-responsive'>
                        <form method="POST" name="form">                          
                            Tipo de relatorio:
                            <select class="form-control" name="relatorios">
                                <option value="relatorioNulo">Selecione um relatorio</option>
                                <option value="relatorio01">Relatório de beneficiários</option>
                                <option value="relatorio02">Relatório de beneficiários por cidade</option>
                                <option value="relatorio03">Relatório de pagamentos</option>
                                <option value="relatorio04">Relatório de quantidade de beneficiários e valor total pago por cidade</option>
                                <option value="relatorio05">Relatório de quantidade/valor de pagamentos por beneficiarios/mês</option>
                                <option value="relatorio06">Relatório de pagamentos por região</option>
                                <option value="relatorio07">Relatório de pagamentos por estado</option>
                            </select>
                            <br/>
                            <input class="btn btn-success" type="submit" value="GERAR RELATORIO">
                            <hr>
                        </form>
                        
                        <?php
                        if (isset($_POST['relatorios'])){
                            $relatorioselecionado = $_POST['relatorios'];
                            if ($relatorioselecionado=="relatorioNulo"){ 
                                echo "Nenhum relatório selecionado!";
                            }else { 
                                echo "<script>script:window.open('relatorio/".$relatorioselecionado.".php', '_blank');</script>";
                            }                        
                        }
                        ?>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
