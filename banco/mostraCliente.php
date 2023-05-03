<?php
include_once('conexao.php');


$sql="SELECT * FROM Cliente";
$resultado = mysqli_query($conn,$sql);


?>
<div class="alert bg-light">
<table class='table'>
        <thead class='bg-success text-light' >
            <tr>
                <th><strong>Nome</strong></th>
                <th><strong>Celular</strong></th>
                <th><strong>Bairro</strong></th>
                <th><strong>Cidade</strong></th>
                <th><strong>E-mail</strong></th>
                <th><strong>Ações</strong></th>
            </tr>
        </thead>
        <tbody>
<?php
while($linha=mysqli_fetch_assoc($resultado)){
?>   
            <tr>
                <td><?php echo $linha['nomeCliente']?></td>
                <td><?php echo $linha['cel']?></td>
                <td><?php echo $linha['bairro']?></td>
                <td><?php echo $linha['bidade']?></td>
                <td><?php echo $linha['email']?></td>
                <td></td>

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