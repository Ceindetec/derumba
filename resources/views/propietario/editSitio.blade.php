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
        textarea{
            resize: none;
        }
        .no{
            color: red;
        }
        .ok{
            color: green;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <div class="row">
            <h1>Sitio: <b>{{$sitio->nombre}}</b></h1>
        </div>
        <div class="panel panel-default">
            {!!Form::open(['id' => 'formInfo', 'class'=>'form-horizontal'])!!}
            <div class="panel-body">
                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading resaltado">
                            <b><h3 class="panel-title">Información General</h3></b>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="telefono" class="col-sm-3"><b>Teléfono: </b></label>
                                <div class="col-sm-9">
                                    <input name="telefono" id="telefono" type="text" class="form-control" placeholder="Número de contacto del sitio..." maxlength="10" minlength=10 value="{{$sitio->telefono}}" onkeypress="return justNumbers(event)" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-sm-3"><b>Horario: </b></span>
                                <div class="col-sm-9">
                                    {{--<a href="{{route('editHorarios')}}"  data-modal="" data-toggle="tooltip" data-placement="auto bottom" title="Horarios del sitio" class="editHora" style="color: #0000C2"><b>(Editar)</b></a>--}}
                                    <a href=""><b>Configurar</b>
                                        @if($sitio->horario != "")
                                            <i class="fa fa-check fa-lg ok" data-toggle="tooltip" title="Listo!" id="hora"></i>
                                        @else
                                            <i class="fa fa-times-circle fa-lg no" data-toggle="tooltip" title="No configurado!" id="hora"></i>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detalle" class="col-sm-3"><b>Descripción: </b></label>
                                <div class="col-sm-9">
                                    <textarea name="detalle" id="detalle" class="form-control" placeholder="Breve descripción del sitio..." rows="3" cols="50" value="{{$sitio->detalle}}" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading resaltado">
                            <b><h3 class="panel-title">Dirección y ubicación</h3></b>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="departamento" class="col-sm-3"><b>Departamento: </b></label>
                                <div class="col-sm-9">
                                    {!!Form::select('departamento', $arrayDepartamento, $sitio->dpto_id, ['class'=>"form-control", 'id' => 'departamento'])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="municipio_id" class="col-sm-3"><b>Municipio: </b></label>
                                <div class="col-sm-9">
                                    {!!Form::select('municipio_id', $arrayMunicipio, $sitio->municipio_id, ['class'=>"form-control", 'id'=>'municipio_id'])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="direccion" class="col-sm-3"><b>Dirección: </b></label>
                                <div class="col-sm-9">
                                    {!!Form::text('direccion', null, ['id'=>'direccion','class'=>"form-control", 'required'])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-sm-3"><b>Ubicación: </b></span>
                                <div class="col-sm-9">
                                    {{--<a href="{{route('editHorarios')}}"  data-modal="" data-toggle="tooltip" data-placement="auto bottom" title="Horarios del sitio" class="editHora" style="color: #0000C2"><b>(Editar)</b></a>--}}
                                    <a href=""><b>Configurar</b>
                                        @if($sitio->geolocalizacion != "")
                                            <i class="fa fa-check fa-lg ok" data-toggle="tooltip" title="Listo!" id="geo"></i>
                                        @else
                                            <i class="fa fa-times-circle fa-lg no" data-toggle="tooltip" title="No configurado!" id="geo"></i>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-8 col-lg-offset-2" id="notif"></div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="center-block btn btn-info">Guardar</button>
            </div>
            {!!Form::close()!!}
        </div>

        <div class="panel panel-default">

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        var formulario = $("#formInfo");
        formulario.submit(function(e) {
            var enviar = true;
            var error = "";
            e.preventDefault();
            if ($("#hora").hasClass("no")){
                enviar = false;
                error = "<li>Configura el horario de atención de tu sitio</li>"
            }
            if ($("#geo").hasClass("no")){
                enviar = false;
                error = error + "<li>Configura la ubicación de tu sitio</li>"
            }

            if (enviar){

            }
            else {
                $("#notif").html("<div class='alert alert-danger alert-dismissible'>" +
                                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                        "<span aria-hidden='true'>&times;</span>" +
                                    "</button>" +
                                    "<p>" +
                                        "<b>Error!</b> Corrige los siguientes errores para actualizar la información de tu sitio:" +
                                    "</p>" +
                                    "<ul>"+error+"</ul>" +
                                "</div>");

            }
        });


    </script>
@endsection

