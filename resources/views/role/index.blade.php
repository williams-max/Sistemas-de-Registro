@extends('layouts.app')

@section('content')
  
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Lista de Roles</h2> </div>
                <div class="card-body">
                   
                  @can('haveaccess','rola.create')
                    <a href="{{route('rola.create')}}"
                     class="btn btn-success float-right"
                    >Crear
                    </a> 
                    <br><br> 
                  @endcan  
                    @include('custom.message')

                    <table class="table table-hover">
                      
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <!--<th scope="col">slug</th>-->
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acceso Completo</th>
                            <th scope="col">Autoridad</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <tbody>
                         

                             @foreach ($roles as $role) 
                             <tr>
                             <th scope="row">{{$role->id}}</th>
                             <td>{{$role->name}}</td>
                             <!--<td>{{$role->slug}}</td>-->
                             <td>{{$role->description}}</td>
                             <td>{{$role['full-access']}}</td>  
                             <td>{{$role['full-auto']}}</td>

                             @if ($role->name=='admin')
                                 <td><a class="btn btn-default" href="{{ route('rola.show',$role->id)}}">
                               Ver</a></td>
                             @else
                             @can('haveaccess','rola.show')
                             <td><a class="btn btn-default" href="{{ route('rola.show',$role->id)}}">
                               Ver</a></td>
                               @endcan 
                               @can('haveaccess','rola.edit')
                             <td><a class="btn btn-warning" href="{{ route('rola.edit',$role->id)}}">
                               Editar</a></td>
                               @endcan 
                              <td>
                               @can('haveaccess','rola.destroy')
                               <form id="myform"  action="{{ route('rola.destroy',$role->id)}}" method="POST" onsubmit="return ConfirmDemo();">
                                 @csrf
                                 @method('DELETE')
                                 <button  class="btn btn-danger">Borrar</button>
                               </form>
                               @endcan 
                                 
                             @endif
                            
                             
                            </tr>
                             @endforeach
                          
                         
                         
                        </tbody>
                      </table>

                      {{$roles->links()}}
                 </div>
            </div>
          
        </div> 
    </div>
 </div>

    <script type="text/javascript">
    
    var valor=0;  
    function ConfirmDemo() {

      //console.log()
      //Ingresamos un mensaje a mostrar
      var formulario = document.getElementById("myform");
      var mensaje = confirm("¿Estas Seguro que Deseas Eliminar?");
      //Detectamos si el usuario acepto el mensaje
      if (mensaje) {
        valor=1;
      alert("¡Gracias por aceptar!");
             if (valor==1) {
              //alert("Enviando el formulario");
              formulario.submit();
              return true;
             } else {
               alert("Error al Eliminar el Formulario");
             return false;
      }
   
      }
      //Detectamos si el usuario denegó el mensaje
      else {
      alert("¡operacion Denegada!");
        return false;
   
       }
      }
    </script>

 
@endsection