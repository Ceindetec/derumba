@extends('layouts.principal')

@section('style')
<style>
    .resaltado{
        background: #68dff0 !important;
    }
    .default{
        cursor: default; !important;
    }
    label{
        padding-top: 7px;
    }
    .alert{
        margin-top: 10px;
    }
</style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <div class="row">
            <b><h2>Modificar información</h2></b>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading resaltado">
                        <b><h3 class="panel-title">Información basica</h3></b>
                    </div>
                    {!!Form::open(['id' => 'formInfo', 'class'=>'form-horizontal'])!!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3"><b>Nombre: </b></label>
                            <div class="col-sm-9">
                                <input name="nombre" id="nombre" type="text" class="form-control" value="{{$usuario->getPersona->nombre.' '.$usuario->getPersona->apellido}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"><b>Identificación: </b></label>
                            <div class="col-sm-9">
                                <input name="documento" id="documento" type="text" class="form-control" value="{{$usuario->getPersona->documento}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-3"><b>Teléfono: </b></label>
                            <div class="col-sm-9">
                                <input name="telefono" id="telefono" type="text" class="form-control" placeholder="Tu número de contacto..." value="{{$usuario->getPersona->telefono}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo" class="col-sm-3"><b>Correo: </b></label>
                            <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-control" placeholder="Tu e-mail para inicio de sesión..." value="{{$usuario->email}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <input type="submit" class="btn btn-info" value="Guardar">
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading resaltado">
                        <b><h3 class="panel-title">Seguridad (Contraseña)</h3></b>
                    </div>
                    {!!Form::open(['id' => 'formContrasena', 'class'=>'form-horizontal'])!!}
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="cActual" class="col-sm-3"><b>Actual: </b></label>
                            <div class="col-sm-9">
                                <input name="cActual" id="cActual" type="password" class="form-control" placeholder="Tu contraseña actual..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cNueva" class="col-sm-3"><b>Nueva: </b></label>
                            <div class="col-sm-9">
                                <input name="cNueva" id="cNueva" type="password"  class="form-control" placeholder="Tu nueva contraseña..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cConfirm" class="col-sm-3"><b>Confirmar: </b></label>
                            <div class="col-sm-9">
                                <input name="cConfirm" id="cConfirm" type="password"  class="form-control" placeholder="Confirma tu nueva contraseña..." required>
                                <div class="alert alert-danger hidden" id="error">
                                    <strong>Error!</strong> Las contraseñas NO coinciden.
                                </div>
                                <div class="alert alert-success hidden" id="bien">
                                    <strong>Perfecto!</strong> Las contraseñas coinciden.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <input type="submit" class="btn btn-info" value="Actualizar" id="actualContras" disabled>
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
    <script>
        $(function () {
            var formInfo = $("#formInfo");
            var formContrasena = $("#formContrasena");

            formInfo.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('setInfo')}}',
                    data: formInfo.serialize(),
                    success: function (data) {

                    },
                    error: function () {
                        console.log('ok');
                    }
                });
            });

            formContrasena.submit(function (e) {
                e.preventDefault();
                if (!$("#bien").hasClass("hidden")) {
                    $.ajax({
                        type: "POST",
                        context: document.body,
                        url: '{{route('setContrasena')}}',
                        data: formRegistro.serialize(),
                        success: function (data) {

                        },
                        error: function () {
                            console.log('ok');
                        }
                    });
                }
            });

            $("#cNueva").change(function () {
                if ($("#cConfirm").val() != "") {
                    if ($("#cConfirm").val() != $(this).val()) {
                        $("#cConfirm").parent().parent().addClass("has-error").removeClass("has-success");
                        $("#error").removeClass("hidden");
                        $("#bien").addClass("hidden");
                        $("#actualContras").attr('disabled', 'true');
                    }
                    else {
                        $("#cConfirm").parent().parent().removeClass("has-error").addClass('has-success');
                        $("#actualContras").removeAttr('disabled');
                        $("#error").addClass("hidden");
                        $("#bien").removeClass("hidden");
                        $("#actualContras").removeAttr('disabled');
                    }
                }
                else {
                    $(this).parent().parent().removeClass("has-error has-success");
                    $("#error").addClass("hidden");
                    $("#bien").addClass("hidden");
                    $("#actualContras").attr('disabled', 'true');
                }
            });

            $("#cConfirm").change(function () {
                if ($(this).val() != "") {
                    if ($(this).val() != $("#cNueva").val()) {
                        $(this).parent().parent().addClass("has-error").removeClass("has-success");
                        $("#error").removeClass("hidden");
                        $("#bien").addClass("hidden");
                        $("#actualContras").attr('disabled', 'true');
                    }
                    else {
                        $(this).parent().parent().removeClass("has-error").addClass('has-success');
                        $("#error").addClass("hidden");
                        $("#bien").removeClass("hidden");
                        $("#actualContras").removeAttr('disabled');

                    }
                }
                else {
                    $(this).parent().parent().removeClass("has-error has-success");
                    $("#error").addClass("hidden");
                    $("#bien").addClass("hidden");
                    $("#actualContras").attr('disabled', 'true');
                }
            });


        });
    </script>

@endsection