@extends('layouts.app')
 
@section('content')
   
    <form action="{{url('/personalAcademico/importarCSV')}}" id="contactPer" class="form-horizontal "  method="post" enctype="multipart/form-data">

        {{ csrf_field()}}
       <h3 class="text-center">FORMULARIO REGISTRO DE PERSONAL</h3> 

       <div class="col-md-11 mx-auto ">
        
        <style>
            .cuadrado{
            padding:5px;
            margin:5px;
            background-color: #43a3fdb2;
            border: solid 1px rgb(255, 255, 255);
            color: white;
            }
    
            #file{
                background: rgb(161, 161, 250);
                color: aliceblue
            }
            #fir{
                background: rgb(161, 161, 250);
                color: aliceblue
            }
            </style>
    
    <div class="row">
        <div class="col-5">
            <label for="Archvio">Archivo CSV</label><br>
            <input type="file" name="file" class="form-control {{$errors->has('file')?'is-invalid':'' }}" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file" >
            {!!  $errors->first('file','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Unidad">Unidad</label>
            <select name="unidad" id="unidad" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}">
            <option selected disabled>Elige una Unidad para este Usuario</option>
            @foreach ($unidad as $unidad)
                <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
            @endforeach
            </select>
            {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
        </div>
                       
        
    </div>
    <div class="row">
        
        <div class="col-5">
            <h5>
            <p class="p-1 bg-white text-secondary">El Archivo CSV debe tener el siguiente formado <br>|nombre|apellido|codigo sis|correo|telefono|</p>
        </h5>
        </div>
        <div class="col-5">
            <label for="Facultad">Facultad</label>
            <select name="facultad" id="facultad" class="form-control  {{$errors->has('facultad')?'is-invalid':'' }}">
                 
            </select>
            {!!  $errors->first('facultad','<div class="invalid-feedback">:message</div>') !!}
        </div>
           
    </div>
    <div class="row">
        <div class="col-5">
            <label for="Cargo">Cargo</label>
            <select name="rol" class="form-control  {{$errors->has('rol')?'is-invalid':'' }}">
            <option selected disabled>Elige un rol para este Usuario</option>
            @foreach ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
            </select>
            {!!  $errors->first('rol','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Carrera">Carrera</label>
                <select name="carrera" id="carrera" class="form-control  {{$errors->has('carrera')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('carrera','<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>  
    <div class="row">
        <div class="col-5">
            
            </div>
         

            <div class="col-5">
                 
            </div>
    </div>  

    <script>
        $("#unidad").change(event => {
            $.get(`envio/${event.target.value}`, function(res, sta){
                $("#facultad").empty();
                $("#carrera").empty();
                $("#facultad").append(`<option > Elige una Facultad para este Usuario </option>`);
                res.forEach(element => {
                    $("#facultad").append(`<option value=${element.id}> ${element.nombre} </option>`);
                });
            });
        });

    </script>

    <script>
        $("#facultad").change(event => {
            $.get(`envio2/${event.target.value}`, function(res, sta){
                $("#carrera").empty();
                $("#carrera").append(`<option > Elige una Carrera para este Usuario </option>`);
                res.forEach(element => {
                    $("#carrera").append(`<option value=${element.id}> ${element.nombre} </option>`);
                });
            });
        });
    </script>
    <label></label>

    <div class="row">
        
        <div class="col-5">  
            <a href="{{url('personalAcademico')}}"class="btn btn-primary">Regresar</a>
        </div>
        <div class="col-5">       
            <input type="submit" class="btn btn-success float-right" value="Guardar">
        </div>
    </div>
    </div>
    </form>
    
    
    


@endsection