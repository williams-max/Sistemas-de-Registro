@extends('layouts.app')
 
@section('content')
<style>
    .input-group {
      /*  width: 30%;*/
       /* margin: 0 auto;*/
      /*  margin-top: 50px;*/
    }
    span {
        cursor: pointer;
    }
</style>


<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
   
    <form action="{{url('/personalAcademico')}}" id="contactPer" class="form-horizontal "  method="post" enctype="multipart/form-data">

        {{ csrf_field()}}
       <h3 class="text-center">FORMULARIO REGISTRO DE PERSONAL</h3> 

       <div class="col-md-11 mx-auto ">
        

    <div class="row">
        <div class="col-5">
      
              <label for="Nombre" class="control-label">{{'Nombre'}}</label>
            <input type="text" class="form-control     {{$errors->has('nombre')?'is-invalid':'' }}" name="nombre" id="nombre" 
            value="{{ isset($personal->nombre)?$personal->nombre:old('nombre') }}"
            
            >
            {!!  $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
       

        </div> 
        <div class="col-5">
          
            <label for="Correo"class="control-label">{{'Correo'}}</label>
            <input type="email" class="form-control      {{$errors->has('email')?'is-invalid':'' }}" name="email" id="email" 
            value="{{ isset($personal->email)?$personal->email:old('email')  }}"
            >
        {!!  $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
      

        </div>
       
    </div>
    <div class="row">
        <div class="col-5">
          
            <label for="Apellido"class="control-label">{{'Apellido'}}</label>
            <input type="text" class="form-control   {{$errors->has('apellido')?'is-invalid':'' }}" name="apellido" id="apellido" 
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
           required="" 
           pattern="\d{9}"
            oninvalid="setCustomValidity('Este campo solo permite numeros de 9 digitos ')"
            onchange="try{setCustomValidity('')}catch(e){}"
            >
            {!!  $errors->first('codigoSis','<div class="invalid-feedback">:message</div>') !!}
          
        </div>
        <div class="col-5">
            <label for="Unidad">Unidad</label>
            <select name="unidad" id="unidad" class="form-control  {{$errors->has('unidad')?'is-invalid':'' }}">
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
            <input type="number" class="form-control   {{$errors->has('telefono')?'is-invalid':'' }}" name="telefono" id="telefono" 
            value="{{ isset($personal->telefono)?$personal->telefono:old('telefono')  }}"
            required="" 
            pattern="\d{7,14}"
             oninvalid="setCustomValidity('Este campo solo permite numeros de 7 a 14 digitos ')"
             onchange="try{setCustomValidity('')}catch(e){}"
            >
            {!!  $errors->first('telefono','<div class="invalid-feedback">:message</div>') !!}
         
        </div>
        <div class="col-5">
            <label for="Facultad">Facultad</label>
            <select name="facultad" id="facultad" class="form-control  {{$errors->has('facultad')?'is-invalid':'' }}">
                 
            </select>
            {!!  $errors->first('facultad','<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>  
    <div class="row">
        <div class="col-5">
            
                <label for="Contraseña"class="control-label">{{'Contraseña'}}</label>
                <div class="input-group">
                <input type="password" class="form-control  {{$errors->has('password')?'is-invalid':'' }}" name="password" id="password" 
                value="{{ isset($personal->password)?$personal->password:old('password') }}"
                >
                <span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
                {!!  $errors->first('password','<div class="invalid-feedback">:message</div>') !!}
              
              </div>
            </div>
         

            <div class="col-5">
                <label for="Carrera">Carrera</label>
                <select name="carrera" id="carrera" class="form-control  {{$errors->has('carrera')?'is-invalid':'' }}">
                
                </select>
                {!!  $errors->first('carrera','<div class="invalid-feedback">:message</div>') !!}
            </div>
    </div>  

    <script>
        $("#unidad").change(event => {
            $.get(`envio/${event.target.value}`, function(res, sta){
                $("#facultad").empty();
                $("#carrera").empty();
                $("#facultad").append(`<option > Elige una Facultad para este Usuario </option>`);
                res.forEach(element => {
                    $("#facultad").append(`<option value=${element.id}> ${element.nombre} </option>`);
                });
            });
        });

    </script>

    <script>
        $("#facultad").change(event => {
            $.get(`envio2/${event.target.value}`, function(res, sta){
                $("#carrera").empty();
                $("#carrera").append(`<option > Elige una Carrera para este Usuario </option>`);
                res.forEach(element => {
                    $("#carrera").append(`<option value=${element.id}> ${element.nombre} </option>`);
                });
            });
        });
    </script>
    <label></label>

    <div class="row">
        <div class="col-5">       
            <input type="submit" class="btn btn-primary " value="Guardar">
        </div>
        <div class="col-5">  
            <a href="{{url('personalAcademico')}}"class="btn btn-secondary float-right">Regresar</a>
        </div>
        
    </div>
    </div>
    </form>
    <script>
		$(document).on('ready', function() {
			$('#show-hide-passwd').on('click', function(e) {
				e.preventDefault();

				var current = $(this).attr('action');

				if (current == 'hide') {
					$(this).prev().attr('type','text');
					$(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
				}

				if (current == 'show') {
					$(this).prev().attr('type','password');
					$(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
				}
			})
		})
    </script>
    
  
<script type="text/javascript">
formulario.addEventListener('submit', (e) => {
    // e.preventDefault();
    // console.log(e.isTrusted);
 // console.log(campos.contenido);
     console.log("eventos de sumbits");
     /*
     nombre: false,
     email: false,
     apellido: false,
     codigoSis:false,
     telefono: false,
     */
     if( campos.nombre && campos.email && campos.apellido && campos.codigoSis && campos.telefono ){
         alert("Guardando... ");
         
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