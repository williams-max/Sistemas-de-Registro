@extends('layouts.app')

@section('content')

<link href="{{ asset('css/estilos.css')}}" rel="stylesheet">

<form action="{{url('/registrarUFC/registrarCarrera')}}" id="contactCarr"  class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
    <div class="col-md-11 mx-auto ">
    <h3 class="d-flex justify-content-center">FORMULARIO REGISTRO DE CARRERA</h3>
<BR></BR>
<div class="row">
    <div class="col-5">
        <div class="formulario__grupo  " id="grupo__nombre">
            <div class="formulario__grupo-input">

        <label for="Nombre" class="control-label">{{'Nombre'}}</label>
        <input type="text" class="formulario__input  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
        value="{{ isset($carrera->nombre)?$carrera->nombre:old('nombre') }}"
        >
        {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
        <br>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
    <p class="formulario__input-error"> El este campo solo permerite palabras  </p>
</div>

    </div> 
    <div class="col-5">
        <label for="Facultad">Facultad</label>
        <select name="facultad" class="form-control  {{$errors->has('facultad')?'is-invalid':'' }}">
        <option selected disabled>Seleccione una Facultad</option>
        @foreach ($facultad as $facultads)
            <option value="{{$facultads->id}}">{{$facultads->nombre}}</option>
        @endforeach
        </select>
        {!!  $errors->first('facultad','<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="row">
          
    <div class="col-5">
        <div class="formulario__grupo  " id="grupo__correo">
            <div class="formulario__grupo-input">
            <label for="Correo"class="control-label">{{'Correo'}}</label>
            <input type="correo" class="formulario__input  {{$errors->has('correo')?'is-invalid':'' }}" name="correo" id="correo" 
            value="{{ isset($carrera->email)?$carrera->email:old('email')  }}"
            >
        {!!  $errors->first('correo','<div class="invalid-feedback">:message</div>') !!}
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
    <p class="formulario__input-error"> el formato del correo no es correcto 
        <br> ejemplo : example.gmail.com
       </p>
</div>
        </div>
        <div class="col-5">
            <div class="formulario__grupo  " id="grupo__telefono">
                <div class="formulario__grupo-input">
            <label for="Telefono"class="control-label">{{'Telefono'}}</label>
            <input type="number" class="formulario__input  {{$errors->has('telefono')?'is-invalid':'' }}" name="telefono" id="telefono" 
            value="{{ isset($personal->telefono)?$personal->telefono:old('telefono')  }}"
            >
            {!!  $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
        <p class="formulario__input-error"> El este campo solo permite tener números de 7 a 14 digitos postivos
      
        </p>
    </div>
        </div>
</div>
<BR></BR>
<div class="row">
    <div class="col-5 ">       
        <input type="submit" class="btn btn-primary " value="Guardar">
    </div>
    <div class="col-5 ">  
        <a href="{{url('registrarUFC')}}"class="btn btn-secondary float-right">Regresar</a>
    </div>
    
</div>
</div>
</form>
<script src="{{ asset('dist/js/validacionesCarrera.js') }} "></script>
<script type="text/javascript">
formulario.addEventListener('submit', (e) => {
    // e.preventDefault();
    // console.log(e.isTrusted);
 // console.log(campos.contenido);
     console.log("eventos de sumbits");
    
     
     if( campos.nombre && campos.correo && campos.telefono ){
         alert("Se guardo Correctamente... ");
         
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