@extends('layouts.app')

@section('content')
  
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-header"><h2>Editar Rol</h2> </div>
                   <div class="card-body">
                       @include('custom.message')

                    <form action= "{{ route('rola.update', $rola->id ) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="container">
                            <!--<h3>Campos Requridos</h3>-->

                               <div class="form-group">
                                <input type="text" class="form-control" 
                                id="name" 
                                placeholder="Nombre"
                                name="name"
                                value="{{old('name', $rola->name)}}"
                                >
                              </div>

                              <!--<div class="form-group">
                               <input type="text" class="form-control" 
                               id="slug" 
                               placeholder="Slug"
                               name="slug"
                               value="{{old('slug', $rola->slug)}}"
                               >
                              </div>-->

                              <div class="form-group">
                                <textarea class="form-control" placeholder="Descripcion" name="description" id="description" rows="3">{{old('description', $rola->description)}}
                              </textarea>
                              </div>

                              <h3>Autoridad Academica</h3>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullautoyes" name="full-auto" 
                                class="custom-control-input" value="yes"
                                @if ( $rola['full-auto']=="yes")
                                    checked
                                
                                @elseif (old('full-auto')=="yes")
                                    checked
                                @endif
                                
                                >
                                <label class="custom-control-label" for="fullautoyes">SI</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullautono" name="full-auto" 
                                class="custom-control-input " value="no" 
                                @if ($rola['full-auto']=="no")
                                checked
                                
                                @elseif (old('full-auto')=="no")
                                checked
                                @endif
                                >
                                <label class="custom-control-label" for="fullautono">No</label>
                              </div>
                              
                              <hr>
                              
                              <h3>Acceso Completo</h3>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessyes" name="full-access" 
                                class="custom-control-input" value="yes"
                                @if ( $rola['full-access']=="yes")
                                    checked
                                
                                @elseif (old('full-access')=="yes")
                                    checked
                                @endif
                                
                                >
                                <label class="custom-control-label" for="fullaccessyes">SI</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="fullaccessno" name="full-access" 
                                class="custom-control-input " value="no" 
                                @if ($rola['full-access']=="no")
                                checked
                                
                                @elseif (old('full-access')=="no")
                                checked
                                @endif
                                >
                                <label class="custom-control-label" for="fullaccessno">No</label>
                              </div>

                              <hr>
                             
                              <h3>Lista de Permisos</h3>

                              @foreach ($permissions as $permission)
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                 class="custom-control-input" 
                                 id="permission_{{$permission->id}}"
                                 value="{{$permission->id}}"
                                 name="permission[]"

                                 @if (is_array(old('permission')) && in_array("$permission->id",old("permission")))
                                    checked
                                 
                                 @elseif (is_array($permission_role) && in_array("$permission->id",$permission_role))
                                    checked
                                 @endif
                                 >
                                <label class="custom-control-label" 
                                  for="permission_{{$permission->id}}">
                                  {{$permission->id}}
                                  -

                                  {{$permission->name}}
                                  <em>( {{$permission->description}} )</em> 

                                </label>
                              </div>
 
                              @endforeach
                              <hr>
                              <div class="row">
                                <div class="col-5 ">       
                                    <input type="submit"  class="btn btn-primary" value="Guardar">
                                </div>
                                <div class="col-5">  
                                    <a href="{{url('rola')}}"class="btn btn-secondary float-right">Regresar</a>
                                </div> 
                               
                            </div>
                             
                        </div>

                    </form>

               

                   </div>
            </div>
          
        </div> 
    </div>
 </div>
 
@endsection