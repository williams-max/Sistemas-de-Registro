@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto ">
        <h2>Personal Academico
            <a href="{{url('personalAcademico/create')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
        </h2>

            <table class="table table-hover">
                
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Cargo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($personal as $personal)
    <tr>
        <td>{{$personal->nombre}}</td>
        <td>{{$personal->apellido}}</td>
        <td> 
            {{$personal->name}}
        </td>
        <td>
            
            <form method="post" action="{{url('/personalAcademico/'.$personal->id)}}" style="display:inline">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Usuario?');" class="btn btn-danger float-right">Borrar</button>
            </form> 
            
            <a href="{{url('/personalAcademico/'.$personal->id.'/edit')}}" class="btn btn-warning float-right">
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