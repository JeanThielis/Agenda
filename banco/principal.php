<?php
include_once("conexao.php");




$ano='2023';
$anos = $_POST['anos'];



$sql = "select count(id_Agenda) as total, sum(if(pagamento!='Pendente',valor,'')) - sum(if(pagamento!='Pendente',restante,'')) as valortotal, avg(valor) as media, date_format(data_cliente,'%M') as mes from Agenda WHERE YEAR(data_Cliente) = '$ano' group by month(data_Cliente)";
$meses= array('January'=>'Janeiro','February'=>'Fevereiro','March'=>'Março','April'=>'Abril','June'=>'Junho','May'=>'Maio','July'=>'Julho','August'=>'Agosto','September'=>'Setembro','October'=>'Outubro','November'=>'Novembro','December'=>'Dezembro');


/*
'January'=>'Janeiro'
'February'=>'Fevereiro'
'March'=>'Março'
'April'=>'Abril'
'May'=>'Maio'
'June'=>'Junho'
'July'=>'Julho'
'August'=>'Agosto'
'September'=>'Setembro'
'October'=>'Outubro'
'November'=>'Novembro'
'December'=>'Dezembro'
*/

$resultado = mysqli_query($conn,$sql);
?>

<table class="table table-sm">
                    <thead>
                      <tr>
                      <th><strong>Mês</strong></th>
                        <th><strong>Quantidade</strong></th>
                        <th><strong>Valor</strong></th>
                        <th><strong>Media</strong></th>
                      </tr>
                    </thead>
                    
                    
                 
 
  <tbody>
<?php
  while($linha = mysqli_fetch_assoc($resultado)){
    $totalAnul = $linha['valortotal']+$totalAnul;
    $total = $linha['total']+$total;
    ?>
   
  
    <tr>
        <td><?php echo $meses[$linha['mes']]?></td>
        <td ><?php echo $linha['total']?></td>
        <td>R$<?php echo number_format($linha['valortotal'],2,',','.')?></td>
        <td>R$<?php echo number_format($linha['media'],2,',','.')?></td>
    </tr>
  
    <?php
  }
  ?>
  
    </tbody>
    <tfoot>

    <tr>
        <td><strong>Total do Ano</strong></td>
        <td> <?php echo $total?> </td>
        <td>R$<?php echo number_format($totalAnul,2,',','.')?></td>
    </tr>
    </tfoot>
    </table>
  
<?php
mysqli_close($conn);
?>