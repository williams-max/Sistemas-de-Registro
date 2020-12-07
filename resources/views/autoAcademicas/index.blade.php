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
                       <!-- <th scope="col">Rol</th>-->
                        <th scope="col">Docente</th>
                       <!-- <th scope="col">Datos</th>-->
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                   @foreach ($personal as $personal)
                   @foreach ($autoridads as $autoridad)
    <tr>


        <td>
        @if($personal->repetidos==1)
        <td>
           
            {{$personal->nombre}} {{$personal->apellido}}
     


           </td>
         {{$personal->repetidos =0}}
         {{$personal->save()}}
          <td><a class="btn btn-success" href="{{ route('autoAcademicas.edit',$autoridad->id)}}">
                               Editar</a></td>
                             <td>
                               <form action="{{ route('autoAcademicas.destroy',$autoridad->id)}}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button class="btn btn-danger">Eliminar</button>
                               </form>
        @endif
        </td>

      </tr>

    @endforeach
    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
