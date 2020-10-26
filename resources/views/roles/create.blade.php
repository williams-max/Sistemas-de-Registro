<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i>
</button>

{!! Form::open(['url'=>'roles']) !!}
{{Form::token()}}

<div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="recipient-name" class="col-form-label">Nombre del Rol:</label>
                        <input id="recipient-name" class="form-control {{$errors->has('name')?'is-invalid':''}}" type="text" name="name">
                    {!!  $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}


