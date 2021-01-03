@extends('layouts.app')

@section('content')
 @php
 function hola($valor) {

  $valor = explode(":", $valor);
  //dd($valor);
 //$valor = explode("", $valor);
//dd(($valor[0]+1).":".($valor[1]+30).":".$valor[2]);
  return ($valor[0]+1).":".($valor[1]).":".$valor[2];
  //return "565665";
}
 @endphp 

<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">



<style>
    .container {
      background: #e0e0e0;
      margin: 0 0 1rem;
      height: 10rem;
      display: flex;
      /* align-items por defecto tiene el valor `stretch` */
      align-items: start;
    }
    .center-h {
      justify-content: center;
    }
    .center-v {
      align-items: center;
    }
    .child {
      background: #60e0b0;
      padding: .2rem;
    }
    </style>

<div class="container">
    <div class="row">
        <div class="col-md-13 mx-auto " id="myDiv">
            <h6>UNIVERSIDAD MAYOR DE SAN SIMON</h6>
            <h6>Facultad de Ciencias y Tecnologia </h6>
            <h6>Centro de Procesamiento de Datos</h6>
          
            <h5 align="center">FORMULARIO RESUMEN DE FALTAS A CLASES VIRTUALES  </h5>

            <form action="{{url('/resumen/vista')}}" id="contactResum" class="form-horizontal" method="get" enctype="multipart/form-data">
            <div class="container center-h center-v" >
                <div class="formulario__grupo  " id="grupo__fecha">
                    <div class="formulario__grupo-input">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <label for="Fecha" class="control-label">{{'Del'}}</label>
                 
                <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
                value="{{old('fecha', $fechaini)}}"
                >
               {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error"> El este campo solo permite fechas del 
             <br>   DEL: 2020-12-07       AL: 2020-12-21
            </p>
        </div>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <div class="formulario__grupo  " id="grupo__fecha1">
            <div class="formulario__grupo-input">
        <label for="Fecha" class="control-label">{{'Al'}}</label>
        <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha1" id="fecha1" 
        value="{{old('fecha1', $fechafin)}}"
        >
       {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
       <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
    <p class="formulario__input-error"> El este campo solo permite fechas del 
     <br>   DEL: 2020-12-07       AL: 2020-12-21
    </p>
    
</div>
            
     
&nbsp;&nbsp;&nbsp;

<div>

  <h1></h1>
  &nbsp;&nbsp;
  <br>
      <input type="submit"  class="btn btn-success " value="Actualizar" 
      style="height:40px; width:90px">

</div>
                  
              
            


            
            </div> 
          </form>

            <table class="table">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">FECHA</th>
                        <th scope="col">SIS DOCENTE</th>
                        <th scope="col">NOMBRE DEL DOCENTE  </th>
                        <th scope="col">SIS MATERIA </th>
                        <th scope="col">NOMBRE DE LA MATERIA </th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Dia </th>
                        <th scope="col">HORA INICIO</th>
                        <th scope="col">HORA FIN</th>
                        <th scope="col">FALTA</th>
               
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repos as $repos)
                    
                    <tr>
                        <td>{{$repos->fecha}}</td>
                        <td>{{$repos->codigoSis}}</td>
                        <td>{{$repos->nombre ,$repos->apellido}}</td>
                        <td>{{$repos->id+8}}</td>
                        <td>{{$repos->materia}}</td>
                        <td>{{$repos->grupo}}</td>
                        <td>{{$repos->dia}}</td>
                        <td>{{$repos->hora}}</td>
                        <td>{{ hola($repos->hora)}}</td>
                        <td>
                         
                          </td>

                        
 

                        
                      </tr>
                      
                        
                    @endforeach  
                    
                </tbody>
                
            </table>
            @if ($repos==[])
            <a onclick="nopuede()"   class="btn btn-primary float-left" >Enviar</a>
            @else
            <form id="myform"  action="{{url('/resumen/vista')}}" method="GET" onsubmit="return ConfirmDemo();">
                @csrf
             
                <button  class="btn btn-primary float-left">Enviar</button>
              </form>
             @endif
  

        </div>
    </div>
</div>



<script src="{{ asset('dist/js/resumenvalidationfechares.js') }} "></script>
<script type="text/javascript">

 

  formulario.addEventListener('submit', (e) => {
  
       console.log("eventos de sumbits");
       
       console.log(campos.fecha);
       console.log(campos.fecha1);
       
       if( campos.fecha && campos.fecha1 ){
      //     alert("Enviando... ");
           
           //return true;
       }else{
           alert("Los campos de las fechas estan incorrectas ... por favor intente nuevamente");
           e.preventDefault();
        //   return false;
         //  e.preventDefault();
       }
      // console.log(e.target);
   });
  </script>
<script type="text/javascript">
    function pulsar() {
        alert("El Formulario Se envio Con Exito");
        }
        function nopuede() {
            alert("No puede Enviar el Formulario por que esta vacio");
        }
        
        var valor=0;  
        function ConfirmDemo() {
          //Ingresamos un mensaje a mostrar
          var formulario = document.getElementById("myform");
          var mensaje = confirm("Esta formulario se Enviara a la UTI \n .¿Estas Seguro que deseas enviar ?");
          //Detectamos si el usuario acepto el mensaje
          if (mensaje) {
            valor=1;
          alert("¡Gracias por aceptar!");
                 if (valor==1) {
                  //alert("Enviando el formulario");
                  formulario.submit();
                  return true;
                 } else {
                   alert("Error al Eliminar el Formulario");
                 return false;
          }
       
          }
          //Detectamos si el usuario denegó el mensaje
          else {
          alert("¡operacion Denegada!");
            return false;
       
           }
          }
      
    
        
</script>

    
@endsection