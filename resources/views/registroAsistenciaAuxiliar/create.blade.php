@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">

<form action="{{url('/registroAsistenciaAuxiliar')}}" id="contactForm"  class="form-horizontal" method="post" enctype="multipart/form-data">

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
        </style>

<div class="row">
    <div class="col-5">
        <div class="formulario__grupo  " id="grupo__fecha">
            <div class="formulario__grupo-input">
        <label for="Fecha" class="control-label">{{'Fecha'}}</label>
        <input type="date" class="formulario__input  {{$errors->has('fecha')?'is-invalid':'' }}" name="fecha" id="fecha" 
        value="{{ isset($registro->fecha)?$registro->fecha:old('fecha') }}"
        >
       {!!  $errors->first('fecha','<div class="invalid-feedback">:message</div>') !!}
       <i class="formulario__validacion-estado fas fa-times-circle"></i>
       </div>
      <p class="formulario__input-error"> El este campo solo permite fechas del 
     <br>   DEL: 2021-01-11       AL: 2021-01-25
      </p>
   </div>
    
    </div> 
    <div class="col-5">
        <div class="formulario__grupo  " id="grupo__contenido">
            <div class="formulario__grupo-input">
              <label for="Contenido"class="control-label">{{'Contenido de Clase'}}</label>
              <input type="text" class="formulario__input   {{$errors->has('contenido')?'is-invalid':'' }}" name="contenido" id="contenido" 
              value="{{ isset($registro->contenido)?$registro->contenido:old('contenido') }}"
              >
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error"> El este campo solo permerite palabras , comas y puntos </p>
        </div>

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
        <div class="formulario__grupo  " id="grupo__plataforma">
            <div class="formulario__grupo-input">
           <label for="Plataforma"class="control-label">{{'Plataforma o Medio Utilizado'}}</label>
           <input type="text" class="formulario__input   {{$errors->has('plataforma')?'is-invalid':'' }}" name="plataforma" id="plataforma" 
           value="{{ isset($registro->plataforma)?$registro->plataforma:old('plataforma') }}"
           >
          <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
       <p class="formulario__input-error"> El este campo solo permerite palabras </p>
        </div>
        {!!  $errors->first('plataforma','<div class="invalid-feedback">:message</div>') !!}
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
            <label for="Observaciones"class="control-label">{{'Observaciones'}}</label>
          <input type="text" class="formulario__input   {{$errors->has('observacion')?'is-invalid':'' }}" name="observacion" id="observacion" 
          value="{{ isset($registro->observacion)?$registro->observacion:old('observacion') }}"
          >
          <i class="formulario__validacion-estado fas fa-times-circle"></i>
         </div>
       <p class="formulario__input-error"> El este campo solo permerite palabras,comas y puntos  </p>
       </div>
        {!!  $errors->first('observacion','<div class="invalid-feedback">:message</div>') !!}
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


</div>  
<div class="row">
    <div class="col-5">
        <label for="Grabacion"class="control-label">{{'Grabacion'}}</label>
        <input type="text" class="form-control  {{$errors->has('grabacion')?'is-invalid':'' }}" name="grabacion" id="grabacion" 
        value="{{ isset($registro->grabacion)?$registro->grabacion:old('grabacion')  }}"
        placeholder="Link de clase grabada"
        >
        {!!  $errors->first('grabacion','<div class="invalid-feedback">:message</div>') !!}
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
   <div class="col-5 ">       
        <input type="submit" class="btn btn-primary" value="Guardar">
    </div>
    <div class="col-5">  
        <a href="{{url('registroAsistenciaAuxiliar')}}"class="btn btn-secondary float-right">Regresar</a>
    </div> 
    
</div>
</div>
</form>

<script src="{{ asset('dist/js/formulario.js') }} "></script>
<script type="text/javascript">
    formulario.addEventListener('submit', (e) => {
        // e.preventDefault();
        // console.log(e.isTrusted);
     // console.log(campos.contenido);
         console.log("eventos de sumbits");
         console.log(campos.contenido);
         console.log(campos.observacion);
         console.log(campos.fecha);
         console.log(campos.plataforma);
         
         if(campos.contenido && campos.fecha && campos.plataforma && campos.observacion){
           //  alert("Se guardo Correctamente... ");
             
             //return true;
         }else{
             alert("Por favor complete los campos correctamente");
             e.preventDefault();
          //   return false;
           //  e.preventDefault();
         }
        // console.log(e.target);
     });
    </script>
@endsection