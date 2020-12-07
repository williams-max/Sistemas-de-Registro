@extends('layouts.app')
 
@section('content')
   
    <form action="{{url('/personalAcademico')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

        {{ csrf_field()}}
       <h3 class="text-center">FORMULARIO REGISTRO DE PERSONAL</h3> 

       <div class="col-md-11 mx-auto ">
        

    <div class="row">
        <div class="col-5">

            <label for="Nombre" class="control-label">{{'Nombre'}}</label>
            <input type="text" class="form-control  {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
            value="{{ isset($personal->nombre)?$personal->nombre:old('nombre') }}"
            >
            {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
           

        </div> 
        <div class="col-5">
            <label for="Correo"class="control-label">{{'Correo'}}</label>
            <input type="email" class="form-control  {{$errors->has('email')?'is-invalid':'' }}" name="email" id="email" 
            value="{{ isset($personal->email)?$personal->email:old('email')  }}"
            >
        {!!  $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
        </div>
       
    </div>
    <div class="row">
        <div class="col-5">
            <label for="Apellido"class="control-label">{{'Apellido'}}</label>
            <input type="text" class="form-control  {{$errors->has('apellido')?'is-invalid':'' }}" name="apellido" id="apellido" 
            value="{{ isset($personal->apellido)?$personal->apellido:old('apellido') }}"
            >
            {!!  $errors->first('apellido','<div class="invalid-feedback">:message</div>') !!}
        </div>
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
                       
        
    </div>
    <div class="row">
        <div class="col-5">
            <label for="CodigoSis"class="control-label">{{'Codigo sis'}}</label>
            <input type="text" class="form-control  {{$errors->has('codigoSis')?'is-invalid':'' }}" name="codigoSis" id="codigoSis" 
            value="{{ isset($personal->codigoSis)?$personal->codigoSis:old('codigoSis') }}"
            >
            {!!  $errors->first('codigoSis','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Unidad">Unidad</label>
            <select name="unidad" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}">
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
            <label for="Telefono"class="control-label">{{'Telefono'}}</label>
            <input type="number" class="form-control  {{$errors->has('telefono')?'is-invalid':'' }}" name="telefono" id="telefono" 
            value="{{ isset($personal->telefono)?$personal->telefono:old('telefono')  }}"
            >
            {!!  $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="col-5">
            <label for="Facultad">Facultad</label>
            <select name="facultad" class="form-control  {{$errors->has('facultad')?'is-invalid':'' }}">
            <option selected disabled>Elige una Facultad para este Usuario</option>
            @foreach ($facultad as $facultad)
                <option value="{{$facultad->id}}">{{$facultad->nombre}}</option>
            @endforeach
            </select>
            {!!  $errors->first('facultad','<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>  
    <div class="row">
        <div class="col-5">
                <label for="Contraseña"class="control-label">{{'Contraseña'}}</label>
                <input type="text" class="form-control  {{$errors->has('password')?'is-invalid':'' }}" name="password" id="password" 
                value="{{ isset($personal->password)?$personal->password:old('password') }}"
                >
                {!!  $errors->first('password','<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col-5">
                <label for="Carrera">Carrera</label>
                <select name="carrera" class="form-control  {{$errors->has('carrera')?'is-invalid':'' }}">
                <option selected disabled>Elige una Carrera para este Usuario</option>
                @foreach ($carrera as $carrera)
                    <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                @endforeach
                </select>
                {!!  $errors->first('carrera','<div class="invalid-feedback">:message</div>') !!}
            </div>
    </div>  
    <label></label>

    <div class="row">
        <div class="col-5">       
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>
        <div class="col-5">  
            <a href="{{url('personalAcademico')}}"class="btn btn-primary">Regresar</a>
        </div>
    </div>
    </div>
    </form>


@endsection