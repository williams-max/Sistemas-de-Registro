@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto ">
            <h2>Unidad
                @can('haveaccess','registrarUFC/registrarUnidad')
                <a href="{{url('registrarUFC/registrarUnidad')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
                @endcan 
            </h2>

            <table class="table table-hover" border="2" bordercolor="#008000" >
                
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Unidad</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unidad as $unidads)
                <tr>
                    <td>{{$unidads->nombre}}</td>
                    <td>
                        
                        <form method="post" action="{{url('/registrarUFC/eliminarUnidad/'.$unidads->id)}}" style="display:inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Usuario?');" class="btn btn-danger float-right">Borrar</button>
                        </form> 
                        
                        <a href="{{url('/registrarUFC/'.$unidads->id.'/editarUnidad')}}" class="btn btn-warning float-right">
                            Editar
                        </a>
                    </td>
                
                </tr>
        
                    @endforeach    
                    
                </tbody>
            </table>
            {{$unidad->links()}}
        </div>
        
    </div>
  

</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto ">
            <h2>Facultad
                @can('haveaccess','registrarUFC/registrarFacultad')
                <a href="{{url('registrarUFC/registrarFacultad')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
                @endcan 
            </h2>

            <table class="table table-hover" border="2" bordercolor="#008000" >
                
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Facultad</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facultad as $facultads)
                <tr>
                    <td>{{$facultads->nombre}}</td>
                    <td>
                        
                        <form method="post" action="{{url('/registrarUFC/eliminarFacultad/'.$facultads->id)}}" style="display:inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Usuario?');" class="btn btn-danger float-right">Borrar</button>
                        </form> 
                        
                        <a href="{{url('/registrarUFC/'.$facultads->id.'/editarFacultad')}}" class="btn btn-warning float-right">
                            Editar
                        </a>
                    </td>
                
                </tr>
        
                    @endforeach    
                    
                </tbody>
            </table>
            {{$facultad->links()}}
        </div>
    </div>
    

</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto ">
            <h2>Carrera
                @can('haveaccess','registrarUFC/registrarCarrera')
                <a href="{{url('registrarUFC/registrarCarrera')}}" class="btn btn-success float-right" ><i class="fas fa-plus"></i></a>
                @endcan 
            </h2>

            <table class="table table-hover" border="2" bordercolor="#008000">
                
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Carrera</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrera as $carreras)
                <tr>
                    <td>{{$carreras->nombre}}</td>
                    <td>
                        
                        <form method="post" action="{{url('/registrarUFC/eliminarCarrera/'.$carreras->id)}}" style="display:inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Usuario?');" class="btn btn-danger float-right">Borrar</button>
                        </form> 
                        
                        <a href="{{url('/registrarUFC/'.$carreras->id.'/editarCarrera')}}" class="btn btn-warning float-right">
                            Editar
                        </a>
                    </td>
                
                </tr>
        
                    @endforeach    
                    
                </tbody>
            </table>
            {{$carrera->links()}}
        </div>
    </div>
    

</div>
@endsection