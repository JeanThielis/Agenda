<?php
include_once("conexao.php");

$nome = $_POST['nome'];

$result = mysqli_query($conn,"SELECT id_Agenda FROM Agenda WHERE nome_Cliente = '$nome'");
$row = $result->fetch_row();
if ($row[0] > 0) {
    ?>
  <div id='alertClienteCadastrado' class='alert alert-warning'>Cliente já cadastrado <a id='<?php echo $row[0]?>' class="alertClienteCadastrado alert-link">Clique aqui</a> para Atualizar</div>;

  <?php

}


mysqli_close($conn);

?>