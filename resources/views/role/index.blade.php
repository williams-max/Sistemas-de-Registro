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
                     class="btn btn-primary float-right"
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

                             @if ($role->name=='admin')
                                 <td><a class="btn btn-default" href="{{ route('rola.show',$role->id)}}">
                               Ver</a></td>
                             @else
                             @can('haveaccess','rola.show')
                             <td><a class="btn btn-default" href="{{ route('rola.show',$role->id)}}">
                               Ver</a></td>
                               @endcan 
                               @can('haveaccess','rola.edit')
                             <td><a class="btn btn-success" href="{{ route('rola.edit',$role->id)}}">
                               Editar</a></td>
                               @endcan 
                              <td>
                               @can('haveaccess','rola.destroy')
                               <form action="{{ route('rola.destroy',$role->id)}}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button class="btn btn-danger">Eliminar</button>
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
 
@endsection