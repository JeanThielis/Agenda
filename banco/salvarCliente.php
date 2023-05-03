<?php
    include_once("conexao.php");

    $nome = $_POST['nomeCliente'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    $cel = $_POST['cel'];

    $sql="INSERT INTO Cliente (nomeCliente,bairro,cidade,email,cel)values('$nome','$bairro','$cidade','$email','$cel')";
    mysqli_query($conn,$sql);
    mysqli_close($conn);

?>