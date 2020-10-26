<a href="{{route('roles.edit',$role->id ?? '')}}" type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal2{{$role->id ?? ''}}">
    Editar
</a>

<form action="{{url('/roles/' . $role->id)}}" method="post" enctype="multipart/form-data">

    {{csrf_field()}}
    {{method_field('PATCH')}}
    

<div class="modal fade" id="myModal2{{$role->id ?? ''}}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-Header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true"></span>
                    </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" >Editar Rol:</label>
                        <input id="recipient-name" name="name" class="form-control" type="text" value="{{$role->name}}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

</form>
</div>