@extends('layouts.principal')

@section('style')
    <style>
        .resaltado{
            background: #68dff0 !important;
        }

        #map{
            width: 100%;
            height: 400px;
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
        .manito{
            cursor: pointer;
        }
        .link{
            color: #064eff;
        }
        .panel-default{
            margin-bottom: 0;
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
                                    <a href="{{route('editHorarios', $sitio->id)}}" data-modal=""><b>Configurar</b>
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
                                    <textarea name="detalle" id="detalle" class="form-control" placeholder="Breve descripción del sitio..." rows="3" cols="50" required>{{$sitio->detalle}}</textarea>
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
                                    {!!Form::text('direccion', $sitio->direccion, ['id'=>'direccion','class'=>"form-control", 'required'])!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-sm-3"><b>Ubicación: </b></span>
                                <div class="col-sm-9">
                                    {{--<a href="{{route('editHorarios')}}"  data-modal="" data-toggle="tooltip" data-placement="auto bottom" title="Horarios del sitio" class="editHora" style="color: #0000C2"><b>(Editar)</b></a>--}}
                                    <span class="manito link" id="ubicar"><b>Configurar</b>
                                        @if($sitio->geolocalizacion != "")
                                            <i class="fa fa-check fa-lg ok" data-toggle="tooltip" title="Listo!" id="geo"></i>
                                        @else
                                            <i class="fa fa-times-circle fa-lg no" data-toggle="tooltip" title="No configurado!" id="geo"></i>
                                        @endif
                                    </span>
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

    <div class="modal fade" id="mapaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Configurar Ubicacion</h4>
                </div>
                <div class="modal-body">
                    
                    <div id="map"></div>
                </div>
                <div id="info"></div>
                <div class="modal-footer">
                    <div id="getinfo" class="hidden"></div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="almacenarCoordenada">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="horarioModal" tabindex="-3" role="dialog" aria-labelledby="horarioModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Configurar Horario</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-bottom: 15px">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="direccion" class="col-xs-2 control-label" style="padding-top: 5px">Direccion</label>
                                <div class="col-xs-10">
                                    <input type="text" name="direccion" id="direccion" placeholder="Ingresar direccion de sitio..." class="form-control" value="{{$sitio->direccion}}" data-toggle="tooltip" data-placement="auto bottom" title="Direccion del sitio">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map" style="height: 500px; width: 500px"></div>
                </div>
                <div id="info"></div>
                <div class="modal-footer">
                    <div id="getinfo" class="hidden"></div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="almacenarCoordenada">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyA1AUmEiXssHdvD3yAjE4VTh_pWQENfNUM&sensor=true"></script>
    {{--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
    {!!Html::script('js/gmaps.js')!!}
    <script>
        var map;
        var coordenada;
        var geolocalizacion = "{{$sitio->gelocalizacion}}";
        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();

            $("#ubicar").on('click', function(){
                $("#mapaModal").modal("show");
                setTimeout(function () {
                    map = new GMaps({
                        el: '#map',
                        lat: -12.043333,
                        lng: -77.028333
                    });

                    if(geolocalizacion=="")
                        geoMapa("{{$municipio->municipio." ".$municipio->getDepartamento->departamento}}");

                    else{
                        geo=geolocalizacion.split(",");
                        map.setCenter(geo[0], geo[1]);
                        map.removeMarkers();
                        map.addMarker({
                            lat: geo[0],
                            draggable: true,
                            lng: geo[1],
                            dragend: function(e) {
                                var lat = e.latLng.lat();
                                var lng = e.latLng.lng();
                                map.setCenter(lat, lng);
                                console.log(lat+","+ lng);
                                coordenada = lat+","+ lng;
                                //alert('dragend '+lat+"->"+lng);
                                //console.log(e);
                            }
                        });
                    }

                }, 500);

            });

            $("#horario").on('click', function(){
                $("#horarioModal").modal("show");
            });
        });

        var formulario = $("#formInfo");
        formulario.submit(function(e) {
            var enviar = true;
            var error = "";
            e.preventDefault();
            if ($("#hora").hasClass("no")){
                enviar = false;
                error = "<li>Configura el horario de atención de tu sitio.</li>"
            }
            if ($("#geo").hasClass("no")){
                enviar = false;
                error = error + "<li>Configura la geolocalización de tu sitio.</li>"
            }

            if (enviar){
                var sitio = "{{$sitio->id}}";
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('updateInfoSitio')}}',
                    data: formulario.serialize()+"&sitio="+sitio,
                    success: function (data) {
                        if(data == "exito"){
                            $("#notif").html("<div class='alert alert-success alert-dismissible'>" +
                                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                    "</button>" +
                                    "<p>" +
                                    "<b>Correcto!</b> La información de tu sitio se ha actualizado exitosamente:" +
                                    "</p>" +
                                    "<ul>"+error+"</ul>" +
                                    "</div>");
                        }
                    },
                    error: function (data) {
                    }
                });
            }
            else {
                $("#notif").html("<div class='alert alert-danger alert-dismissible'>" +
                                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                        "<span aria-hidden='true'>&times;</span>" +
                                    "</button>" +
                                    "<p>" +
                                        "<b>Error!</b> Completa la siguiente información para actualizar la información del sitio:" +
                                    "</p>" +
                                    "<ul>"+error+"</ul>" +
                                "</div>");

            }
        });

        function geoMapa($muniDepartamento){

            GMaps.geocode({

                address: $muniDepartamento,
                callback: function(results, status){
//                    debugger;
                    if(status=='OK'){
                        var latlng = results[0].geometry.location;
                        map.setCenter(latlng.lat(), latlng.lng());
//                        console.log(latlng.lat()+"    "+latlng.lng());
//                        map.removeMarkers();
                        map.addMarker({
                            lat: latlng.lat(),
                            draggable: true,
                            lng: latlng.lng(),
                            dragend: function(e) {
                                var lat = e.latLng.lat();
                                var lng = e.latLng.lng();
                                map.setCenter(lat, lng);
                                console.log(lat+","+ lng);
                                coordenada = lat+","+ lng;
                                //alert('dragend '+lat+"->"+lng);
                                //console.log(e);
                            }
                        });
                    }
                }
            });
        }

    </script>
@endsection

