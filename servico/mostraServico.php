<?php
include_once("conexao.php");

$sql="select id_Servico,produto,valor_Produto,custo, valor_Produto - custo as lucro from Servico";

$resultado = mysqli_query($conn,$sql);

while($linha=mysqli_fetch_assoc($resultado)){
    ?>
        <tr>
            <td><?php echo $linha['produto']?></td>
            <td><?php echo 'R$'.number_format($linha['valor_Produto'],2,',')?></td>
            <td><?php echo 'R$'.number_format($linha['custo'],2,',')?></td>
            <td><?php echo 'R$'.number_format($linha['lucro'],2,',')?></td>
            <td><?php echo number_format(($linha['lucro']/$linha['valor_Produto']*100),2)?>%</td>



            <td> <a class=" m-1 text-secondary ">
            <i id="<?php echo $linha['id_Servico']?>" class="editar-produto fas fa-edit"></i>
          </a> 
          <a class=" m-1 text-danger ">
            <i id="<?php echo $linha['id_Servico']?>" class="deletar-produto far fa-1x fa-trash-alt"></i>
          </a> </td>
        </tr>



<?php    
}

mysqli_close($conn);


?>