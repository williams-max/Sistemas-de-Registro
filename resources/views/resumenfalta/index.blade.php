@extends('layouts.app')

@section('content')
 @php
 use Carbon\Carbon;
 function hola($valor) {

  $valor = explode(":", $valor);
  //dd($valor);
 //$valor = explode("", $valor);
//dd(($valor[0]+1).":".($valor[1]+30).":".$valor[2]);
  return ($valor[0]+1).":".($valor[1]).":".$valor[2];
  //return "565665";
}

function devolverDia($f) {

 // $dia = Carbon\Carbon::now();
 // $f = Carbon::now();
 // $f = explode("-", $f);
 $f = explode("-", $f);

 //2021-01-14
 return $date = Carbon::createFromDate($f[0],$f[1],$f[2])->isoFormat('dddd');

 //return $f->isoFormat('dddd');
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
                        <td>{{$repos->id}}</td>
                        <td>{{$repos->materia}}</td>
                        <td>{{$repos->grupo}}</td>
                        <td>{{devolverDia($repos->fecha)}}</td>
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
      
      var f=valores.fecha;
      console.log("Primera fecha");
      var parts = f.split("-");
       console.log(parts);
       var day = parseInt(parts[2]);
       var month = parseInt(parts[1]);
       var year = parseInt(parts[0]);

       console.log(day);
       console.log(month);
       console.log(year);

       var f1=valores.fecha1;
       console.log("Segunda fecha");
       var parts1 = f1.split("-");
        console.log(parts1);
        var day1 = parseInt(parts1[2]);
        var month1 = parseInt(parts1[1]);
        var year1 = parseInt(parts1[0]);

       

       console.log(day1);
       console.log(month1);
       console.log(year1);

       if(year >= year1 && month >= month1 && day>=day1){
        alert("Fecha solapada ... por favor intente nuevamente"); 
          return    e.preventDefault();
        //   if(day >= day1){
         //    alert("Fecha solapada ... por favor intente nuevamente");   
          // }
       }
            if(year >= year1 && day>=day1){
             alert("Fecha solapada ... por favor intente nuevamente"); 
          return  e.preventDefault();
             //   if(day >= day1){
              //    alert("Fecha solapada ... por favor intente nuevamente");   
               // }
            }else{
             // e.preventDefault();
            }
           
       
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