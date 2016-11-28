@extends('layouts.principal')

@section('style')
<style>
    .resaltado{
        background: #68dff0 !important;
    }
</style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div class="row">
            <b><h2>Modificar informacion</h2></b>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading resaltado">
                    <b><h3 class="panel-title">Informacion basica</h3></b>
                </div>
                {!!Form::open(['id' => 'formInfo'])!!}
                <div class="panel-body">
                    <div class="col-xs-12">
                        <div class="form-group"><b>Nombre: </b>####<br></div>
                        <div class="form-group"><b>Documento: </b>####<br></div>
                        <div class="form-group"><b>Telefono: </b><input name="telefono" type="text" required><br></div>
                        <div class="form-group"><b>Correo: </b><input name="email" type="email" required> <br></div>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading resaltado">
                    <b><h3 class="panel-title">Actualizar contraseña</h3></b>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection