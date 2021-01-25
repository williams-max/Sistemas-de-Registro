@extends('layouts.app')

@section('content')

<form action="{{url('/registroMateria')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

    {{ csrf_field()}}
   <h3 class="text-center">REGISTRO DE MATERIA</h3> 
<BR></BR>

<div class="col-md-11 mx-auto " >
   <style>
    
    .myinput.large {
        height: 22px;
        width: 22px;
      }
      
      .myinput.large[type="checkbox"]:before {
        width: 20px;
        height: 20px;
      }
      
      .myinput.large[type="checkbox"]:after {
        top: -20px;
        width: 16px;
        height: 16px;
      }
</style> 

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
        <label for="Materia"class="control-label">{{'Materia'}}</label>
        <input type="text" class="form-control  {{$errors->has('materia')?'is-invalid':'' }}" name="materia" id="materia" 
        value="{{ isset($registro->materia)?$registro->materia:old('materia') }}"
        >
        {!!  $errors->first('materia','<div class="invalid-feedback">:message</div>') !!}
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
        <label for="Grupo"class="control-label">{{'Grupo'}}</label>
        <input type="text" class="form-control  {{$errors->has('grupo')?'is-invalid':'' }}" name="grupo" id="grupo" 
        value="{{ isset($registro->grupo)?$registro->grupo:old('grupo') }}"
        >
        {!!  $errors->first('grupo','<div class="invalid-feedback">:message</div>') !!}
    </div>

                   
    
</div>
<div class="row">
    <div class="col-5">
        <label for="Carrera"></label>
       <select name="carrera" id="carrera" class="form-control  {{$errors->has('carrera')?'is-invalid':'' }}">
            
            </select>
            {!!  $errors->first('carrera','<div class="invalid-feedback">:message</div>') !!}
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

</div>

<label></label>
<h4 class="text-center">Horarios</h4>
<div class="col-md-8 mx-auto " >
   <h4 >
    @include('custom.message')
</h4> 
</div>

<div class="col-md-8 mx-auto " >
     <table class="table table-hover"  border="3" bordercolor="#008000">
            <thead class="thead-light">
                <tr>
                    <th class="text-center">Horarios</th>
                    <th class="text-center">Lunes</th>
                    <th class="text-center">Martes</th>
                    <th class="text-center">Miercoles</th>
                    <th class="text-center">Jueves</th>
                    <th class="text-center">Viernes</th>
                    <th class="text-center">Sabado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        6:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="06:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="06:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="06:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="06:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="06:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="06:45:00">
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        8:15
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="08:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="08:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="08:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="08:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="08:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="08:15:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        9:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="09:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="09:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="09:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="09:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="09:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="09:45:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        11:15
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="11:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="11:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="11:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="11:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="11:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="11:15:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        12:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="12:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="12:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="12:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="12:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="12:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="12:45:00">
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        14:15
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="14:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="14:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="14:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="14:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="14:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="14:15:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        15:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="15:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="15:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="15:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="15:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="15:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="15:45:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        17:15
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="17:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="17:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="17:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="17:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="17:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="17:15:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        18:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="18:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="18:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="18:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="18:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="18:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="18:45:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        20:15
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="20:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="20:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="20:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="20:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="20:15:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="20:15:00">
                    </td>
                </tr>
                <tr>
                    <td>
                        21:45
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="lunes[]" value="21:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="martes[]" value="21:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="miercoles[]" value="21:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="jueves[]" value="21:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="viernes[]" value="21:45:00">
                    </td>
                    <td class="text-center">
                        <input type="checkbox" class="myinput large" name="sabado[]" value="21:45:00">
                    </td>
                </tr>
            </tbody>
        </table>
        
        <br><br>
        <div class="row">
    <div class="col-5 ">       
        <input type="submit" class="btn btn-primary" value="Guardar">
    </div>
    <div class="col-5">  
        <a href="{{url('registroMateria')}}"class="btn btn-secondary float-right">Regresar</a>
    </div> 
    
    
</div>
    </div>
   <br><br>




</form>


@endsection