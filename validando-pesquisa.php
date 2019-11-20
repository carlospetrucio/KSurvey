<?php include('gerenciamento/inc/functions.php') ?>

<?php

$chamado = $_GET["id"];
$titulo = $_GET["titulo"];
$usuariopesquisa = getenv("username");
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
    margin-top: 10%;
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
    <?php

    echo date("F"); ?>

<!-- inicia as respostas -->
<?php echo display_error(); ?>
<?php
    $chamado = e($_GET['id']);
    $total = 0;
    $n = 1;
    $sql = "SELECT count(*) as t FROM pesquisa WHERE chamado = '$chamado'";
    $sql = $db->query($sql);
    $sql = $sql->fetch_assoc();
    $total = $sql['t'];


    if($total >= 1){echo "<div class='col-md-12 home-center text-center'>
    <center><img src='img/logo_preto.png' alt=''/></center>
    </div>
    <div class='col-md-12 home-left'>
    <h4 class='text-center'>Pesquisa de Satisfação TI</h4>
    <div class='col-md-12 home-left'>
    <h4 class='text-center'>Já existe uma pesquisa respondida para o chamado {$chamado}.</h4>
    <br>
    <a href='index.php' class='btn btn-dark btn-lg btn-block'>Inicio<a>
    ";}

    else{
      echo "<div class='col-md-12 home-center text-center'>
      <center><img src='img/logo_preto.png' alt=''/></center>
      </div>


      <div class='col-md-12 home-left'>
      <h4 class='text-center'>Pesquisa de Satisfação TI</h4>
      <h6 class='text-center'>Reserve alguns minutos para concluir esta breve pesquisa sobre sua experiência recente usando os serviços de TI. <br>
      Agradecemos o seu feedback e queremos garantir que prestamos serviços  de alta qualidade.</h6>
      <hr>

      <h6 class='text-center'><?php echo $chamado; ?> <br> <?php echo $titulo ?></h6>

      </div>
      <hr>
      <div class='container'>
      <!-- COMO FUNCIONA BUTTON -->
      <div class='col-md-12 home-center'>
      <center><button type='button' class='btn btn-dark' data-toggle='modal' data-target='#exampleModal'>
      Como funciona ?
      </button>
      <!-- COMO FUNCIONA BUTTON -->
      </div>
      <!-- Modal -->
      <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>Como funciona KSurvey ?</h5>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            KSurvey é um sistema de avaliação de atendimento.<br>Nesta página você deverá avaliar o atendimento da equipe.<hr> As notas são definidas de 1 a 4 : <br> Onde 4 significa que você esta muito satisfeito e 1 significa que você esta muito insatisfeito.
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-dark' data-dismiss='modal'>Entendi</button>
          </div>
        </div>
      </div>
      </div>
      <form id='pesquisa-form' class='form' action='validando-pesquisa.php' method='post'>


     <!-- dados do chamado -->
     <input type='hidden' id='titulo' name='titulo' value='{$titulo}'>
     <input type='hidden' id='chamado' name='chamado' value='{$chamado}'>
     <input type='hidden' id='usuariopesquisa' name='usuariopesquisa' value='{$usuariopesquisa}'>

    <!-- PERGUNTA1 -->
      <div class='form-group'>
        <label for='P1'>Seu problema foi resolvido?</label>
        <select class='form-control' id='P1' name='P1'>
                <option value='5'>Sim</option>
                <option value='6'>Não</option>


              </select>
      </div>
    <!-- PERGUNTA1 -->


    <!-- PERGUNTA1 -->
      <div class='form-group'>
        <label for='P2'>Como você avalia a equipe de TI que atendeu o chamado? </label>
        <select class='form-control' id='P2' name='P2'>

          <option value='4'>4 - Muito Satisfeito</option>
          <option value='3'>3 - Satisfeito</option>
          <option value='2'>2 - Insatisfeito</option>
          <option value='1'>1 - Muito Insatisfeito</option>
              </select>
      </div>
    <!-- PERGUNTA1 -->

    <!-- PERGUNTA2 -->
      <div class='form-group'>
        <label for='exampleFormControlSelect1'>Tempo de espera para atendimento da ligação no 3900</label>
        <select class='form-control' id='P3' name='P3'>

          <option value='4'>4 - Muito Satisfeito</option>
          <option value='3'>3 - Satisfeito</option>
          <option value='2'>2 - Insatisfeito</option>
          <option value='1'>1 - Muito Insatisfeito</option>
        </select>
      </div>
    <!-- PERGUNTA2 -->

    <!-- PERGUNTA3 -->
      <div class='form-group'>
        <label for='exampleFormControlSelect1'>Cordialidade dos analistas ?</label>
        <select class='form-control' id='P4' name='P4'>

          <option value='4'>4 - Muito Satisfeito</option>
          <option value='3'>3 - Satisfeito</option>
          <option value='2'>2 - Insatisfeito</option>
          <option value='1'>1 - Muito Insatisfeito</option>
        </select>
      </div>
    <!-- PERGUNTA3 -->

    <!-- PERGUNTA3 -->
      <div class='form-group'>
        <label for='exampleFormControlSelect1'>Conhecimento técnico dos analistas</label>
        <select class='form-control' id='P5' name='P5'>

          <option value='4'>4 - Muito Satisfeito</option>
          <option value='3'>3 - Satisfeito</option>
          <option value='2'>2 - Insatisfeito</option>
          <option value='1'>1 - Muito Insatisfeito</option>
        </select>
      </div>
    <!-- PERGUNTA3 -->

    <!-- PERGUNTA3 -->
      <div class='form-group'>
        <label for='exampleFormControlSelect1'>Senso de urgência dos analistas</label>
        <select class='form-control' id='P6' name='P6'>

          <option value='4'>4 - Muito Satisfeito</option>
          <option value='3'>3 - Satisfeito</option>
          <option value='2'>2 - Insatisfeito</option>
          <option value='1'>1 - Muito Insatisfeito</option>
        </select>
      </div>
    <!-- PERGUNTA3 -->





      <div class='form-group'>
        <label for='observacoes'>Comentários adicionais</label>
        <textarea class='form-control' id='observacoes' name='observacoes' rows='2'></textarea>
      </div>

      <input type='submit' name='pesquisa_btn' class='btn btn-block btn-dark btn-md' value='Enviar'>
    </form>";
  }
?>

<!-- finaliza as respostas -->

  </div>

  <?php include('gerenciamento/inc/script.php'); ?></div>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
