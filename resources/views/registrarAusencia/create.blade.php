@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">

<form action="{{url('/registroAsistenciaAuxiliar/registrarAusencia')}}" id="contactForm"  class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
   <h3 class="text-center">FORMULARIO REGISTRO DE REPOSICION</h3> 
<BR></BR>
<div class="col-md-12 mx-auto " >
    <style>
        .cuadrado{
        padding:5px;
        margin:5px;
        background-color: #43a3fdb2;
        border: solid 1px rgb(255, 255, 255);
        color: white;
        }

        #firma{
            background: rgb(161, 161, 250);
            color: aliceblue
        }
        </style>

<div class="row">
    <div class="col-5">

        <label for="Fecha" class="control-label">{{'Fecha'}}</label>
        <input type="date" class="form-control  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
        value="{{ isset($registro->fecha)?$registro->fecha:old('fecha') }}"
        >
       {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
    
    </div> 
    <div class="col-5">

        <label for="Fecha_Reposicion" class="control-label">{{'Fecha Reposicion'}}</label>
        <input type="date" class="form-control  {{$errors->has('dia_reposicion')?'is-invalid':'' }}" name="dia_reposicion" id="dia_reposicion" 
        value="{{ isset($registro->dia_reposicion)?$registro->dia_reposicion:old('dia_reposicion') }}"
        >
       {!!  $errors->first('dia_reposicion','<div class="invalid-feedback">:message</div>') !!}
    
    </div> 
    
   
</div>
<div class="row">

    <div class="col-5">
        <label for="Hora"class="control-label">{{'Hora'}}</label>
        <input type="time"  class="form-control  {{$errors->has('hora')?'is-invalid':'' }}" name="hora" id="hora" 
        value="{{ isset($registro->hora)?$registro->hora:old('hora')  }}"
        >
    {!!  $errors->first('hora','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5">
        <label for="Hora Reposicion"class="control-label">{{'Hora Reposicion'}}</label>
        <input type="time"  class="form-control  {{$errors->has('hora_reposicion')?'is-invalid':'' }}" name="hora_reposicion" id="hora_reposicion" 
        value="{{ isset($registro->hora_reposicion)?$registro->hora_reposicion:old('hora_reposicion')  }}"
        >
    {!!  $errors->first('hora_reposicion','<div class="invalid-feedback">:message</div>') !!}
    </div>


                   
    
</div>
<div class="row">
    
    <div class="col-5">
        <label for="Materia">Materia</label>
        <select name="materia" id="materia" class="form-control  {{$errors->has('materia')?'is-invalid':'' }}">
        <option selected disabled>Seleccione una Materia</option>
        @foreach ($materia as $materia)
            <option value="{{$materia->id}}">{{$materia->materia}}</option>
        @endforeach
        </select>
        {!!  $errors->first('materia','<div class="invalid-feedback">:message</div>') !!}
    </div>
    
    <div class="col-5">
        <div class="formulario__grupo  " id="grupo__observacion">
            <div class="formulario__grupo-input">
            <label for="Motivo"class="control-label">{{'Motivo'}}</label>
          <input type="text" class="formulario__input   {{$errors->has('motivo')?'is-invalid':'' }}" name="motivo" id="motivo" 
          value="{{ isset($registro->motivo)?$registro->motivo:old('motivo') }}"
          >
          <i class="formulario__validacion-estado fas fa-times-circle"></i>
         </div>
       <p class="formulario__input-error"> El este campo solo permerite palabras </p>
       </div>
        {!!  $errors->first('motivo','<div class="invalid-feedback">:message</div>') !!}
    </div>
       
</div>
<div class="row">
    <div class="col-5">
        <label for="Grupo">Grupo</label>
        <select name="grupo" id="grupo" class="form-control  {{$errors->has('grupo')?'is-invalid':'' }}">
        
        </select>
        {!!  $errors->first('grupo','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5">
        <label for="Firma"class="control-label">{{'Firma'}}</label>
        <br>
        
        <input type="file" accept="image/*" class="form-control  {{$errors->has('firma')?'is-invalid':'' }}" name="firma" id="firma" 
        value="{{ isset($registro->firma)?$registro->firma:old('firma') }}"
        >
        
        {!!  $errors->first('firma','<div class="invalid-feedback">:message</div>') !!}
    </div>

    <script>
        $("#materia").change(event => {
            $.get(`envio/${event.target.value}`, function(res, sta){
                $("#grupo").empty();
                res.forEach(element => {
                    $("#grupo").append(`<option value=${element.id}> ${element.grupo} </option>`);
                });
            });
        });

    </script>
</div>  

<label></label>

<div class="row">
   
    <div class="col-5">  
        <a href="{{url('registroAsistenciaAuxiliar')}}"class="btn btn-primary">Regresar</a>
    </div> 
    <div class="col-5 ">       
        <input type="submit" class="btn btn-success float-right" value="Guardar">
    </div>
</div>
</div>
</form>

<script src="{{ asset('dist/js/formulario.js') }} "></script>
@endsection