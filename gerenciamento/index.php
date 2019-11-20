<?php
  include('inc/functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

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
    <form id="login-form" class="form" action="exportar.php" method="post">
    <div class="form-group">
     <label >De</label>
     <input type="date" name="datainicio" max="3000-12-31"
            min="1000-01-01" class="form-control">
    </div>
    <div class="form-group">
     <label >Até</label>
     <input type="date" name="datafim" min="1000-01-01"
            max="3000-12-31" class="form-control">
    </div>

    <button type="submit">TESTE</BUTTON>
    </div>

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
