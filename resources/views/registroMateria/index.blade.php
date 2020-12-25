@extends('layouts.app')

@section('content')

<div class="container" >

    <h2 class="text-center">ASIGNAR MATERIA</h2>
   
    <div  class="col-md-8 mx-auto" >
            <a href="{{url('registroMateria/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Personal Asignado</th>
                    <th>Materia</th>
                    <th>Grupo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personal as $personal)
                    
                
                <tr>
                    <td>
                        {{$personal->nombre}} {{$personal->apellido}}
                    </td>
                    <td>
                        {{$personal->materia}}
                    </td>
                    <td>
                        {{$personal->grupo}}
                    </td>
                    <td>
                        <form method="post" action="{{url('/registroMateria/'.$personal->id)}}" style="display:inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Registro?');" class="btn btn-danger float-right btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form> 
            
                        <a href="{{url('/registroMateria/'.$personal->id.'/edit')}}" class="btn btn-warning float-right btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    </div>



@endsection
