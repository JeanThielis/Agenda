<?php
include_once("conexao.php");


$id=intval($_POST["id_Agenda"]);

$sql ="delete from Agenda where id_Agenda='$id'";

mysqli_query($conn,$sql);

mysqli_close($conn);

?>