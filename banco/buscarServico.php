<?php
    include_once("conexao.php");

    $sql='select*from Servico';
    
    $resultado = mysqli_query($conn,$sql);
   ?>
   <label class='text-secondary' >Serviço:</label><br>
   <select class='form-control text-secondary selectServico' id='servico' name='servico'>
        
            <?php
                while($row=mysqli_fetch_assoc($resultado)){
                   echo "<option>".$row['produto']."</option>";
                }

            mysqli_close($conn);

            ?>
          
   </select>