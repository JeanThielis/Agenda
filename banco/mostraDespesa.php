<?php
include_once("conexao.php");

$ano='2023';
$sql="SELECT date_format(dataDespesa,'%d/%m/%y') as data, valor,descricao,casa,id_Despesa FROM Despesa where year(dataDespesa)='$ano' order by dataDespesa desc";
$resultado = mysqli_query($conn,$sql);

$sqlSoma="SELECT sum(valor) as valorTotal, sum(if(casa=0,valor,'')) as despesaSopro,sum(if(casa=1,valor,'')) as despesaCasa from Despesa where year(dataDespesa)='$ano'";
$resultadoSoma = mysqli_query($conn,$sqlSoma);

$sqlSomaReceita = "SELECT sum(if(pagamento!='Pendente',valor,'')) - sum(if(pagamento!='Pendente',restante,'')) as totalReceita from Agenda where year(data_Cliente)='$ano' ";
$resultadoSomaReceita = mysqli_query($conn,$sqlSomaReceita);

while($linhaReceita=mysqli_fetch_assoc($resultadoSomaReceita)){
    $rowReceita = $linhaReceita['totalReceita'];
}


while($row=mysqli_fetch_assoc($resultadoSoma)){
    $rowDespesa = $row['valorTotal'];
   
?>
<div class="alert bg-light">
    <div class="row">
       
        <div class="col">

            <div class="alert alert-primary">
                <label>Total Receita</label><br>
                <div class="row">
                    <div class="col">
                    <i class="fas fa-2x fa-money-bill-wave"></i>
                    </div>
                    <div class="col">
                        <strong>
                        <?php echo 'R$'. number_format($rowReceita,2,',','.');?>
                        </strong>
                       
                    </div>
                </div>

            </div>
        </div>
         <div class="col">

            <div class="alert alert-danger">
                <label>Total Despesa</label><br>
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

            <div class="alert alert-success">
                <label>Valor em Caixa</label><br>
                <div class="row">
                    <div class="col">
                    <i class="fas fa-2x fa-money-bill-wave"></i>
                    </div>
                    <div class="col">
                        <strong>
                        <?php echo 'R$'. number_format($rowReceita-$rowDespesa,2,',','.');?>
                        </strong>
                       
                    </div>
                </div>

            </div>
        </div>
        <div class="col">
            <div class="alert alert-warning">
                    <label>Despesa de Casa</label><br>
                    <div class="row">
                        <div class="col">
                        <i class="fas fa-2x fa-money-bill-wave"></i>
                        </div>
                        <div class="col">
                            <strong>
                            <?php echo 'R$'. number_format($row['despesaCasa'],2,',','.');?>
                            </strong>
                        </div>
                    </div>

            </div>
        </div>
        <div class="col">
        <div class="alert alert-info">
                <label>Despesa Sopro</label><br>
                <div class="row">
                    <div class="col">
                    <i class="fas fa-2x fa-money-bill-wave"></i>
                    </div>
                    <div class="col">
                        <strong>
                        <?php echo 'R$'. number_format($row['despesaSopro'],2,',','.');?>
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
<div class='alert bg-light'>
<table class='table'>
                <thead class='bg-danger text-light'>
                  <tr>
                    <th><strong>Data</strong></th>
                    <th><strong>Descrição</strong></th>
                    <th><strong>Valor</strong></th>
                    <th><strong>Despesa de Casa ?</strong></th>
                    <th><strong>Ações</strong></th>

                  </tr>
                </thead>
    <tbody>
    <?php    
    while($linha = mysqli_fetch_assoc($resultado)){
        if($linha['casa']==0){
            $casa='<h5><span class="badge bg-primary">Não</span></h5>';
        }
        else{
            $casa='<h5><span class="badge bg-secondary">Sim</span></h5>';
        }
    
?>
        <tr>
            <td>
                <?php echo $linha['data']?>
            </td>
            <td>
                <?php echo $linha['descricao']?>
            </td>
            <td>
                R$ <?php echo number_format($linha['valor'],2,',','.')?>
            </td>
            <td>
                <?php echo $casa?>
            </td>
            <td>
          <a class=" m-1 text-warning "   >
            <i data-toggle="modal" data-target="#modalEditarDespesa"  id="<?php echo $linha['id_Despesa']?>" class="editarDespesa fas fa-edit"></i>
          </a> 
          <a class=" m-1 text-danger ">
            <i   id="<?php echo $linha['id_Despesa']?>" class="deletarDespesa far fa-1x fa-trash-alt"></i>
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