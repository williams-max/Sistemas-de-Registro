@extends('layouts.app')

@section('content')
@php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

   function dinero(){
    return mt_rand(100,160);
   } 
   function horaspagables(){
    return mt_rand(100,120);
   } 
   function horasnopagables(){
    return mt_rand(10,20);
   } 
   function pagablesMensual($id){

    //DISTINCT 
    $contar=
    DB::select("
    select count(*) as cantidadMaterias
    from registrar_materias
    where id_personal=$id");

     $cantidadMaterias=0;
        foreach ($contar as $contar) {
            $cantidadMaterias=$contar->cantidadMaterias;
        }
      
     return $cantidadMaterias*4;
   }
@endphp
<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">



<div class="container">
    <div class="row">
        <div class="col-md-13 mx-auto " id="myDiv">
            <h5 align="center">Reportes Docentes </h5>
            
            <form action="{{url('/reportes/vista')}}" id="contactResum" class="form-horizontal" method="get" enctype="multipart/form-data">
            <div class="row">
               
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
               
                <div class="formulario__grupo  " id="grupo__fecha">
                    <div class="formulario__grupo-input">
                <label for="Fecha" class="control-label">{{'Del'}}</label>
                <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
                value="{{old('fecha', $fechaini)}}"
                >
               {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
               <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error"> El este campo solo permite fechas del 
             <br>   DEL: 2020-12-07       AL: 2020-12-21
            </p>
        </div>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <div class="formulario__grupo  " id="grupo__fecha1">
            <div class="formulario__grupo-input">
           <label for="Fecha" class="control-label">{{'Al'}}</label>
           <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha1" id="fecha1" 
           value="{{old('fecha1', $fechafin)}}"
          >
          {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
           <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
         <p class="formulario__input-error"> El este campo solo permite fechas del 
         <br>   DEL: 2020-12-07       AL: 2020-12-21
        </p>
         </div>
         
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit"  class="btn btn-success " value="Actualizar" 
                style='width:90px; height:30px;text-align: center'>
            
            </div> 
        </form>

            <table class="table">
                
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Unidad   </th>
                        <th scope="col">Facultad </th>
                        <th scope="col">Gestión </th>
                        <th scope="col">total de horas <br> pagables mensual <br> por persona</th>
                        <th scope="col">total de horas <br> pagables por <br> departamento/mes </th>
                        <th scope="col">total de horas <br> no pagables por <br>departamento/mes</th>
                        
                     
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
                        <td>{{pagablesMensual($repos->id)}}</td>
                        <td>{{horaspagables()}}</td>
                        <td>{{horasnopagables()}}</td>
                        <td>
                           
                            
                            
                        </td>
                      
                      </tr>
                        
                    @endforeach  
                    
                </tbody>
                
            </table>
          

  

        </div>
    </div>
</div>

<script src="{{ asset('dist/js/resumenvalidationfechares.js') }} "></script>
    
@endsection