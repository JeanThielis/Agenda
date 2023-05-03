<?php
include_once("conexao.php");


$id=intval($_POST["id_Despesa"]);

$sql ="delete from Despesa where id_Despesa='$id'";

mysqli_query($conn,$sql);

mysqli_close($conn);

?>