@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-md-13 mx-auto ">
        <h5>UNIVERSIDAD MAYOR DE SAN SIMON</h5>
        
        @foreach ($registro2 as $registro2)
        @endforeach
        @foreach ($dia2 as $dia2)
        @endforeach
        <h5>FACULTAD: {{$registro2->facultad}}</h5>

        <h5>CARRERA: {{$registro2->carrera}}</h5>
        <br>
        <h4 class="text-center">FORMULARIO DE CONTROL DE ASISTENCIA AUXILIAR</h4>
        <BR>
        <BR>
            <div class="row">
                <div class="col-5">
                    <h5>AUXILIAR: {{$registro2->nombre}} {{$registro2->apellido}}</h5>
                </div> 
                <div class="col-5">
                    <h5>DEL: {{$dia2->fecha_inicio}}</h5>
                </div> 
            </div>
            <div class="row">
                <div class="col-5">
                    <h5>CODIGOSIS: {{$registro2->codigoSis}}</h5> 
                </div> 
                <div class="col-5">
                    <h5>AL: {{$dia2->fecha_entrega}}</h5>
                </div> 
            </div>


        <a href="{{url('registroAsistenciaAuxiliar/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
        <a href="{{url('registroAsistenciaAuxiliar/registrarAusencia/create')}}" class="btn btn-secondary float-right" >Registrar Reposicion</a>

            <table class="table table-hover" >

                <thead class="thead-light">
                    <tr>
                        <th scope="col"><p>Fecha</p></th>
                        <th scope="col"><p>Hora</p></th>
                        <th scope="col"><p>Grupo</p></th>
                        <th scope="col"><p>Materia</p></th>
                        <th scope="col">Contenido <p>de Clase</p> </th>
                        <th scope="col">Plataforma<p>o Medio Utilizado</p></th>
                        <th scope="col"><p>Observaciones</p></th>
                        <th scope="col"><p>Firma</p></th>
                        <th scope="col"><p>Grabacion</p></th>
                        <th scope="col"></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($registro as $registro)
    <tr>
        <td WIDTH="106" HEIGHT="50">{{$registro->fecha}}</td>
        <td WIDTH="70" HEIGHT="50">{{$registro->hora}}</td>
        <td WIDTH="70" HEIGHT="50">{{$registro->grupo}}</td>
        <td WIDTH="50" HEIGHT="50">{{$registro->materia}}</td>
        <td WIDTH="50" HEIGHT="50">{{$registro->contenido}}</td>
        <td WIDTH="130" HEIGHT="50">{{$registro->plataforma}}</td>
        <td WIDTH="50" HEIGHT="50">{{$registro->observacion}}</td>
        <td >{{$registro->ruta_firma}}</td>
        <td >{{$registro->grabacion}}</td>

        <td>
            <form method="post" action="{{url('/registroAsistenciaAuxiliar/'.$registro->id)}}" style="display:inline">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Registro?');" class="btn btn-danger float-right btn-sm"><i class="fas fa-trash-alt"></i></button>
            </form> 

            <a href="{{url('/registroAsistenciaAuxiliar/'.$registro->id.'/edit')}}" class="btn btn-warning float-right btn-sm">
                <i class="fas fa-edit"></i>
            </a>
        </td>

      </tr>
    @endforeach     
                </tbody>
                
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"><p>Fecha</p></th>
                            <th scope="col"><p>Hora</p></th>
                            <th scope="col"><p>Grupo</p></th>
                            <th scope="col"><p>Materia</p></th>
                            <th scope="col">Dia<p>Reposicion</p></th>
                            <th scope="col">hora<p>Reposicion</p></th>
                            <th scope="col"><p>Motivo</p></th>
                            <th scope="col"><p>Firma</p></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registroAusencia as $registro)
                        <tr>
                            <td WIDTH="106" HEIGHT="50">{{$registro->fecha}}</td>
                            <td WIDTH="70" HEIGHT="50">{{$registro->hora}}</td>
                            <td WIDTH="70" HEIGHT="50">{{$registro->grupo}}</td>
                            <td WIDTH="50" HEIGHT="50">{{$registro->materia}}</td>
                            <td WIDTH="50" HEIGHT="50">{{$registro->dia_reposicion}}</td>
                            <td WIDTH="130" HEIGHT="50">{{$registro->hora_reposicion}}</td>
                            <td WIDTH="50" HEIGHT="50">{{$registro->motivo}}</td>
                            <td >{{$registro->ruta_firma}}</td>
                            <td>
                                <form method="post" action="{{url('/registroAsistenciaAuxiliar/registrarAusencia/'.$registro->id)}}" style="display:inline">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Registro?');" class="btn btn-danger float-right btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form> 
                    
                                <a href="{{url('/registroAsistenciaAuxiliar/registrarAusencia/'.$registro->id.'/edit')}}" class="btn btn-warning float-right btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>

            @if ($registro=="[]")
            <a onclick="nopuede()"  class="btn btn-primary float-right" >Enviar</a>
            @else
            <form id="myform"  action="{{url('/registroAsistenciaAuxiliar/enviar/'.$registro2->id)}}" method="GET" onsubmit="return ConfirmDemo();">
                @csrf
             
                <button  class="btn btn-primary float-right">Enviar</button>
              </form>
            <!-- <a onclick="pulsar()" href="{{url('/registroAsistenciaAuxiliar/enviar/'.$registro2->id)}}" class="btn btn-primary float-right" >Enviar</a> -->  
            @endif
            
        </div>
    </div>
    
</div>

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
          var mensaje = confirm("¿Estas Seguro que Deseas Enviar?");
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
