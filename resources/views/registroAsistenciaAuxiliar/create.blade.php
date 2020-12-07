@extends('layouts.app')

@section('content')

<form action="{{url('/registroAsistenciaAuxiliar')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
   <h3 class="text-center">FORMULARIO REGISTRO CONTROL DE ASISTENCIA</h3> 
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
        #grabacion{
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
        <label for="Contenido"class="control-label">{{'Contenido de Clase'}}</label>
        <input type="text" class="form-control  {{$errors->has('contenido')?'is-invalid':'' }}" name="contenido" id="contenido" 
        value="{{ isset($registro->contenido)?$registro->contenido:old('contenido') }}"
        >
        {!!  $errors->first('contenido','<div class="invalid-feedback">:message</div>') !!}
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
        <label for="Plataforma"class="control-label">{{'Plataforma o Medio Utilizado'}}</label>
        <input type="text" class="form-control  {{$errors->has('plataforma')?'is-invalid':'' }}" name="plataforma" id="plataforma" 
        value="{{ isset($registro->plataforma)?$registro->plataforma:old('plataforma') }}"
        >
        {!!  $errors->first('plataforma','<div class="invalid-feedback">:message</div>') !!}
    </div>

                   
    
</div>
<div class="row">
    <div class="col-5">
        <label for="Grupo"class="control-label">{{'Grupo'}}</label>
        <input type="text" class="form-control  {{$errors->has('grupo')?'is-invalid':'' }}" name="grupo" id="grupo" 
        value="{{ isset($registro->grupo)?$registro->grupo:old('grupo') }}"
        >
        {!!  $errors->first('grupo','<div class="invalid-feedback">:message</div>') !!}
    </div>
    
    <div class="col-5">
        <label for="Observaciones"class="control-label">{{'Observaciones'}}</label>
        <input type="text" class="form-control  {{$errors->has('observacion')?'is-invalid':'' }}" name="observacion" id="observacion" 
        value="{{ isset($registro->observacion)?$registro->observacion:old('observacion') }}"
        >
        {!!  $errors->first('observacion','<div class="invalid-feedback">:message</div>') !!}
    </div>
       
</div>
<div class="row">
    <div class="col-5">
        <label for="Materia"class="control-label">{{'Materia'}}</label>
        <input type="text" class="form-control  {{$errors->has('materia')?'is-invalid':'' }}" name="materia" id="materia" 
        value="{{ isset($registro->materia)?$registro->materia:old('materia')  }}"
        >
        {!!  $errors->first('materia','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-5">
        <label for="Firma"class="control-label">{{'Firma'}}</label>
        <br>
        
        <input type="file" accept="image/*" class="form-control  {{$errors->has('firma')?'is-invalid':'' }}" name="firma" id="firma" 
        value="{{ isset($registro->firma)?$registro->firma:old('firma') }}"
        >
        
        {!!  $errors->first('firma','<div class="invalid-feedback">:message</div>') !!}
    </div>


</div>  
<div class="row">
    <div class="col-5">
        <label for="Grabacion"class="control-label">{{'Grabacion'}}</label>
        <br>
        <input type="file"  accept="video/*" class="form-control  {{$errors->has('grabacion')?'is-invalid':'' }}" name="grabacion" id="grabacion" 
        value="{{ isset($registro->grabacion)?$registro->grabacion:old('grabacion') }}"
        >
        {!!  $errors->first('grabacion','<div class="invalid-feedback">:message</div>') !!}
    </div>


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


@endsection