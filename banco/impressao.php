<?php
include_once("conexao.php");
$buscar = filter_input(INPUT_POST,'buscar',FILTER_SANITIZE_STRING);
$situacaoProv = filter_input(INPUT_POST,'situacao',FILTER_SANITIZE_STRING);
$situacao = intval($situacaoProv);

$funcao = $_POST['funcao'];
$dataI=$_POST['dataI'];
$dataF=$_POST['dataF'];
$semana = array('Sun'=>'Domingo','Mon'=>'Segunda','Tue'=>'Terça','Wed'=>'Quarta','Thu'=>'Quinta','Fri'=>'Sexta','Sat'=>'Sábado');


if($funcao == 1){
  $sql = "select date_format(data_Cliente,'%a') as dia, date_format(data_Cliente,'%d/%m/%y') as data ,time_format(hora,'%H:%i')as hora,nome_Cliente,servico,bairro,cidade,valor,restante,pagamento,cores,celular,id_Agenda  from Agenda where data_Cliente between '$dataI' and '$dataF' and situacao = $situacao order by data_Cliente";

}
elseif($buscar == " "){
  $sql = "select count(id_Agenda) as cont, sum(valor) as valorTotal, sum(restante) as restanteTotal,sum(valor)- sum(restante) as pagos , date_format(data_Cliente,'%a') as dia, date_format(data_Cliente,'%d/%m/%y') as data ,time_format(hora,'%H:%i')as hora,nome_Cliente,servico,bairro,cidade,valor,restante,pagamento,cores,celular,id_Agenda  from Agenda where situacao = 1 order by data_Cliente";

}else{
  $sql = "select date_format(data_Cliente,'%a') as dia, date_format(data_Cliente,'%d/%m/%y') as data ,time_format(hora,'%H:%i')as hora,nome_Cliente,servico,bairro,cidade,valor,restante,pagamento,cores,celular,id_Agenda  from Agenda where  nome_Cliente like '$buscar%' and situacao=$situacao order by data_Cliente";


}
$semana = array('Sun'=>'Domingo','Mon'=>'Segunda','Tue'=>'Terça','Wed'=>'Quarta','Thu'=>'Quinta','Fri'=>'Sexta','Sat'=>'Sábado');


$resultado = mysqli_query($conn,$sql);
?>
<div class="row text-primary">
  <div class="col">
  <h3>Relatório de Festas</h3>
  </div>
  <div class="col">
    
  </div>
  <div class="col"></div>
</div>
  <?php
  while($linha = mysqli_fetch_assoc($resultado)){
    ?>
    <div class="row text-primary m-3">
      <div class="col">
       <strong>  <?php echo $semana[$linha['dia']].' - '.$linha['data'].' - '. $linha['hora'].' | '. $linha['nome_Cliente'].' | '.$linha['celular']?></strong><br>
       <strong>Local: </strong> <?php echo $linha['bairro'].' - '. $linha['cidade']?><br>
       <strong>Serviço: </strong> <?php echo $linha['servico']?><br>
       <strong>Pagamento: </strong><?php echo $linha['pagamento'].' | <strong>Valor: </strong>R$'.number_format($linha['valor'],2,',').' | '.'<strong>Restante: </strong>R$'. number_format($linha['restante'],2,',')?><br>
       <strong>Cores: </strong><?php echo $linha['cores']?>

      </div>
    </div>
    </div>
    <hr>
    <?php
  }

mysqli_close($conn);
?>