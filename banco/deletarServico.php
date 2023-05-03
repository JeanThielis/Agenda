<?php
include_once("conexao.php");


$id=intval($_POST["id"]);

$sql ="delete from Servico where id_Servico='$id'";

mysqli_query($conn,$sql);

mysqli_close($conn);

?>