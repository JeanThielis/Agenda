<?php
include_once("conexao.php");

$id=intval($_POST['id']);


$sql = "select * from Agenda where id_Agenda = '$id'";
$resultado=mysqli_query($conn, $sql);

while($linha=mysqli_fetch_assoc($resultado)){
    ?>
  
  
         <form class='bg-light p-2' id="form_Editar">
         <i class="editar fas  fa-edit">
         </i>
         <h4> Editar</h4>
        
        <hr>
            <input style='visibility: hidden' value="<?php echo $linha['id_Agenda']?>"  id='id' name="id" type="text">
            <input style='visibility: hidden' value="1"  id='funcao' name="funcao" type="text">

          <div class="row">
              <div class="col-4">
              <label class='text-secondary'>Nome</label>
                      <input value="<?php echo $linha['nome_Cliente']?>" type="text" name="nome-editar" id="nome-editar" class="form-control">
              </div>
              <div class="col-4">
                  <label class='text-secondary' for="data">Data</label>
                  <input value="<?php echo $linha['data_Cliente']?>"  id="data-editar" name="data-editar" type="date" class="form-control">
              </div>

              <div class="col-2">
                  <label class='text-secondary' for="horaChegada-editar">Hora Chegada </label>
                  <input value="<?php echo $linha['horaChegada']?>" id="horaChegada-editar" name="horaChegada-editar" type="time" class="form-control">
              </div>

              <div class="col-2">
                  <label class='text-secondary' for="hora-editar">Hora da Festa</label>
                  <input value="<?php echo $linha['hora']?>" id="hora-editar" name="hora-editar" type="time" class="form-control">
              </div>

          </div>
          <br>
          <div class="row">
              <div class="col">
              <label class='text-secondary' >Serviço</label>
                      <input value="<?php echo $linha['servico']?>" type="text" name="servico-editar" id="servico-editar" class="form-control">
              </div>
              <div class="col">
              <label class='text-secondary' >Valor</label>
                      <input value="<?php echo $linha['valor']?>" type="text" name="valor-editar" id="valor-editar" class="form-control">
              </div>
              <div class="col">
                  <label class='text-secondary' >Pagamento</label>
                  <select  class="form-control" name="pagamento-editar" id="pagamento-editar">
                      <option selected >Selecione</option>
                      <option>Entrada Feita</option>
                      <option>Pendente</option>
                      <option>Pago</option>
                  </select>
              </div>

          </div>
          <br>
          <div class="row">
              <div class="col">
              <label class='text-secondary' >Restante</label>

                      <input value="<?php echo $linha['restante']?>" type="text" id="restante-editar" name="restante-editar" class="form-control">
                  
              </div>
              <div class="col">
              <label class='text-secondary' >Bairro</label>

                      <input value="<?php echo $linha['bairro']?>" type="text" id="bairro-editar" name="bairro-editar" class="form-control">
              </div>
              <div class="col">
                <label class='text-secondary' >Cidade</label>
                      <input value="<?php echo $linha['cidade']?>" type="text" id="cidade-editar" name="cidade-editar" class="form-control">
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-4">
                    <label class='text-secondary' >Celular</label>
                      <input value="<?php echo $linha['celular']?>" type="text" name="cel-editar" id="cel-editar" class="form-control">

              </div>
              <div class="col-8">
                    <label class='text-secondary' >Cores</label>
                      <input value="<?php echo $linha['cores']?>" type="text" class="form-control" id="cores-editar" name="cores-editar"></input>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col"></div>
            <div class="col">
                <button id='btn_Atualizar' style='width:100%' type="button" class="btn btn-secondary">Atualizar</button>
            </div>
            <div class="col"></div>
          </div>
        </form>

    <?php
}

?>