<?php
include_once("conexao.php");

$id= intval($_POST['id']);

$sql ="SELECT * FROM Despesa where id_Despesa='$id'";
$resultado = mysqli_query($conn, $sql);

while($linha=mysqli_fetch_assoc($resultado)){
?>
<div class="container p-3 bg-light">
<form id="form_Despesa">


<div class="container p-3 bg-light">

<div class="row">
    <div class='col'>
      <label> ID</label>
      <input class='form-control' name='id' id='id' value='<?php echo $linha['id_Despesa']?>' type="text">
    </div>
    <div class="col">
        <label>Data</label>
        <input value='<?php echo $linha['dataDespesa']?>' type="date" name="dataDespesa" id="dataDespesa" class="form-control">                 
    </div>

    <div class="col">
        <label>Descrição</label>
        <input id="descricao" value='<?php echo $linha['descricao']?>' name="descricao" type="text" class="form-control">
    </div>

    <div class="col">
        <label>Valor</label>
        <input  value='<?php echo $linha['valor']?>' id="valor" name="valor" type="text" class="form-control">  
  </div>
</div>
<div class="row">
    <div class="col">
      <label> Despesa de Casa ?</label><br>
      <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="despesaCasa" id="radio0" value="0">
          <label class="form-check-label" for="inlineRadio1">Não</label>
      </div>
        
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="despesaCasa" id="radio1" value="1" />
          <label class="form-check-label" for="inlineRadio2">Sim</label>
        </div>
        
  </div>
</form>
</div>
<hr>
<div class="row">
  <div class="col"></div>
  <div class="col"></div>
  <div class="col">
  <button type="button" id="atualizarDespesa" class="btn btn-primary btn-sm">Salvar </button>

  </div>
</div>

</div>

<?php    
}
mysqli_close($conn);

?>