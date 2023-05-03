$(document).ready(function(){
    mostrarCliente()

    function mostrarCliente(){
        $.ajax({
            type: "post",
            url: "banco/mostraCliente.php",
            dataType: "html",
            success: function (response) {
                $("#resultadoCliente").html(response);
            }
        });
    }

   function alertConfirm(tipo,titulo,mensagem,time){
    Swal.fire({
        title: titulo,
        icon: tipo,
        text:mensagem,
        showConfirmButton: false,
        timer: time
      })

   };


   $("#cel").mask("(00)00000-0000");



 $('#btn_CadastrarCliente').click(function(){
    var dados = $("#form_Cliente").serialize();
    $.ajax({
        type: "post",
        url: "banco/salvarCliente.php",
        data: dados,
        dataType: "html",
        success: function (response) {
            $('#form_Cliente')[0].reset();
            mostrarCliente()
            alertConfirm('success','Legal','Cliente cadastrado com Sucesso',3000);
            
        }
    })

 });

});