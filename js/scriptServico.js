$(document).ready(function(){
    mostrarServico();

    function alertConfirm(tipo,titulo,mensagem,time){
        Swal.fire({
            title: titulo,
            icon: tipo,
            text:mensagem,
            showConfirmButton: false,
            timer: time
          })
    
       };
    
  
    function mostrarServico(){
        $.ajax({
            url:'servico/mostraServico.php',
            success:function(data){
                $("#tabela-servico").html(data);
            }
        });
    }

    $("#cadastrar-produto").click(function(){
        var dados = $("#form_Produto").serialize();
        console.log(dados);
        $.ajax({
            url:'banco/salvarServico.php',
            data:dados,
            type:'post',
            dataType:'html',
            success:function(response){
                $("#form_Produto")[0].reset();
                mostrarServico();
                alertConfirm('success','Legal','Cadastrado Com Sucesso !', 3000);
            }
        });
        
    });
    $(document).on("click",".deletar-produto",function(){
        $.ajax({
            type: "post",
            url: "banco/deletarServico.php",
            data: {id:this.id},
            dataType: "html",
            success: function (response) {
                mostrarServico();
                
            }
        });
        
    });
    $(document).on("click",".editar-produto",function(){
        var id = this.id;
        console.log(id);
    });

});