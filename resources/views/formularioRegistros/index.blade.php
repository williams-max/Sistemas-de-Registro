@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto ">
        <h2>Formulario de Registros

            <a href="{{url('formularioRegistros/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>

        </h2>

            <table class="table table-hover">

                <thead class="thead-light">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Contenido de Clase</th>
                        <th scope="col">Plataforma o Medio Utilizado</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">  </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formularioRegistros as $formularioRegistro)
    <tr>
        <td>{{$formularioRegistro->fecha}}</td>
        <td>{{$formularioRegistro->hora}}</td>
        <td>{{$formularioRegistro->grupo}}</td>
        <td>{{$formularioRegistro->materia}}</td>
        <td>{{$formularioRegistro->contenido}}</td>
        <td>{{$formularioRegistro->plataforma}}</td>
        <td>{{$formularioRegistro->observaciones}}</td>
        <td>

            <form method="post" action="{{url('/formularioRegistros/'.$formularioRegistro->id)}}" style="display:inline">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('¿Esta seguro que desea Eliminar?');" class="btn btn-danger float-right">Borrar</button>
            </form>
            @include('formularioRegistros.edit')
            <a href="{{url('/formularioRegistros/'.$formularioRegistro->id.'/edit')}}" class="btn btn-warning float-right">
                Editar
            </a>
        </td>

      </tr>

    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
