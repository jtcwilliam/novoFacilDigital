<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <script>
    var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
  </script>

</body>

</html>


<?php


include_once './classes/Solicitacao.php';

$objSolicitacao = new Solicitacao();

$dados =  $objSolicitacao->pesquisarAssinatura(105);

echo '<pre>';
print_r($dados);
echo '</pre>';



$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

if ($rootDir == "/var/www/html/php83") {
  echo 'servidor funcionando blz';
}


/*
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');



//'2025-05-05 14:00:00'

$dataVerificadora =  date('Y-m-d');
echo md5($dataVerificadora);


$variavel = "   ";

if ($variavel == "   ") {
  # code...

  //  echo ' correto ';

}

*/
