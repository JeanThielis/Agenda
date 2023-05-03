$(document).ready(function(){
    mostrarDespesas();

    function mostrarDespesas(){
        $.ajax({
            type:"post",
            url: "banco/mostraDespesa.php",
            dataType: "html",
            success: function (response) {
                $("#resultadoDespesas").html(response);
                
            }
        });
    }

    $('#valor').mask("#.##0.00", {reverse: true});
   
    
    function alertConfirm(tipo,titulo,mensagem,time){
        Swal.fire({
            title: titulo,
            icon: tipo,
            text:mensagem,
            showConfirmButton: false,
            timer: time
          })
    
       };       
    $("#salvarDespesa").click(function () { 
        var dados = $("#form_Despesa").serialize();
        $.ajax({
            type: "post",
            url: "banco/salvarDespesas.php",
            data: dados,
            dataType: "html",
            success: function (response) {
                $('#form_Despesa')[0].reset();
                alertConfirm("success","Legal","Despesa Lançada",2000);
                mostrarDespesas();
                
            }
        });
        
    });
    $(document).on("click",".deletarDespesa",function(){

    
       $.ajax({
           url:"banco/deletarDespesa.php",
           type:'post',
           data:{id_Despesa:this.id},
           dataType:'html',
           success:function(response){
            mostrarDespesas();
           }
       });
    
    });
    $(document).on("click",".editarDespesa",function(){
        $.ajax({
            url:"banco/editarDespesa.php",
            type:'post',
            data:{id:this.id},
            dataType:'html',
            success:function(response){
                $("#resultadoDespesas").html(response);

                
            }
        });
     
     });
     $(document).on('click','#atualizarDespesa',function(){
        var dados = $("#form_Despesa").serialize();
        $.ajax({
            type:"post",
            url: "banco/atualizarDespesa.php",
            data: dados,
            dataType: "html",
            success: function (response) {
                alertConfirm('success', 'Atualizado com Sucesso',false,3000);
                mostrarDespesas();
                
            }
        });
        
     })
     $(document).on('click','#fecharModalDespesa',function(){
       fecharModal();
    })


});