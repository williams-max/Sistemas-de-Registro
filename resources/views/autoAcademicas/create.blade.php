@extends('layouts.app')

@section('content')

<form action="{{url('/autoAcademicas')}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}

    <div class="col-md-11 mx-auto ">
        <h3 class="text-center">FORMULARIO REGISTRO DE AUTORIDADES ACADEMICAS</h3>


    <div class="row">

        <div class="col-5">
            <label for="Unidad">Personal</label>
           <select name="unidad" id="unidad" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}">
                <option selected disabled>Seleccione una Unidad</option>
                @foreach ($unidad as $unidad)
                    <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                @endforeach
                </select>
                {!!  $errors->first('unidad','<div class="invalid-feedback">:message</div>') !!}
            
        </div>

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
        


    </div>
    <div class="row">
        <div class="col-5">
            <label for="Facultad"></label>
           <select name="facultad" id="facultad" class="form-control  {{$errors->has('facultad')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('facultad','<div class="invalid-feedback">:message</div>') !!}
        </div>


        <div class="col-5">
            <label for="Direccion"class="control-label">{{'Dirección'}}</label>
            <input type="text" class="form-control  {{$errors->has('direccion')?'is-invalid':'' }}" name="direccion" id="direccion"
            value="{{ isset($autoridad->direccion)?$autoridad->direccion:old('direccion') }}"
             oninvalid="setCustomValidity('Este campo solo permite letras puntos y numeros ')"
             onchange="try{setCustomValidity('')}catch(e){}"
            >
            {!!  $errors->first('direccion','<div class="invalid-feedback">:message</div>') !!}
        </div>
       
    </div>

    <div class="row">
   
        <div class="col-5">
            <label for="Carrera"></label>
        <select name="carrera" id="carrera" class="form-control  {{$errors->has('carrera')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('carrera','<div class="invalid-feedback">:message</div>') !!}
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
            <label for="rol"></label>
           <select name="rol" id="rol" class="form-control  {{$errors->has('rol')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('rol','<div class="invalid-feedback">:message</div>') !!}
        </div>
    
    </div>  
    <div class="row">
        <div class="col-5">
            <label for="personal"></label>
        <select name="personal" id="personal" class="form-control  {{$errors->has('personal')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('personal','<div class="invalid-feedback">:message</div>') !!}
        </div>
            
        <script>
            $("#unidad").change(event => {
                $.get(`envio/${event.target.value}`, function(res, sta){
                    $("#facultad").empty();
                    $("#carrera").empty();
                    $("#rol").empty();
                    $("#personal").empty();
                    $("#facultad").append(`<option > Seleccione una Facultad </option>`);
                    res.forEach(element => {
                        $("#facultad").append(`<option value=${element.id}> ${element.nombre} </option>`);
                    });
                });
            });
        
            $("#facultad").change(event => {
                $.get(`envio2/${event.target.value}`, function(res, sta){
                    $("#carrera").empty();
                    $("#rol").empty();
                    $("#personal").empty();
                    $("#carrera").append(`<option > Seleccione una Carrera </option>`);
                    res.forEach(element => {
                        $("#carrera").append(`<option value=${element.id}> ${element.nombre} </option>`);
                    });
                });
            });
    
            $("#carrera").change(event => {
                $.get(`envio3/${event.target.value}`, function(res, sta){
                    $("#rol").empty();
                    $("#personal").empty();
                    $("#rol").append(`<option > Seleccione Tipo de Personal </option>`);
                    res.forEach(element => {
                        $("#rol").append(`<option value=${element.id}> ${element.name} </option>`);
                    });
                });
            });
    
           
    
        </script>
        <script> 

            var dato;
            
            var select = document.getElementById('carrera');
            select.addEventListener('change',
            function(){
            var selectedOption = this.options[select.selectedIndex];
            //console.log(selectedOption.value + ': ' + selectedOption.text);
            dato=selectedOption.value;
             } ); 
             
    
            $("#rol").change(event => {
                $.get(`envio4/${event.target.value}/${dato}`, function(res, sta){
                    $("#personal").empty();
                    $("#personal").append(`<option > Seleccione una Persona </option>`);
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
        <input type="submit" class="btn btn-primary " value="Guardar">
    </div>
    <div class="col-5">
        <a href="{{url('autoAcademicas')}}"class="btn btn-secondary float-right">Regresar</a>
    </div>
    
    
</div>
</div>
</form>
@endsection

