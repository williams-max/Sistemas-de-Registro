@extends('layouts.app')

@section('content')

<form action="{{url('/autoAcademicas')}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}

    <div class="col-md-11 mx-auto ">
        <h3>FORMULARIO</h3>


    <div class="row">

        <div class="col-5">
            <label for="Docente">Docente</label>
            <select name="docente" class="form-control  {{$errors->has('docente')?'is-invalid':'' }}">
            <option selected disabled>Elige a un Docente</option>

            @foreach ($personal as $personal)

                <option value="{{$personal->id}}" >{{$personal->nombre}} {{$personal->apellido}}</option>

            @endforeach
            </select>
            {!!  $errors->first('docente','<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="col-5">
            <label for="Direccion"class="control-label">{{'Dirección'}}</label>
            <input type="text" class="form-control  {{$errors->has('direccion')?'is-invalid':'' }}" name="direccion" id="direccion"
            value="{{ isset($autoridad->direccion)?$autoridad->direccion:old('direccion') }}"
            >
            {!!  $errors->first('direccion','<div class="invalid-feedback">:message</div>') !!}
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
            <label for="Grado"class="control-label">{{'Grado'}}</label>
            <input type="text" class="form-control  {{$errors->has('grado')?'is-invalid':'' }}" name="grado" id="grado"
            value="{{ isset($autoridad->grado)?$autoridad->grado:old('grado') }}"
            >
            {!!  $errors->first('grado','<div class="invalid-feedback">:message</div>') !!}
        </div>

</div>

<label></label>

<div class="row">
    <div class="col-5">
        <input type="submit" class="btn btn-success" value="Guardar">
    </div>
    <div class="col-5">
        <a href="{{url('autoAcademicas')}}"class="btn btn-primary">Regresar</a>
    </div>
</div>
</div>
</form>
@endsection

