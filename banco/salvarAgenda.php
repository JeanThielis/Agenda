<?php
include_once("conexao.php");

 $nome = $_POST['nome'];
 $data = $_POST['data'];
 $hora = $_POST['hora'];
 $horaChegada = $_POST['hora-chegada'];
 $servico = $_POST['servico'];
 $valor = floatval($_POST['valor']);
 $pagamento = $_POST['pagamento'];
 $restante = floatval($_POST['restante']);
 $bairro = $_POST['bairro'];
 $cidade = $_POST['cidade'];
 $cel = $_POST['cel'];
 $cores = $_POST['cores'];
$situacao=1;

$sql ="INSERT INTO Agenda(data_Cliente, nome_Cliente, servico, valor, bairro, cidade, situacao, cores, hora,horaChegada,pagamento, celular, restante) VALUES ('$data','$nome','$servico','$valor','$bairro','$cidade','$situacao','$cores','$hora','$horaChegada','$pagamento','$cel','$restante')";

mysqli_query($conn,$sql);

mysqli_close($conn);

?>