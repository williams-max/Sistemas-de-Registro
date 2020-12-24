@extends('layouts.app')

@section('content')
<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">

<link href="{{ asset('css/estilorepo.css')}}" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-13 mx-auto " id="myDiv">
            <h5 align="center">Reportes(Docentes y auxiliares)</h5>

            <div class="row">
                <div class="formulario__grupo  " id="grupo__fecha">
                    <div class="formulario__grupo-input">
                <label for="Fecha" class="control-label">{{'Del'}}</label>
                <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
                value="{{ isset($registro->fecha)?$registro->fecha:old('fecha') }}"
                >
               {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error"> El este campo solo permite fechas del 
             <br>   DEL: 2020-12-07       AL: 2020-12-21
            </p>
        </div>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <div class="formulario__grupo  " id="grupo__fecha">
            <div class="formulario__grupo-input">
        <label for="Fecha" class="control-label">{{'Al'}}</label>
        <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
        value="{{ isset($registro->fecha)?$registro->fecha:old('fecha') }}"
        >
       {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
       <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
    <p class="formulario__input-error"> El este campo solo permite fechas del 
     <br>   DEL: 2020-12-07       AL: 2020-12-21
    </p>
</div>
            
            </div> 
        <h2>Personal Academico
            
        </h2>

            <table class="table table-hover">
                
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Unidad   </th>
                        <th scope="col">Facultad </th>
                        <th scope="col">Gestión </th>
                        <th scope="col">total de horas <br> pagables mensual <br> por persona</th>
                        <th scope="col">total de horas <br> pagables por <br> departamento/mes </th>
                        <th scope="col">total de horas <br> no pagables por <br>departamento/mes</th>
                        <th scope="col">  </th>
                     
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repos as $repos)
                    
                    <tr>
                        <td>{{$repos->nombre}}</td>
                        <td>{{$repos->apellido}}</td>
                        <td>{{$repos->unidad}}</td>
                        <td>{{$repos->falculdad}}</td>
                        <td>{{2020}}</td>
                        <td>{{15000}}</td>
                        <td>{{14}}</td>
                        <td>{{20}}</td>
                        <td>
                            @can('haveaccess','personalAcademico.destroy')
                            <form method="post" action="{{url('/personalAcademico/'.$repos->nombre)}}" style="display:inline">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('¿Esta seguro de Eliminar este Usuario?');" class="fas fa-plus"></button>
                            </form> 
                            @endcan 
                            
                            
                        </td>
                      
                      </tr>
                        
                    @endforeach  
                    
                </tbody>
                
            </table>
          

  

        </div>
    </div>
</div>
    
@endsection