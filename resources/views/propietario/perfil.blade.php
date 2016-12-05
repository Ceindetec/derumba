@extends('layouts.principal')

@section('style')
<style>
    .resaltado{
        background: #68dff0 !important;
    }
    label{
        padding-top: 7px;
    }
    .alert{
        margin-top: 15px;
        margin-bottom: 0;
    }
    .no-padding{
        padding: 0;
    }
    ul > li{
        list-style-type: disc;
        margin-left: 50px;
    }
</style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <div class="row">
            <b><h2>Modificar información</h2></b>
        </div>
        <div class="row">
            <h3 style="margin-bottom: 15px"><b>Propietario:</b> {{$usuario->getPersona->nombre.' '.$usuario->getPersona->apellido}}</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading resaltado">
                        <b><h3 class="panel-title">Información basica</h3></b>
                    </div>
                    {!!Form::open(['id' => 'formInfo', 'class'=>'form-horizontal'])!!}
                    <div class="panel-body">
                        {{--<div class="form-group">--}}
                            {{--<label class="col-sm-3"><b>Nombre: </b></label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<input name="nombre" id="nombre" type="text" class="form-control" value="{{$usuario->getPersona->nombre.' '.$usuario->getPersona->apellido}}" disabled>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label class="col-sm-3"><b>Identificación: </b></label>
                            <div class="col-sm-9">
                                <input name="documento" id="documento" type="text" class="form-control" value="{{$usuario->getPersona->documento}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telefono" class="col-sm-3"><b>Teléfono: </b></label>
                            <div class="col-sm-9">
                                <input name="telefono" id="telefono" type="text" class="form-control" placeholder="Tu número de contacto..." maxlength="10" minlength=10 value="{{$usuario->getPersona->telefono}}" onkeypress="return justNumbers(event)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="correo" class="col-sm-3"><b>Correo: </b></label>
                            <div class="col-sm-9">
                                <input name="email" id="email" type="email" class="form-control" placeholder="Tu e-mail para inicio de sesión..." value="{{$usuario->email}}" required>
                                <div id="notif" class="hidden alert"></div>
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
                                <input name="cActual" id="cActual" type="password" class="form-control" placeholder="Tu contraseña actual..." minlength=5 maxlength=15 required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cNueva" class="col-sm-3"><b>Nueva: </b></label>
                            <div class="col-sm-9">
                                <input name="cNueva" id="cNueva" type="password"  class="form-control" placeholder="Tu nueva contraseña..." minlength=5 maxlength=15 required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cConfirm" class="col-sm-3"><b>Confirmar: </b></label>
                            <div class="col-sm-9">
                                <input name="cConfirm" id="cConfirm" type="password"  class="form-control" placeholder="Confirma tu nueva contraseña..." minlength=5 maxlength=15 disabled required>
                                <div class="hidden alert" id="notifContras"></div>
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

            $("#email").blur(function(){
                validarEmail($(this));
            });

            formInfo.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('setInfo')}}',
                    data: formInfo.serialize(),
                    success: function (data) {
                        if (data == "exito")
                            $("#notif").html('<strong>Correcto!</strong> La informacion se ha actualizado exitosamente.').removeClass("hidden").addClass("alert-success").removeClass("alert-danger");
                        else
                            $("#notif").html('<strong>Correo no actualizado!</strong> <p>El correo electrónico ya esta en uso por otro usuario.</p>').removeClass("hidden").addClass("alert-danger").removeClass("alert-success");
                    },
                    error: function (data) {
                        var respuesta =JSON.parse(data.responseText);
                        var arr = Object.keys(respuesta).map(function(k) { return respuesta[k] });
                        var error='<ul class="no-padding"><p>Por favor corregir los siguientes errores:</p>';
                        for (var i=0; i<arr.length; i++)
                            error += "<li>"+arr[i][0]+"</li>";
                        error += "</ul>";
                        $("#notif").html(error).removeClass("hidden").addClass("alert-danger").removeClass("alert-success");
                    }
                });
            });

            formContrasena.submit(function (e) {
                e.preventDefault();
                if ($("#cNueva").val() == $("#cConfirm").val()) {
                    $.ajax({
                        type: "POST",
                        context: document.body,
                        url: '{{route('setContrasena')}}',
                        data: formContrasena.serialize(),
                        success: function (data) {
                            if(data == "exito")
                                $("#notifContras").removeClass('hidden alert-danger').addClass("alert-success").html("<strong>Terminado!</strong> La nueva contraseña fue actualizada correctamente");
                            else
                                $("#notifContras").removeClass('hidden alert-success').addClass("alert-danger").html("<strong>Error! </strong>"+data);
                        },
                        error: function (data) {

                        }
                    });
                }
                else{
                    $("#notifContras").removeClass('hidden alert-success').addClass("alert-danger").html("<strong>Error!</strong> Las contraseñas no coinciden");
                }
            });

            $("#cNueva").change(function () {
                $("#cConfirm").val("");
                $("#actualContras").attr('disabled', 'true');
                if($(this).val() != "") {
                    $("#cConfirm").removeAttr("disabled");
                    $("#notifContras").removeClass('alert-danger alert-success').addClass("hidden").html("");
                }
                else
                    $("#actualContras").attr('disabled', 'true');
            });

            $("#cConfirm").change(function () {
                if($(this).val() == ""){
                    $("#actualContras").attr("disabled", 'true');
                    $("#notifContras").removeClass('alert-danger alert-success').addClass("hidden").html("");
                }
                else {
                    if($("#cNueva") != ""){
                        if($(this).val() != $("#cNueva").val()) {
                            $("#actualContras").attr("disabled", 'true');
                            $("#notifContras").removeClass('hidden alert-success').addClass("alert-danger").html("<strong>Error!</strong> Las contraseñas no coinciden");
                        }
                        else{
                            $("#actualContras").removeAttr("disabled");
                            $("#notifContras").removeClass('alert-danger alert-success').addClass("hidden").html("");
                        }
                    }
                    else {
                        $("#actualContras").removeAttr("disabled");
                        $("#notifContras").removeClass('alert-danger alert-success').addClass("hidden").html("");
                    }
                }

            });
        });
    </script>

@endsection