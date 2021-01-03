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
   function horasnopagables($id){
  //  registrar_ausencia_docentes
    $contar=
    DB::select("
    select count(*) as totalAdescontar
    from registrar_ausencia_docentes
    where id_personal=$id");

   // dd($contar);
    $totalAdescontar=0;
    foreach ($contar as $contar) {
        $totalAdescontar=$contar->totalAdescontar;
    }
  
 return $totalAdescontar;
   // return mt_rand(10,20);
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
      
     return $cantidadMaterias*4-horasnopagables($id);
    
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
         
        &nbsp;&nbsp;&nbsp;&nbsp;
        <div>
            <h1></h1>
           <br>
                <input type="submit"  class="btn btn-success " value="Actualizar" 
                style="height:40px; width:90px">

        </div>
        
            
            </div> 
            <br>
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
                        <td>{{horasnopagables($repos->id)}}</td>
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
<script type="text/javascript">

 
//dsfsdfsdfsdasdasdsdfsdfsdfsdfsdfsdfsdfsdfsdfsdfdsdsfsdfsdfsdf
    formulario.addEventListener('submit', (e) => {
    
         console.log("eventos de sumbits");
        
         console.log(campos.fecha);
         console.log(campos.fecha1);
         
         if( campos.fecha && campos.fecha1 ){
        //     alert("Enviando... ");
        
        var f=valores.fecha;
        console.log("Primera fecha");
        var parts = f.split("-");
         console.log(parts);
         var day = parseInt(parts[2]);
         var month = parseInt(parts[1]);
         var year = parseInt(parts[0]);
  
         console.log(day);
         console.log(month);
         console.log(year);
  
         var f1=valores.fecha1;
         console.log("Segunda fecha");
         var parts1 = f1.split("-");
          console.log(parts1);
          var day1 = parseInt(parts1[2]);
          var month1 = parseInt(parts1[1]);
          var year1 = parseInt(parts1[0]);
  
         
  
         console.log(day1);
         console.log(month1);
         console.log(year1);
  
         if(year >= year1 && month >= month1){
          alert("Fecha solapada ... por favor intente nuevamente"); 
            return    e.preventDefault();
          //   if(day >= day1){
           //    alert("Fecha solapada ... por favor intente nuevamente");   
            // }
         }
              if(year >= year1 ){
               alert("Fecha solapada ... por favor intente nuevamente"); 
            return  e.preventDefault();
               //   if(day >= day1){
                //    alert("Fecha solapada ... por favor intente nuevamente");   
                 // }
              }else{
               // e.preventDefault();
              }
             
         
             //return true;
         }else{
             alert("Los campos de las fechas estan incorrectas ... por favor intente nuevamente");
             e.preventDefault();
          //   return false;
           //  e.preventDefault();
         }
        // console.log(e.target);
     });
    </script>
    
@endsection