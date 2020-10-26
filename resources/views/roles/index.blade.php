@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto ">
        <h2>Roles
            @include('roles.create')
        </h2>
         

            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $roles as $role)
                    <tr>  
                        <td>{{$role->name}}</td>
                        <td>
                        @if ($role->name !='Administrador')
                        <form method="post" action="{{url('/roles/'.$role->id)}}" style="display:inline">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('¿Borrar?');" class="btn btn-danger float-right">Borrar</button>
                        </form>
                            @include('roles.edit')
                        @endif
                        
                    </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>




@endsection