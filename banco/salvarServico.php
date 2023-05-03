<?php
include_once("conexao.php");

$produto = $_POST['produto'];
$custo = floatval($_POST['custo']);
$valor = floatval($_POST['valor']);

$sql = "INSERT INTO Servico (produto,custo,valor_Produto)values('$produto','$custo','$valor')";

mysqli_query($conn,$sql);

mysqli_close($conn);



?>