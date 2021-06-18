function dimePropiedades(){ 
  console.log("Dando propiedades....");
  datosForm() 
  
}

function limpiarErrorBox(){
  $('#error-name').empty()
  $('#error-email').empty()
  $('#error-faculty').empty()
  $('#error-career').empty()
  $('#error-miSelect1').empty()
  $('#error-message').empty()
}

function mostrarErrorForm(){
  var count_error=0
  for(var i=0; i<datos.length;i++){
      if(datos[i].val()==null || datos[i].val()=="" || datos[i].val()=="invalid"){
          $("#error-"+datos[i].attr("id")+"").append("<p class='error-message' style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'>Ingrese un "+datos[i].attr("name")+"</p>")
          count_error++;
      }else{  
          console.log("El dato es "+datos[i].val())          
      }
  }
  if(count_error==0){
      //$('#contact-form').post("<?php include('contacto.php')?>");
      //$('.exito-message').append("Mensaje enviado xd");
      console.log("Datos enviados")
  }else{
      console.log("Error al enviar el formulario")
  }
}

function datosForm(){
  //$("#loading").append("<br>Loading");
  //var datos_form=$('form').serialize()
  limpiarErrorBox();
  datos=[]
  nombre =  $('#name');
  //.attr("id") --obtiene atributo
  //.val() --obtiene valor 
  email = $('#email');
  faculty = $('#faculty');
  career = $('#career');
  miSelect1 = $('#miSelect1');
  message= $('#message');
  datos.push(nombre,email, faculty, career, miSelect1,message);
  mostrarErrorForm();
  
}

/*
  if($('#career').attr("value") == "invalid"){
    $('#error-career').append("<p class='error-message' style='color:white; background: #c51244 !important; box-shadow: 1px 1px 1px #aaaaaa; margin-top: 10px;'>Ingrese un "+datos[i].attr("name")+"</p>")
    count_error++;
  }
*/