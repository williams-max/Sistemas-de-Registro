@extends('layouts.app')

@section('content')

<form action="{{url('/registrarUFC/editarFacultad/'. $facultad->id)}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}
    {{method_field('PATCH')}}

<div class="col-md-11 mx-auto ">
<h3 class="d-flex justify-content-center">EDITAR FORMULARIO DE FACULTAD</h3>
<BR></BR>
<div class="row">
    <div class="col-5">

        <label for="Nombre" class="control-label">{{'Nombre'}}</label>
        <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
        value="{{ isset($facultad->nombre)?$facultad->nombre:old('nombre') }}"
        >
        {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
        <br>

    </div> 
    <div class="col-5">
        <label for="Unidad">Unidad</label>
        <select name="unidad" class="form-control">
        <option selected disabled>Seleccione una Unidad</option>
        @foreach ($unidad as $unidads)
            @if ($unidads->nombre ==  $nombres->nombre)
            <option value="{{$unidads->id}}" selected>{{$unidads->nombre}}</option>
            @else
            <option value="{{$unidads->id}}">{{$unidads->nombre}}</option>
            @endif
        @endforeach
        </select>
    </div>
</div>
<div class="row">
          
    <div class="col-5">
            <label for="Correo"class="control-label">{{'Correo'}}</label>
            <input type="correo" class="form-control  {{$errors->has('correo')?'is-invalid':'' }}" name="correo" id="correo" 
            value="{{ isset($facultad->correo)?$facultad->correo:old('correo')  }}"
            >
        {!!  $errors->first('correo','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Telefono"class="control-label">{{'Telefono'}}</label>
            <input type="number" class="form-control  {{$errors->has('telefono')?'is-invalid':'' }}" name="telefono" id="telefono" 
            value="{{ isset($facultad->telefono)?$facultad->telefono:old('telefono')  }}"
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