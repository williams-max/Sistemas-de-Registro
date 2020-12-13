@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto ">
        <h2>Autoridades Academicas
            <a href="{{url('autoAcademicas/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
        </h2>

            <table class="table table-hover">

                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cargo</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                   @foreach ($autoridads as $autoridad)
                  
                   
            <tr>
                <td>
                    {{$autoridad->nombre}} {{$autoridad->apellido}}
                </td>
                <td>
                    {{$autoridad->names}}
                </td>
                <td>
                    <?php $id = DB::table('auto_academicas')->select('id')->where('id_user','=',$autoridad->userid)->first(); 
                    ?>

                    <form method="post" action="{{ route('autoAcademicas.destroy',$id->id)}}" style="display:inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar esta Autoridad?');" class="btn btn-danger float-right">Borrar</button>
                    </form> 

                    <a class="btn btn-warning float-right" href="{{ route('autoAcademicas.edit',$id->id)}}" >
                        Editar</a>
                </td>

      </tr>


                </tbody>

    @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
