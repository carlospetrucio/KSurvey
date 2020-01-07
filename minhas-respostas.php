<?php include('gerenciamento/inc/functions.php');
$usuariopesquisa = e($_POST['usuariopesquisa']);
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
<br>

<!-- Realiza a consulta no banco de dados e retorna os dados da pesquisa atrelados a relação com as respostas -->
<?php 
$consulta = "SELECT * FROM pesquisa  INNER JOIN resposta ON pesquisa.P1 = resposta.idresposta WHERE usuariopesquisa = '$usuariopesquisa'";
$con    = $db->query($consulta) or die($db->error);
?>
<!-- Realiza a consulta no banco de dados e retorna os dados da pesquisa atrelados a relação com as respostas -->

<!-- contador de pesquisas -->
<?php 
$total = 0;
$n = 1;
$sql = "SELECT count(*) as t FROM pesquisa WHERE usuariopesquisa = '$usuariopesquisa'";
$sql = $db->query($sql);
$sql = $sql->fetch_assoc();
$total = $sql['t'];
if ($total > 1)
{echo "<h4 class='text-center'>Você tem ".$total." pesquisas respondidas.</h4>";}
else
{echo "<h4 class='text-center'>Você não tem pesquisas respondidas.</h4>";}
?>
<!-- contador de pesquisas -->

<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Chamado</th>
      <th scope="col">Titulo</th>
      <th scope="col">Problema resolvido</th>
    </tr>
  </thead>
  <?php while($dado = $con->fetch_array()) { ?>
  <tbody>
    <tr>
      <th scope="row"><?php echo $dado['idpesquisa']; ?></th>
      <td><?php echo $dado['chamado']; ?></td>
      <td><?php echo $dado['titulo']; ?></td>
      <td><?php echo $dado['textoresposta']; ?></td>
    </tr>

  </tbody>

   <?php } ?>
</table>



  <?php include ('gerenciamento/inc/script.php') ?>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>