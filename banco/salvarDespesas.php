<?php
    include_once("conexao.php");

    $data=$_POST['dataDespesa'];
    $descricao=$_POST['descricao'];
    $valor = floatval($_POST['valor']);
    $casa = intval($_POST['despesaCasa']);

    $sql="INSERT INTO Despesa(dataDespesa,descricao,valor,casa)VALUES('$data','$descricao','$valor','$casa')";

    mysqli_query($conn,$sql);

    mysqli_close($conn);


?>