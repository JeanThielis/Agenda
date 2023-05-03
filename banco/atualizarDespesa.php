<?php
    include_once('conexao.php');
    $id=$_POST['id'];
    $data=$_POST['dataDespesa'];
    $descricao=$_POST['descricao'];
    $valor = floatval($_POST['valor']);
    $casa = intval($_POST['despesaCasa']);

    $sql ="update Despesa  set dataDespesa = '$data', descricao = '$descricao',valor='$valor',casa='$casa' where id_Despesa='$id'";
    mysqli_query($conn,$sql);

    mysqli_close($conn);


?>