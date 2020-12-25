@extends('layouts.app')

@section('content')

<form action="{{url('/registroMateria/' . $materia->id)}}" method="post" enctype="multipart/form-data" >

    {{csrf_field()}}
    {{method_field('PATCH')}}


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
        <label for="Personal">Personal</label>
       <select disabled name="personal" id="personal" class="form-control  {{$errors->has('personal')?'is-invalid':'' }}">
            <option selected disabled>Seleccione una Unidad</option>
            @foreach ($personal as $personal)
                <option selected disabled value="{{$personal->id}}">{{$personal->nombre}} {{$personal->apellido}}</option>
            @endforeach
            </select>
            {!!  $errors->first('personal','<div class="invalid-feedback">:message</div>') !!}
        
    </div>
    <div class="col-5">
        <label for="Materia"class="control-label">{{'Materia'}}</label>
        <input type="text" class="form-control  {{$errors->has('materia')?'is-invalid':'' }}" name="materia" id="materia" 
        value="{{ isset($materia->materia)?$materia->materia:old('materia') }}"
        >
        {!!  $errors->first('materia','<div class="invalid-feedback">:message</div>') !!}
    </div>
    
   
</div>
<div class="row">

    <div class="col-5">
        <label for=""class="control-label">{{'Horarios Asignados'}}</label> <br>
        @foreach ($horarios as $horarios)
        
        <label  for=""class="control-label"><h5>{{'DIA: '}}  {{$horarios->dia}} {{$horarios->hora}}</h5></label> <br>
        @endforeach

    </div>
    <div class="col-5">
        <label for="Grupo"class="control-label">{{'Grupo'}}</label>
        <input type="text" class="form-control  {{$errors->has('grupo')?'is-invalid':'' }}" name="grupo" id="grupo" 
        value="{{ isset($materia->grupo)?$materia->grupo:old('grupo') }}"
        >
        {!!  $errors->first('grupo','<div class="invalid-feedback">:message</div>') !!}
    </div>

                   
    
</div>

<div class="row">
   
    
</div>

</div>
<label></label>
<div class="col-md-8 mx-auto " >
    <h4 class="text-center">
        <p class="p-2 bg-primary text-white">Marque los nuevos horarios por favor</p>
    </h4>
    <h4 >
        @include('custom.message')
    </h4>
</div>
<h4 class="text-center">Horarios</h4>

<div class="col-md-8 mx-auto " >
     <table class="table table-hover"  border="3" bordercolor="#008000" id="mytable">
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
            <tbody >
                <tr>
                    <td>
                        6:45
                    </td>
                   
                    <td class="text-center">
                       <input type="checkbox" class="myinput large" name="lunes[]" value="06:45:00">   
                    </td>
                    <td class="text-center"> 
                         <input  type="checkbox" class="myinput large" name="martes[]" value="06:45:00">
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
    </div>
   
    <div class="col-md-10 mx-auto " >
<div class="row">

    <div class="col-5">  
        <a href="{{url('registroMateria')}}"class="btn btn-primary">Regresar</a>
    </div> 
    <div class="col-5 ">       
        <input type="submit" class="btn btn-success float-right" value="Guardar">
    </div>
    <br><br>
    
</div></div>






</form>


@endsection