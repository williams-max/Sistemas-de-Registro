@extends('layouts.app')

@section('content')



    <form action="{{url('/formularioRegistros')}}" class="form-horizontal" method="post" enctype="multipart/form-data">

        {{ csrf_field()}}

            <div class="form-group">
        <label for="Fecha" class="control-label">{{'Fecha'}}</label>
        <input type="date" class="form-control" name="fecha" id="fecha"

        >

    <div class="form-group">
        <label for="Hora"class="control-label">{{'Hora'}}</label>
        <input type="time" class="form-control" name="hora" id="hora"
        value="{{ isset($formularioRegistro->hora)?$formularioRegistro->hora:'' }}"
        >
    </div>

    <div class="form-group">
        <label for="Grupo"class="control-label">{{'Grupo'}}</label>
        <input type="number" class="form-control" name="grupo" id="grupo"
        value="{{ isset($formularioRegistro->grupo)?$formularioRegistro->grupo:'' }}"
        >
    </div>


        <div class="form-group">
            <label for="Materia"class="control-label">{{'Materia'}}</label>
            <input type="text" class="form-control" name="materia" id="materia"
            value="{{ isset($formularioRegistro->materia)?$formularioRegistro->materia:'' }}"
            >
        </div>

        <div class="form-group">
            <label for="Contenido de Clase"class="control-label">{{'Contenido de Clase'}}</label>
            <textarea type="text" class="form-control" name="contenido" id="contenido"
            value="{{ isset($formularioRegistro->contenido)?$formularioRegistro->contenido:'' }}">
            </textarea>
        </div>

        <div class="form-group">
            <label for="Plataforma o Medio Utilizado"class="control-label">{{'Plataforma o Medio Utilizado'}}</label>
            <input type="text" class="form-control" name="plataforma" id="plataforma"
            value="{{ isset($formularioRegistro->plataforma)?$formularioRegistro->plataforma:'' }}"
            >
        </div>

        <div class="form-group">
            <label for="Observaciones"class="control-label">{{'Observaciones'}}</label>
            <textarea type="text" class="form-control" name="observaciones" id="observaciones"
            value="{{ isset($formularioRegistro->observaciones)?$formularioRegistro->observaciones:'' }}">
            </textarea>
        </div>


            <input type="submit" class="btn btn-success" >
            <a href="{{url('/ formularioRegistros')}}"class="btn btn-primary">Regresar</a>

    </form>


@endsection
