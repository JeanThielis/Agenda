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
$resultado = mysqli_query($conn,$sql);

$sqlSoma = "select count(id_Agenda) as cont, sum(valor) as valorTotal, sum(restante) as restanteTotal,sum(valor)- sum(restante) as pagos from Agenda where data_Cliente between '$dataI' and '$dataF'and situacao =$situacao order by data_Cliente";
$resultadoSoma = mysqli_query($conn,$sqlSoma);


while($row = mysqli_fetch_assoc($resultadoSoma)){

  ?>
  <div class="alert bg-light">
  <div class="row">
    <div class="col">
        <div class="alert alert-success">
        <label>Total</label><br>
        <div class="row">
          <div class="col">
          <i class="fas fa-2x fa-money-bill-wave"></i>
          </div>
          <div class="col">
            <strong>
            <?php echo 'R$'. number_format($row['valorTotal'],2,',','.');?>
            </strong>
          </div>
        </div>

        </div>
    </div>
    <div class="col">
        <div class="alert alert-info">
        <label>A Receber</label><br>

          <div class="row">
            <div class="col">
            <i class="fas fa-2x fa-hand-holding-usd"></i>

            </div>
            <div class="col">
            <strong>
              <?php echo 'R$'. number_format($row['restanteTotal'],2,',','.');?>
              </strong>
            </div>
          </div>
           

        </div>
    </div>
    <div class="col">
    <div class="alert alert-secondary">
        <label>Recebido</label><br>

          <div class="row">
            <div class="col">
            <i class="fas fa-2x fa-file-invoice-dollar"></i>

            </div>
            <div class="col">
            <strong>
              <?php echo 'R$'. number_format($row["pagos"],2,',','.');?>
              </strong>
            </div>
          </div>
           

        </div>
    </div>
    <div class="col">
    <div class="alert alert-warning">
        <label>Total de Festas</label><br>

          <div class="row">
            <div class="col">
            <i class="fas fa-2x fa-birthday-cake"></i>

            </div>
            <div class="col">
            <strong>
              <?php echo $row["cont"]?>
              </strong>
            </div>
          </div>
           

        </div>
    </div>
  </div>
  </div>
 
   
    
  <?php
}

?>


<div class=' alert bg-light'>
<table class="table table-fixed table-sm">

  <!--Table head-->
  <thead>
    <tr class='table-dark text-light'>
    <th><strong>Data | Hora</strong></th>
      <th><strong>Nome</strong></th>
      <th><strong>Endereço</strong></th>
      <th><strong>Serviço | Cores</strong></th>
      <th><strong>Valor | Restante</strong></th>
      <th><strong>Pagamento</strong></th>
      <th><strong>Ações</strong></th>
      
     
      
    </tr>
  </thead>
 
  <tbody>
  <?php  
  while($linha = mysqli_fetch_assoc($resultado)){
    $cont=$cont+1;
    if($linha['situacao']==0){
      $situacao = '<h5><span class="badge bg-secondary">Concluído</span></h5>';
    }
    else{
      $situacao="";
    }
  
    if($linha['pagamento']== "Entrada Feita"){
      $pagamento = '<h5><span class="badge bg-primary">Entrada Feita</span></h5>';
    }
    elseif($linha['pagamento']=="Pendente"){
      $pagamento = '<h5><span class="badge bg-danger">Pendente</span></h5>';
    }
    else{
      $pagamento = '<h5><span class="badge bg-success">Pago</span></h5>';
    }
    ?>
    <tr>
          <td>
            <div class="d-flex align-items-center">
              <div class="ms-3">
                <p class="fw-bold mb-1"><?php echo $semana[$linha['dia']] ?></p>
                <p class="fw-bold mb-1"><?php echo $linha['data']?></p>
                <p class="text-muted mb-0"><?php echo $linha['hora']?></p>
              </div>
            </div>
          </td>
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-3">
              <p class="fw-bold mb-1"><?php echo $linha['nome_Cliente']?></p>
              <p class="text-muted mb-0"><?php echo $linha['celular']?></p>
            </div>
          </div>
        </td>
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-3">
              <p class="fw-bold mb-1"><?php echo $linha['cidade']?></p>
              <p class="text-muted mb-0"><?php echo $linha['bairro']?></p>
            </div>
          </div>
        </td>
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-3">
              <p class="fw-bold mb-1"><?php echo $linha['servico']?></p>
              <p class="text-muted mb-0"><?php echo $linha['cores']?></p>
            </div>
          </div>
        </td>
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-3">
              <p class="fw-bold mb-1"><?php echo "R$ ".number_format($linha['valor'],2,',')?></p>
              <p class="text-muted mb-0"><?php echo "R$ ".number_format($linha['restante'],2,',')?></p>
            </div>
          </div>
        </td>
        <td><?php echo $pagamento?></td>
        <td>
          <a class=" m-1 text-warning ">
            <i id="<?php echo $linha['id_Agenda']?>" class="editar fas fa-edit"></i>
          </a> 
          <a class=" m-1 text-danger ">
            <i id="<?php echo $linha['id_Agenda']?>" class="deletar far fa-1x fa-trash-alt"></i>
          </a>
          <a class="text-success m-1">
            <i id="<?php echo $linha['id_Agenda']?>" class="concluido fas fa-check-double "></i>
          </a>
        </td>
  </tr>
   

<?php
    }
    ?>
  </tbody>


</table>
</div>





<?php
  
mysqli_close($conn);
?>