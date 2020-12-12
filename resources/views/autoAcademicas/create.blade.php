@extends('layouts.app')

@section('content')

<form action="{{url('/autoAcademicas')}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}

    <div class="col-md-11 mx-auto ">
        <h3>FORMULARIO</h3>


    <div class="row">

        <div class="col-5">
            <label for="Personal">Personal</label>
           <select name="rol" id="rol" class="form-control  {{$errors->has('rol')?'is-invalid':'' }}">
                <option selected disabled>Seleccione Tipo de Personal</option>
                @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
                </select>
                {!!  $errors->first('rol','<div class="invalid-feedback">:message</div>') !!}
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
            <label for="Personal"></label>
           <select name="personal" id="personal" class="form-control  {{$errors->has('personal')?'is-invalid':'' }}">
                <option selected disabled>Seleccione al Personal</option>
               
                </select>
                {!!  $errors->first('personal','<div class="invalid-feedback">:message</div>') !!}
        </div>



        <div class="col-5">
            <label for="Grado"class="control-label">{{'Grado'}}</label>
            <input type="text" class="form-control  {{$errors->has('grado')?'is-invalid':'' }}" name="grado" id="grado"
            value="{{ isset($autoridad->grado)?$autoridad->grado:old('grado') }}"
            >
            {!!  $errors->first('grado','<div class="invalid-feedback">:message</div>') !!}
        </div>

</div>
 <div class="row">
    <div class="col-5">
        <label for="Cargo">Autoridad</label>
       <select name="cargo" id="cargo" class="form-control  {{$errors->has('cargo')?'is-invalid':'' }}">
            <option selected disabled>Elige un rol para este Usuario</option>
            @foreach ($cargo as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
            </select>
            {!!  $errors->first('cargo','<div class="invalid-feedback">:message</div>') !!}
    </div>

<script>
    $("#rol").change(event => {
        $.get(`envio/${event.target.value}`, function(res, sta){
            $("#personal").empty();
            res.forEach(element => {
                $("#personal").append(`<option value=${element.id}> ${element.nombre} ${element.apellido} </option>`);
            });
        });
    });
</script>

        

</div>

<label></label>

<div class="row">
    <div class="col-5">
        <a href="{{url('autoAcademicas')}}"class="btn btn-primary">Regresar</a>
    </div>
    <div class="col-5">
        <input type="submit" class="btn btn-success" value="Guardar">
    </div>
    
</div>
</div>
</form>
@endsection

