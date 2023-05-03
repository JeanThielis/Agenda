<?php
include_once("conexao.php");

$funcao = intval($_POST['funcao']);
if($funcao==1){

    $id=intval($_POST['id']);   
    $nome = $_POST['nome-editar'];
    $data = $_POST['data-editar'];
    $hora = $_POST['hora-editar'];
    $servico = $_POST['servico-editar'];
    $valor = floatval($_POST['valor-editar']);
    $pagamento = $_POST['pagamento-editar'];
    $restante = floatval($_POST['restante-editar']);
    $bairro = $_POST['bairro-editar'];
    $cidade = $_POST['cidade-editar'];
    $cel = $_POST['cel-editar'];
    $cores = $_POST['cores-editar'];
    $situacao=1;
    echo "passou pelo if";


    $sql ="update Agenda  set situacao = '$situacao', restante = '$restante',pagamento='$pagamento',nome_Cliente='$nome',data_Cliente = '$data',hora = '$hora',servico ='$servico',valor = '$valor',bairro = '$bairro',cidade = '$cidade',celular = '$cel',cores = '$cores' where id_Agenda='$id'";


}else{
    echo $id=intval($_POST["id_Agenda"]);
    $situacao = 0;
    $restante = 0;
    $pagamento = "Pago";
    echo "Deu ruim no if";

    $sql ="update Agenda  set situacao = '$situacao', restante = '$restante',pagamento='$pagamento' where id_Agenda='$id'";

}



mysqli_query($conn,$sql);

mysqli_close($conn);

?>