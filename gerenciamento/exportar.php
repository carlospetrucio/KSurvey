<?php
  include('inc/functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>KSurvey</title>



  </head>
  <style>
  .home-center img{
    margin-top: 15%;
    margin-bottom: 5%;

    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
</style>
  <body class="bg-warning text-dark">
  <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="flex-row d-flex">
        <button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#" title="Free Bootstrap 4 Admin Template">KSurvey</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="collapsingNavbar">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">Home</span></a>
            </li>


        </ul>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="index.php?logout='1'" >Sair</a>
            </li>
        </ul>
    </div>
</nav>

  <div class="col-md-12 home-center">
  <center><img src="../img/logo_preto.png" alt=""/>
  </div>

  <div class="container">

    </div>
<!-- -->
<?php
   //Incluir a classe excelwriter
   $datainicio = e($_POST['datainicio']);
   $datafim =  e($_POST['datafim']);

   include("inc/excelwriter.php");

   //Você pode colocar aqui o nome do arquivo que você deseja salvar.
    $excel=new ExcelWriter("excel3.xls");

    if($excel==false){
        echo $excel->error;
   }

   //Escreve o nome dos campos de uma tabela
   $myArr=array('IDPesquisa','Colaborador','Título do chamado','N° do Chamado','O problema foi resolvido','P2','P3','P4','P5','P6','Observacoes','datapesquisa');
   $excel->writeLine($myArr);

   //Seleciona os campos de uma tabela
  $conn = mysql_connect("localhost", "root", "usbw") or die ('Não foi possivel conectar ao banco de dados! Erro: ' . mysql_error());
  if($conn)
  {
  mysql_select_db("ksurvey", $conn);
  }
   $consulta = "SELECT * FROM pesquisa INNER JOIN resposta ON pesquisa.P1 = resposta.idresposta Where datapesquisa BETWEEN '$datainicio' AND '$datafim'";
   $resultado = mysql_query($consulta);
   if($resultado==true){
      while($linha = mysql_fetch_array($resultado)){
         $myArr=array($linha['idpesquisa'],$linha['usuariopesquisa'],$linha['titulo'],$linha['chamado'],$linha['textoresposta'],$linha['P2'],$linha['P3'],$linha['P4'],$linha['P5'],$linha['P6'],$linha['observacoes'],$linha['datapesquisa']);
         $excel->writeLine($myArr);
      }
   }


    $excel->close();
    echo  "<center><h1>".date('l jS \of F Y h:i:s A')."</center>";
    echo "<br/><center><a class='btn btn-dark' href='excel3.xls' role='button'>Exportar Pesquisa</a></center>";
?>
<!-- -->



  <?php include ('inc/script.php') ?>

  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
    $('.datepicker').datepicker();
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
