<?php
    include_once("conexao.php");
    $servico= $_POST['servico'];


    $sql="select*from Servico where produto = '$servico'";
    
    $resultado = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($resultado)){
        ?>
         <label class="form-label text-secondary" for="valor">Valor:</label>
            <input type="text" id='valor' class='form-control  text-secondary' value="<?php echo $row['valor_Produto']?>" >  
            
        <?php
    }

?>
  