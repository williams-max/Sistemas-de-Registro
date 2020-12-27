
@extends('layouts.app')

@section('content')
<link href="{{asset('css/style.css')}}">

<form action="{{url('/registroAsistenciaDocente/registrarAusencia/' . $registro->id)}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}
    {{method_field('PATCH')}}

    <h3 class="text-center">EDITAR FORMULARIO REGISTRO DE AUSENCIA</h3> 
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
        
                <label for="Fecha Reposicion" class="control-label">{{'Fecha Reposicion'}}</label>
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
                <label for="Grupo"class="control-label">{{'Grupo'}}</label>
                <input type="text" class="form-control  {{$errors->has('grupo')?'is-invalid':'' }}" name="grupo" id="grupo" 
                value="{{ isset($registro->grupo)?$registro->grupo:old('grupo') }}"
                >
                {!!  $errors->first('grupo','<div class="invalid-feedback">:message</div>') !!}
            </div>
            
            <div class="col-5">
                <label for="Motivo"class="control-label">{{'Motivo'}}</label>
                <input type="text" class="form-control  {{$errors->has('motivo')?'is-invalid':'' }}" name="motivo" id="motivo" 
                value="{{ isset($registro->motivo)?$registro->motivo:old('motivo') }}"
                >
                {!!  $errors->first('motivo','<div class="invalid-feedback">:message</div>') !!}
            </div>
               
        </div>
        <div class="row">
            <div class="col-5">
                <label for="Materia"class="control-label">{{'Materia'}}</label>
                <input disabled type="text" class="form-control  {{$errors->has('materia')?'is-invalid':'' }}" name="materia" id="materia" 
                value="{{ isset($registro->materia)?$registro->materia:old('materia')  }}"
                >
                {!!  $errors->first('materia','<div class="invalid-feedback">:message</div>') !!}
            </div>
           
            <div class="col-5">
                
                <label for="Firma"class="control-label">{{'Firma'}}</label>
                
                <br>
                
                 @if ($registro->firma != "")
                 <img src="{{asset('storage').'/'.$registro->firma}}" alt=""  width="100">
                   
                @endif
    <br>
                <label for="firma" >
                    <div class="cuadrado">Subir Archivo</div>
                </label>
                <input type="file" style='display: none;' accept="image/*" style="width:165px" value="" class="form-control  {{$errors->has('firma')?'is-invalid':'' }}" name="firma" id="firma" 
                value="{{ isset($registro->firma)?$registro->firma:old('firma') }}"
                >
                {!!  $errors->first('firma','<div class="invalid-feedback">:message</div>') !!}
             
        
        </div> 
        
            
    </div>
<label></label>

<div class="row">
 
    <div class="col-5">  
        <a href="{{url('registroAsistenciaAuxiliar')}}"class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-5">       
        <input type="submit" class="btn btn-success float-right" value="Guardar">
    </div>
</div>

</div>


</form>

@endsection
