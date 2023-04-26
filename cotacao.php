<?php 

    $inicio =date("m-d-Y",strtotime("-7 days"));
    $fim = date("m-d-Y");

    $url ='https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

    $dados = json_decode(file_get_contents($url),False);
  
    $cotacao = $dados -> value[0] -> cotacaoCompra;
    
    $valor = $_REQUEST['valor'];
    $valor = str_replace([','],'.', $valor);

    $resultado = $valor / $cotacao ;
    echo "<h1>Valor do dolar direto do branco central</h1>";
    echo "<br>";

    echo "Valor digitado <strong>R$ ".number_format($valor,2,',','.')."</strong>";
    echo "<br>";
    echo "Quantidade de dolares que podem ser comprados <strong> USD ".number_format($resultado,2,',','.')."</strong>";

?>