@extends('layouts.app')

@section('content')

<form action="{{url('/registrarUFC/registrarCarrera')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
    <div class="col-md-11 mx-auto ">
    <h3 class="d-flex justify-content-center">FORMULARIO REGISTRO DE CARRERA</h3>
<BR></BR>
<div class="row">
    <div class="col-5">

        <label for="Nombre" class="control-label">{{'Nombre'}}</label>
        <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
        value="{{ isset($carrera->nombre)?$carrera->nombre:old('nombre') }}"
        >
        {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
        <br>

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
            <label for="Correo"class="control-label">{{'Correo'}}</label>
            <input type="correo" class="form-control  {{$errors->has('correo')?'is-invalid':'' }}" name="correo" id="correo" 
            value="{{ isset($carrera->email)?$carrera->email:old('email')  }}"
            >
        {!!  $errors->first('correo','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Telefono"class="control-label">{{'Telefono'}}</label>
            <input type="number" class="form-control  {{$errors->has('telefono')?'is-invalid':'' }}" name="telefono" id="telefono" 
            value="{{ isset($carrera->telefono)?$carrera->telefono:old('telefono')  }}"
            >
            {!!  $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}
        </div>
</div>
<BR></BR>
<div class="row">
    
    <div class="col-5 ">  
        <a href="{{url('registrarUFC')}}"class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-5 ">       
        <input type="submit" class="btn btn-success " value="Guardar">
    </div>
</div>
</div>
</form>

@endsection