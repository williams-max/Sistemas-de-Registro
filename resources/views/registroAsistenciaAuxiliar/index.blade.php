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

            <table class="table table-hover" >

                <thead class="thead-light">
                    <tr>
                        <th scope="col"><p>Fecha</p></th>
                        <th scope="col"><p>Hora</p></th>
                        <th scope="col"><p>Grupo</p></th>
                        <th scope="col"><p>Materia</p></th>
                        <th scope="col">Contenido <p>de Clase</p> </th>
                        <th scope="col">Plataforma o <p> Medio Utilizado</p></th>
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
        <td >{{$registro->ruta_grabacion}}</td>

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
    <SCRIPT languaje="JavaScript">
        function pulsar() {
        alert("El Formulario Se envio Con Exito");
        }
        </SCRIPT>
                </tbody>
            </table>
            <a onclick="pulsar()" href="{{url('/registroAsistenciaAuxiliar/enviar/'.$registro2->id)}}" class="btn btn-primary float-right" >Enviar</a>
        </div>
    </div>
</div>

@endsection 
