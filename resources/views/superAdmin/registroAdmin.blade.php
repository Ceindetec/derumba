@extends('layouts.principal')

@section('style')
    <style>
        .resaltado {
            background: #68dff0 !important;
        }

        @media (min-width: 768px) {
            .form-horizontal .control-label {
                text-align: right;
            }
        }

    </style>
@endsection

@section('content')

    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div class="row">
            <b><h2>Registrar un Propietario</h2></b>
        </div>
        {!!Form::open(['id'=>'formRegistroPropi','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading resaltado">
                    <b><h3 class="panel-title">Informacion basica</h3></b>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="documento" class="col-sm-4 control-label">Identificación</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="documento" name="documento" placeholder="Número de indentificación">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="telefono" class="col-sm-4 control-label">Telefono</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-4 control-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="apellido" class="col-sm-4 control-label">Apellido</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="correo" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8  correo ">
                                    <input type="email" class="form-control " id="correo" name="email" placeholder="Email">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading resaltado">
                    <b><h3 class="panel-title">Información de la marca</h3></b>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nit" class="col-sm-4 control-label">Nit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nit" name="nit" placeholder="Nit">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="razon" class="col-sm-4 control-label">Razón Socia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="razon" name="razon"
                                           placeholder="Razón Socia o Nombre">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-4 text-right">
                            <h4>Imagen de la marca</h4>
                        </div>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-info">
                                        Browse&hellip; <input type="file" style="display: none;" id="file" name="file">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <span class="help-block">
                                Try selecting one or more files and watch the feedback
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading resaltado">
                    <b><h3 class="panel-title">Información del sitio</h3></b>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nombreS" class="col-sm-4 control-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombreS" name="nombreS" placeholder="Nombres">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="telefonoS" class="col-sm-4 control-label">Telefono</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telefonoS" name="telefonoS" placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('departamento', 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!!Form::select('departamento', $arrayDepartamento, null, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento', 'required'])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="divMinucipio">
                                {!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!!Form::select('municipio_id', [], null, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio', 'required'])!!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer text-center">
                    <div class="row">
                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-default">Registrar Propietario</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {!!Form::close()!!}
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                        numFiles = input.get(0).files ? input.get(0).files.length : 1,
                        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                            log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });
            });


            var formRegistroPropi = $("#formRegistroPropi");
            formRegistroPropi.submit(function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: "{!! route('addPropietario') !!}",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (result) {


                    },
                    error: function (error) {
//                        alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                        console.log(error);
                    }
                });
            });

            $("#departamento").change(function () {
                $("#geolocalizacion").val("");
                if($("#departamento").val()==""){
                    //alert("el id es nulo");
                    $("#municipio_id").empty();
                    $("#municipio_id").append("<option value=''>Selecciona un Municipio</option>");
                }else{
                    //alert("el id es "+$("#departamento").val());
                    $.ajax({
                        type: "POST",
                        context: document.body,
                        url: '{{route('municipios')}}',
                        data: { 'id' : $("#departamento").val()},
                        success: function (data) {
                            $("#municipio_id").empty();
                            $.each(data,function (index,valor) {
                                $("#municipio_id").append('<option value='+index+'>'+valor+'</option>');
                                //console.log("la key es "+index+" y el valor es "+valor);
                            });
                        },
                        error: function (data) {
                        }
                    });
                }

            });

        });
    </script>
@endsection