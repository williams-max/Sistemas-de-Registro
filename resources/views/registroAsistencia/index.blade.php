@extends('layouts.app')

@section('content')
<head>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
</head>

<div class="container" id=" " >


    <div class="row">
        <div class=" " id="divi">
            <div>
               <h5>UNIVERSIDAD MAYOR DE SAN SIMON</h5>
     
                @foreach ($nombreDeLaFaculdad as $nombreDeLaFaculdad)
               <h5>FACULTAD:{{$nombreDeLaFaculdad->nombre}}</h5>
               @endforeach

                @foreach ($nombreDeLaCarrera as $nombreDeLaCarrera)
                <h5>CARRERA:{{$nombreDeLaCarrera->nombre}}</h5>
                 @endforeach

         
                <br>
                <h4 class="text-center">FORMULARIO DE CONTROL DE ASISTENCIA </h4>
                <!--<h4> Register data {{$registers}}</h4>-->
                <BR>
                <BR>
                <div class="row">
                <div class="col-5">
                    <h5>DOCENTE : {{$user->nombre}}  {{$user->apellido}}</h5>
                </div>
                <div class="col-5">
                    <h5>MES : Diciembre </h5>
                </div>
               </div>
               <div class="row">
                <div class="col-5">
                    <h5>CODIGOSIS: {{$user->codigoSis}}</h5>
                </div>
                 <!-- <div class="col-5">
                    <div class="row">
                        <div class="col-5">
                            <h5>DEL:</h5>
                        </div>
                        <div class="col-5">
                            <h5>AL:</h5>
                        </div>
                    </div>-->
                </div>
            </div>

          
    

          <center>
            <div id="divmsg" style="display: none" class="alert alert-primary" role="alert">

           </div>
          </center>

         <!--Logica a modiificar-->
          <form name="tuformulario"  action="" id="contactForm" method="POST">

            <table class="table table-hover" id="table">

                <thead class="thead-light">
                    <tr>

                        <th scope="col"><p>Hora</p></th>
                        <th scope="col"><p>Grupo</p></th>
                        <th scope="col"><p>Materia</p></th>
                        <th scope="col">Contenido <p>de Clase</p> </th>
                        <th scope="col">Plataforma o <p> Medio Utilizado</p></th>
                        <th scope="col"><p>Observaciones</p></th>

                        <th scope="col"></th>
                        <th style="text-align:justify"><a href="#" class="btn btn-info addRow">+</a></th>


                    </tr>
                </thead>
                <tbody>

                    @if ($user->enviados==0)
                       <!-- <h1> Enviado igual 0 </h1>-->
                        <tr>
                            <td><input required type="time" class="form-control " name="hora[]"  id="hora_1"></td>
                                <td> 
                                    <div class="input-field"> 
                                        <input   autocomplete = "off" required type="text" class="form-control "  name="grupo[]" id="grupo_1"> 
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field"> 
                                        <input    autocomplete = "off" required type="text" class="form-control"  name="materia[]" id="materia_1">
                                    <div>    
                                </td>
                                <td><input  required type="text" class="form-control "   name="contenido[]"   id="contenido"></td>
             
                                <td><input required type="text" class="form-control  " name="plataforma[]" id="plataforma"></td>
             
                                <td><input required type="text" class="form-control" name="observacion[]"  id="observacion"> </td>
             
             
             
                                 <th style="text-align: center"><a href="#" class="btn btn-danger remove">-</a></th>
                            
                        </tr>
                    @else
                      
                        @foreach ($registers as $item)
                            <!--<h1>hol</h1>-->
                           
                            <tr>
                               
                                <td><input required type="time"  value="{{$item->hora}}"  class="form-control " name="hora[]"  id="hora_1"></td>
                                <td> 
                                    <div class="input-field"> 
                                        <input   autocomplete = "off" value="{{$item->grupo}}"  required type="text" class="form-control "  name="grupo[]" id="grupo_1"> 
                                    </div>
                                </td>
                                <td>
                                    <div class="input-field"> 
                                        <input    autocomplete = "off" value="{{$item->materia}}"  required type="text" class="form-control"  name="materia[]" id="materia_1">
                                    <div>    
                                </td>
                                <td><input  required type="text" class="form-control "   name="contenido[]" value="{{$item->contenido}}"  id="contenido"></td>
             
                                <td><input required type="text" class="form-control  " name="plataforma[]" value="{{$item->plataforma}}" id="plataforma"></td>
             
                                <td><input required type="text" class="form-control" name="observacion[]" value="{{$item->observacion}}" id="observacion"> </td>
             
             
             
                                 <th style="text-align: center"><a href="#" class="btn btn-danger remove">-</a></th>
                             </tr>
                        @endforeach
                        <!-- <h1> Enviado igual 1 </h1>-->

                       
                    @endif



                   

                </tbody>

            </table>
            <div class="form-group row">
                
                    <td><th scope="col"><p>Firma</p></th>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input required type="text" class="form-control" name="firma[]" id="firma"></td>
                  
          

                
                
    

            </div>
            <div class="form-group row">
                <td> <th scope="col"><p>Del</p></th>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <input required type="date" class="form-control" name="fecha[]" id="fecha"></td>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   

                <td><th scope="col"><p>Al</p></th>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

                    <input required type="date" class="form-control" name="fecha[]" id="fecha"></td>   
            </div>
            <br>
            <div class="form-group ">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                
                

                <button class="btn btn-info " onclick="enviarM()" type="submit">Enviar
                    <input class="form-control"  style="display: none" name="enviar"  type="text" value="enviar" id="enviar">
                    <input class="form-control"  style="display: none" name="aceptar"  type="text" value="aceptar" id="aceptar">
                    <input class="form-control"  style="display: none" name="cancelar"  type="text" value="cancelar" id="cancelar">
                </button>
            
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-info" onclick="conservarM()" type="submit">Conservar Cambios Sin Enviar
                    <input class="form-control"  style="display: none" name="conservar"  type="text" value="conservar" id="conservar">
                </button>
                
             
            </div>
           
           
           </form>
       
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script type="text/javascript">
    function ConfirmDemo() {
        //Ingresamos un mensaje a mostrar
        var mensaje = confirm("¿Estas Seguro que Deseas Enviar?");
        //Detectamos si el usuario acepto el mensaje
        if (mensaje) {
        alert("¡Gracias por aceptar!");
        document.getElementById("aceptar").disabled = false;
        document.getElementById("cancelar").disabled = true;
        }
        //Detectamos si el usuario denegó el mensaje
        else {
        alert("¡operacion Denegada!");
        document.getElementById("aceptar").disabled = true;
        document.getElementById("cancelar").disabled = false;
        }
        }

     var text=document.getElementById('materia_1');
     text.addEventListener('keyup',(event)=>{
        event.preventDefault();
         var inputText=event.path[0].value;
         if(isNaN(inputText)==false){
            alert("Este campo no permite numeros");
             console.log("es numero")

         }else{
            console.log("no es numero")
         }
         console.log(inputText);
     });
      
</script>

<script type="text/javascript">
    
    var rowcount=2;
    $('.addRow').on('click',function(){
        addRow();
    });

    //mensajes adicionles para el guarda de datos
    function mostrarMensaje(mensaje){
        $("#divmsg").empty();
        if(mensaje=='undefined'){
            console.log("dice undefined")
         //   $("#divmsg").append("<p>"+mensaje+ "</p>" );
            $("#divmsg").append(" OPEREACION CANCELADA");
            $("#divmsg").show(1000);
            $("#divmsg").hide(5000);
        }else{
            $("#divmsg").append("<p>"+mensaje+ "</p>" );
            //$("#divmsg").append(" ENVIADO CORRECTAMENTE");
            $("#divmsg").show(1000);
            $("#divmsg").hide(5000);

        }
     

        console.log("entre la funcion mostrar mensaje")
    }

    function addRow()
    {
        //alert('test');
       // console.log(rowcount);
       // rowcount++;

       var tr =  '<tr>'+

        '<td><input type="time" class="form-control " name="hora[]" id="hora_'+rowcount+'"></td>'+
        '<td><div class="input-field"> <input autocomplete = "off" type="text" class="form-control " name="grupo[]" id="grupo_'+rowcount+'" ></div></td>'+
        '<td><div class="input-field"> <input autocomplete = "off" type="text" class="form-control" name="materia[]" id="materia_'+rowcount+'"></div></td>'+
        '<td><input type="text" class="form-control " name="contenido[]" id="contenido"></td>'+

        '<td><input type="text" class="form-control  " name="plataforma[]" id="plataforma"></td>'+

        '<td><input type="text" class="form-control" name="observacion[]" id="observacion"> </td>'+



        '<th style="text-align: center"><a href="#" class="btn btn-danger remove">-</a></th>'+

        '</tr>';
        pru(rowcount); 
        rowcount++;
        
        console.log(tr);
        
        $('tbody').append(tr);

        $('tbody').on('click','.remove',function(){
            $(this).parent().parent().remove();
            rowcount--;
            console.log("reduciendo")
            console.log(rowcount)

        });
        

    }

    //aumentado codigo para guardar
    //contactForm
    $(function(){

        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : '{{csrf_token()}}'}
        });

        $('#contactForm').submit(function(e){
            e.preventDefault();
            console.log('imprimendo datos')

            var data = $(this).serialize();
            //registroAsistencia.store
            var url = '{{url('registroAsistencia/contacts')}}'
            console.log(data)

            $.ajax({
                url:url,
                method:'POST',
                data:data,
                success:function(response){
               // console.log(response)

                mostrarMensaje(response.mensaje);
                /*
                if(response.exito){
                    alert(response.message)
                }
                */
                },
                error:function(error){
                     console.log(error)
                }

            })
        })
    })


    //$va= mostrarM();
    function enviarM(){
        ConfirmDemo();
        document.getElementById("enviar").disabled = false;
        document.getElementById("conservar").disabled = true;
       
       console.log("deshabilihando conservar")
    }

    function conservarM(){
        document.getElementById("conservar").disabled = false;
        document.getElementById("enviar").disabled = true;
       console.log("deshibilitando enviar")
    }


    function controlNombre() {
       // var nombreLabel = document.getElementById("idLabelNombre");
       console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
        var nombreInput = document.getElementById("materia");
        var regexABC = new RegExp("^[a-zA-Zs]{3,30}");
        //&& nombreInput.value.length<4
       // if (!regexABC.test(nombreInput.value)) 
        //nombreLabel.style.color = "red";
       // else nombreLabel.style.color = "green";
      }

       //codigo para combletar campos automaticamnete
    function pru(rowcount){
        console.log("valor del rowcount el pru")
        console.log(rowcount)
        //rowcount=rowcount-1;
        $(document).ready(function(){
            console.log('test');
            
            $.ajax({
                type:'get',
                url:'{!!URL::to('findCustomers')!!}',
                success:function(response){
                    console.log('FindCostumers')
                    console.log(response);
                   
                //material css
                //convert array to object
    
                var custArray = response;
                var dataCust = {};
                var dataCust2 = {};
    
                for(var i=0; i<custArray.length ; i++ )
                {
                    dataCust[custArray[i].materia] =null;
                    dataCust2[custArray[i].materia] =
                    custArray[i];
                }
    
                for(var i=0; i<custArray.length ; i++ )
                {
                    dataCust[custArray[i].grupo] =null;
                    dataCust2[custArray[i].grupo] =
                    custArray[i];
                }
    
                //console.log("dataCust2");
                //console.log(dataCust2);
              
             
    
                $('input#materia_'+rowcount).autocomplete({
    
                    // console.log(rowcount);
     
                     data: dataCust,
                     onAutocomplete:function(reqdata)
                     {
                       //  console.log(reqdata);
                      // console.log(rowcount);
                       //rowcount++;
                       console.log("fila de inicio")
                        
                         $('#grupo_'+rowcount).val(dataCust2[reqdata]['grupo'])
                         $('#hora_'+rowcount).val(dataCust2[reqdata]['hora']);
                     }
                 });
                 
                 
                $('input#grupo_'+rowcount).autocomplete({
    
                    // console.log(rowcount);
     
                     data: dataCust,
                     onAutocomplete:function(reqdata)
                     {
                       //  console.log(reqdata);
                      // console.log(rowcount);
                       //rowcount++;
                       console.log("fila de inicio")
                        
                         $('#materia_'+rowcount).val(dataCust2[reqdata]['materia'])
                         $('#hora_'+rowcount).val(dataCust2[reqdata]['hora']);
                     }
                 }); 
                 
    
            
                //end  
                
                
    
                }
              
            }) 
    
    
    
        });
    }


      
    
    

</script>



<script type="text/javascript">

    //codigo para combletar campos automaticamnete
    //probando para autocompletar fila 2
    $(document).ready(function(){
        console.log('entrando a fila 2 trantando de completar');
        
        $.ajax({
            type:'get',
            url:'{!!URL::to('findCustomer')!!}',
            success:function(response){
                console.log('FindCostumers 22222')
                console.log(response);
               
            //material css
            //convert array to object

            var custArray = response;
            var dataCust = {};
            var dataCust2 = {};

            for(var i=0; i<custArray.length ; i++ )
            {
                dataCust[custArray[i].materia] =null;
                dataCust2[custArray[i].materia] =
                custArray[i];
            }

            for(var i=0; i<custArray.length ; i++ )
            {
                dataCust[custArray[i].grupo] =null;
                dataCust2[custArray[i].grupo] =
                custArray[i];
            }

            //console.log("dataCust2");
            //console.log(dataCust2);
          
         

            $('input#materia_1').autocomplete({

                // console.log(rowcount);
 
                 data: dataCust,
                 onAutocomplete:function(reqdata)
                 {
                   //  console.log(reqdata);
                  // console.log(rowcount);
                   //rowcount++;
                   console.log("fila de inicio")
                    
                     $('#grupo_1').val(dataCust2[reqdata]['grupo'])
                     $('#hora_1').val(dataCust2[reqdata]['hora']);
                 }
             });
             
             
            $('input#grupo_1').autocomplete({

                // console.log(rowcount);
 
                 data: dataCust,
                 onAutocomplete:function(reqdata)
                 {
                   //  console.log(reqdata);
                  // console.log(rowcount);
                   //rowcount++;
                   console.log("fila de inicio")
                    
                     $('#materia_1').val(dataCust2[reqdata]['materia'])
                     $('#hora_1').val(dataCust2[reqdata]['hora']);
                 }
             }); 
             

        
            //end  
            
            

            }
          
        }) 



    });


    //codigo 2
  
</script>

@endsection
