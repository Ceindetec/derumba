@extends('layouts.principal')

@section('style')
<style>
    .resaltado{
        background: #68dff0 !important;
    }
    .default{
        cursor: default; !important;
    }
</style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <div class="row">
            <b><h2>Modificar informacion</h2></b>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading resaltado">
                        <b><h3 class="panel-title">Informacion basica</h3></b>
                    </div>
                    {!!Form::open(['id' => 'formInfo', 'class'=>'form-horizontal'])!!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3"><b>Nombre: </b></label>
                            <div class="col-sm-9">
                                <input name="nombre" id="nombre" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"><b>Identificación: </b></label>
                            <div class="col-sm-9">
                                <input name="documento" id="documento" type="text"  class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-3"><b>Telefono: </b></label>
                            <div class="col-sm-9">
                                <input name="telefono" id="telefono" type="text"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo" class="col-sm-3"><b>Correo: </b></label>
                            <div class="col-sm-9">
                                <input name="correo" id="correo" type="text"  class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading resaltado">
                        <b><h3 class="panel-title">Actualizar contraseña</h3></b>
                    </div>
                    {!!Form::open(['id' => 'formContrasena', 'class'=>'form-horizontal'])!!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3"><b>Actual: </b></label>
                            <div class="col-sm-9">
                                <input name="cActual" id="cActual" type="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"><b>Nueva: </b></label>
                            <div class="col-sm-9">
                                <input name="cNueva" id="cNueva" type="text"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-3"><b>Confirmar: </b></label>
                            <div class="col-sm-9">
                                <input name="cConfirm" id="cConfirm" type="text"  class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-info">Actualizar</button>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>

@endsection

@section('scripts')
@endsection