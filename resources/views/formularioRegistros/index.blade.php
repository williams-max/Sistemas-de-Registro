@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-md-10 mx-auto ">
        <h5>UNIVERSIDAD MAYOR DE SAN SIMON</h5>
        @foreach ($registro2 as $registro2)
            <h5>FACULTAD:{{$registro2->facultad}}</h5>
        @endforeach

        <h5>CARRERA:{{$registro2->carrera}}</h5>
        <br>
        <h4 class="text-center">FORMULARIO DE CONTROL DE ASISTENCIA</h4>
        <BR>
        <BR>
            <div class="row">
                <div class="col-5">
                    <h5>DOCENTE:{{$registro2->nombre}}  {{$registro2->apellido}}</h5>
                </div>
                <div class="col-5">
                    <h5>MES:</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <h5>CODIGOSIS:{{$registro2->codigoSis}}</h5>
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-5">
                            <h5>DEL:</h5>
                        </div>
                        <div class="col-5">
                            <h5>AL:</h5>
                        </div>
                    </div>
                </div>
            </div>


        <a href="{{url('registroAsistencia/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>

            <table class="table table-hover">

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
                        <th scope="col"></th>
                        <th style="text-align: center"><a href="#" class="btn btn-info addRow">+</a></th>


                    </tr>
                </thead>
               <tbody>
                   <!--
                    @foreach ($registro as $registro)
    <tr>
        <td>{{$registro->fecha}}</td>
        <td>{{$registro->hora}}</td>
        <td>{{$registro->grupo}}</td>
        <td>{{$registro->materia}}</td>
        <td>{{$registro->contenido}}</td>
        <td>{{$registro->plataforma}}</td>
        <td>{{$registro->observaciones}}</td>
        <td>{{$registro->firma}}</td>

        <td>
            {{$registro->name}}
        </td>
        <td>
            @can('haveaccess','registroAsistencia.destroy')
            <form method="post" action="{{url('/registroAsistencia/'.$registro->id)}}" style="display:inline">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Registro?');" class="btn btn-danger float-right">Borrar</button>
            </form>
            @endcan

            @can('haveaccess','registroAsistencia.edit')
            <a href="{{url('/registroAsistencia/'.$registro->id.'/edit')}}" class="btn btn-warning float-right">
                Editar
            </a>
            @endcan
        </td>

      </tr>

    @endforeach  -->

    <tr>

        <td><input type="date" class="form-control" name="fecha[]" ></td>
        <td><input type="text" class="form-control " name="contenido[]"</td>
        <td><input type="time" class="form-control " name="hora[]"></td>
        <td><input type="text" class="form-control  " name="plataforma[]"></td>
        <td> <input type="text" class="form-control " name="grupo[]" </td>
        <td><input type="text" class="form-control" name="observacion[]"> </td>
        <td><input type="text" class="form-control" name="materia[]" ></td>
        <td><input type="text" class="form-control" name="firma[]"></td>

        <th style="text-align: center"><a href="#" class="btn btn-danger remove">-</a></th>
    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.addRow').on('click',function(){
        addRow();
    });

    function addRow()
    {
        //alert('test');

       var tr =  '<tr>'+

        '<td><input type="date" class="form-control" name="fecha[]" ></td>'+
        '<td><input type="text" class="form-control " name="contenido[]"</td>'+
        '<td><input type="time" class="form-control " name="hora[]"></td>'+
        '<td><input type="text" class="form-control  " name="plataforma[]"></td>'+
        '<td> <input type="text" class="form-control " name="grupo[]" </td>'+
        '<td><input type="text" class="form-control" name="observacion[]"> </td>'+
        '<td><input type="text" class="form-control" name="materia[]" ></td>'+
        '<td><input type="text" class="form-control" name="firma[]"></td>'+

        '<th style="text-align: center"><a href="#" class="btn btn-danger remove">-</a></th>'+

        '</tr>';

        $('tbody').append(tr);

        $('tbody').on('click','.remove',function(){
            $(this).parent().parent().remove();
        });

    }


</script>

@endsection
