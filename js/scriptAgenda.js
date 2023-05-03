

$(document).ready(function(){
   mostrarAgenda();
   resultadoImpressao();
   mostrarServico();
   mostrarTabelaServico();

   function alertConfirm(tipo,titulo,mensagem,time){
    Swal.fire({
        title: titulo,
        icon: tipo,
        text:mensagem,
        showConfirmButton: false,
        timer: time
      })

   };

   function alertError(tipo,titulo,mensagem){
    Swal.fire({
        title: titulo,
        text: mensagem,
        icon: tipo,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Desmarcado',
            'Descarmado com Sucesso',
            'success'
          )
        }
      })

   };

  

  
  function mostrarAgenda(){
   $.ajax({
       url:"banco/mostraAgenda.php",
       success:function(data){
           $("#mostrarAgenda").html(data);
       }
   }); 

  };
  function mostrarTabelaServico(){
    $.ajax({
        url:"banco/tabelaServicoCliente.php",
        success:function(data){
            $("#tabelaServico").html(data);
        }
    })
  };

  function mostrarServico(){
    $.ajax({
        url:"banco/buscarServico.php",
        success:function(data){
            $("#mostrarServico").html(data);
        }
    })
  };
  function resultadoImpressao(){
    $.ajax({
        url:"banco/impressao.php",
        success:function(data){
            $("#mostrarImpresssao").html(data);
        }
    });
  }
   $("#cel").mask("(00)00000-0000");


  $("#pagamento").change(function(){
   var pagamento = this.value;
   var valor = parseFloat($('#valor').val());

   if(pagamento == "Selecione"){
      alert("Selecione tipo de pagamento");
   }

   else if(pagamento=="Entrada Feita"){
       var restante = valor/2;
   }
   else if(pagamento=="Pago"){
       var restante = 0;
   }else{
       var restante = valor;
   }
   $('#restante').val(restante);


   
   
  });

  $("#salvar").click(function(){
   var dados = $("#form_Agenda").serialize();
   $.ajax({
       url:"banco/salvarAgenda.php",
       type:'post',
       data:dados,
       dataType:'html',
       success:function(response){
        $('#form_Agenda')[0].reset();
        
           alertConfirm("success","Agendado",false,2000);
           mostrarAgenda();
          
       }

   });

  })
  $("#btn_radio1,#btn_radio2").click(function(){
    situacao = $(this).val();
    $("#pesquisar").prop("disabled",false);
   

})
  $('#pesquisar').keyup(function(){
   var pesquisa = $(this).val();
   var dados={buscar:pesquisa,situacao:situacao};
  
       $.ajax({
       url:"banco/buscarAgenda.php",
       type:'post',
       data:dados,
       dataType:'html',
       success:function(response){
           $("#mostrarAgenda").html(response)
           
       }
   });
   $.ajax({
    url:'banco/impressao.php',
    type:'post',
    dataType:'html',
    data:dados,
    success:function(response){
        $("#mostrarImpresssao").html(response);
    }
});
       
   });

   $("#dataFim").change(function(){
       var dataFim = this.value;
       var dataInicio = $("#dataInicio").val();
       var dados={dataF:dataFim,dataI:dataInicio,funcao:1,situacao:situacao};
       $.ajax({
           url:'banco/buscarAgenda.php',
           type:'post',
           dataType:'html',
           data:dados,
           success:function(response){
               $("#mostrarAgenda").html(response);
              

           }

       })
       $.ajax({
        url:'banco/impressao.php',
        type:'post',
        dataType:'html',
        data:dados,
        success:function(response){
            $("#mostrarImpresssao").html(response);
        }
    });

   });

   $("#imprimir").click(function(){
    var conteudo = $("#mostrarImpresssao").html(),
    tela_impressao = window.open();
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
    
   });

   $("#nome").focusout(function(){
    $.ajax({
        url:"banco/exebirValor.php",
        type:"post",
        dataType:"html",
        data:{nome:this.value},
        success:function(retorno){
            $("#resultadoCadastro").html(retorno);
        }
    });
   });

   $(document).on("change",".selectServico",function(){
    
   $.ajax({
       url:"banco/buscarValorServico.php",
       type:"post",
       dataType:"html",
       data:{servico:this.value},
       success:function(retorno){
        $("#mostrarValorServico").html(retorno);           
       }

   });
   

})
  

  $(document).on("click",".editar",function(){
    var id = this.id;
   $.ajax({
       url:"banco/editarAgenda.php",
       type:"post",
       data:{id:id},
       success:function(retorno){
           $("#mostrarAgenda").html(retorno);
       }

   });
   

})

$(document).on("click",'#btn_Atualizar',function(){
   var dados = $("#form_Editar").serialize();
   $.ajax({
       url:"banco/atualizarAgenda.php",
       type:'post',
       data:dados,
       dataType:'html',
       success:function(response){
           $('#form_Editar')[0].reset();
           alertConfirm('success','Atualizado',false,3000);
           mostrarAgenda();                
       }
   })
  
   
   
});

$(document).on("click",".deletar",function(){
    alertError("warning","Desmarcar ?","Você não vai conseguir reverter")

   $.ajax({
       url:"banco/deletarAgenda.php",
       type:'post',
       data:{id_Agenda:this.id},
       dataType:'html',
       success:function(response){
        mostrarAgenda();
       }
   })

})

$(document).on("click",".concluido",function(){
   $.ajax({
       url:"banco/atualizarAgenda.php",
       type:"post",
       data:{id_Agenda:this.id},
       dataType:'html',
       success:function(response){
        alertConfirm('success','Legal', 'Foi marcado como concluído',3000);
           mostrarAgenda();

       }
   });
   

});
$(document).on("click",".alertClienteCadastrado",function(){
    $.ajax({
        url:"banco/editarAgenda.php",
        type:"post",
        data:{id:this.id},
        success:function(retorno){
            $("#mostrarAgenda").html(retorno);
            $('#centralModalSm').modal('hide');
            $('#form_Editar')[0].reset();

            setTimeout(fecharAlert,4000);

            
        }
 
    });

});
  
});