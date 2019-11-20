<?php include('gerenciamento/inc/functions.php') ;


$validausuario = getenv("username");

?>

<!doctype html>
<html lang="pt-br">

  <?php include_once ('inc-html/head.php'); ?>

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

  <div class="col-md-12 home-center">
  <center><img src="img/logo_preto.png" alt=""/>
  </div>


  <div class="col-md-12 home-left">
  <div class="container">
<!-- Loading -->
<br>

<form method="POST" action="minhas-respostas.php">
<input type="text" class="form-control" id="usuariopesquisa" name="usuariopesquisa" aria-describedby="emailHelp" placeholder="Digite sua mátricula...">
<br>
<input class="btn btn-dark btn-lg btn-block" name="SendPesqUser" type="submit" value="Pesquisar">

</form>

  <?php include ('gerenciamento/inc/script.php') ?>

  </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
