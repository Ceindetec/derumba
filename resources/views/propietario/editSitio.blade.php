@extends('layouts.principal')

@section('style')

    {!!Html::style('plugins/bootstrapFileInput/css/fileinput.min.css')!!}
    {!!Html::style('plugins/ceindetecFileInput/css/ceindetecFileInput.css')!!}

    <style>
        .feature-grid{
            text-align:center;
        }
        .feature-grid img{
            width:100%;
            padding:0em 2em 1em 2em;
        }
        .feature-grid{
            position:relative;
            border: 1px solid #fff;
            padding:1em;
        }
        .feature-grid a{
            text-decoration:none;
        }
        .featured {
            margin-top: 3em;
        }
        .feature-grids{
            margin-top:3em;
        }
        .feature-grid:hover {
            border: 1px solid #eee;
        }
        .feature-grid:hover div.viw{
            display:block;
        }
        .feature-grid:hover div.shrt{
            display:block;
        }
        .feature-grid:hover div.arrival-info h4{
            color:#e8573e;
        }
        .popover-content {
            width: 125px;
        }
        .popover-title {
            color: #000;
            text-align: center;
        }
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

        .feature-grid {
            padding: 0 1em 0 1em;
            margin: 0 auto;
        }

        .eliminar {
            background-color: rgba(195, 195, 195, 0.46);
            border-radius: 50%;
            padding: 5px;
        }

        .feature-grid img {
            padding: 0;
        }

        .manito {
            cursor: pointer;
        }
        .editProfPic {
            position: absolute;
            bottom: 0;
            z-index: 1;
            text-align: right;
            padding-bottom: 9px;
            color: #0c0c0c;
            right: 0;
            padding-right: 15px;
        }

        @media (max-width: 320px) {
            .feature-grid img {
                height: 155px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 321px) and (max-width: 585px) {
            .feature-grid img {
                height: 150px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 586px) and (max-width: 640px) {
            .feature-grid img {
                height: 200px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .feature-grid img {
                height: 150px;
                padding-bottom: 10px;
            }
        }

        @media (min-width: 769px) {
            .feature-grid img {
                height: 200px;
                padding-bottom: 10px;
            }
        }
        .conteEliminar{
            position: relative;
            margin-top: -15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #d8d7dc;
            left: 135px;
        }

        .eliminarImage{
            font-size: 16px;
            margin: 8px 8px;
            cursor: pointer;
        }

        .eliminarImage:hover{

            color: #81161a;
            margin: 8px 8px;
        }
        .contemarca{
            border: solid 1px;
            padding: 3px;
            border-radius: 3px;
        }
        .divConteMarcaDA {
            width: 125px;
            margin: 10px auto;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <div class="row">
            <h1>Sitio: <b>{{$sitio->nombre}}</b></h1>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="margin-top: 20px;">
                    <div class="col-xs-12">
                        {!!Form::open(['id'=>'formImgPerfil','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}

                        <div class="col-md-4 col-md-offset-4">

                                <div class="feature-grid">
                                    <img id="imgPortada" src="data:image/jpg;base64,{{$sitio->getPortada->portada}}" alt="">
                                </div>

                        </div>


                        <div class="form-group">

                            <div class="col-sm-6 col-sm-offset-3" id="divImagen">
                                <input type="file" id="files" name="files[]" required style="width: 200px; height: 35px;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-info center-block" id="submit">Actualizar Imagen</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
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



            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Galeria de Imagenes del sitio </h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 log">
                        <p>Carga las imagenes de tu preferencia para el banner principal de tu Sitio.</p>
                    </div>
                    <div id="imgsSliders" class="feature-grids">
                        @for($i=0;$i<count($imageSlider);$i++)
                            <div class="col-md-3 feature-grid"
                                 data-id={{$imageSlider[$i]->id}}>
                                <div class="editProfPic">
                                    <i class='fa fa-trash fa-2x eliminar eliminarS manito' aria-hidden='true'
                                       data-toggle='confirmation' data-popout="true" data-placement='top'
                                       title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No"></i>
                                </div>
                                <img src="data:image/jpg;base64,{{$imageSlider[$i]->data64}}" alt="">
                            </div>
                        @endfor
                    </div>

                    <div class="row">
                        <div class="col-xs-12" id="divUploadImages">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>




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
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/canvas-to-blob.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/sortable.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/plugins/purify.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/fileinput.min.js')!!}
    {!!Html::script('plugins/bootstrapFileInput/js/locales/es.js')!!}
    {!!Html::script('plugins/ceindetecFileInput/js/ceindetecFileInput.js')!!}

    <script>
        var totalGaleria = 0;
        var map;
        var coordenada;
        var geolocalizacion = "{{$sitio->gelocalizacion}}";
        var sitio = "{{$sitio->id}}";
        $(document).ready(function(){

            {{--totalGaleria = "{!!count($imageSlider)!!}";--}}

            validarUpload(totalGaleria);
            eliminarImgSlider();

            $("#files").inputFileImage({
                maxlength: 1,
                width: 120,
                height: 140,
                maxWidthImage:800,
                maxHeightImage:600,
                minType: ["png","jpeg"],
                maxfilesize: 1024
            });

            $(".div-contenPreviw-inputfile").addClass("hidden");

            $("#files").change(function () {
                $(".div-contenPreviw-inputfile").removeClass("hidden");
            });

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


            var formImgPerfil = $("#formImgPerfil");
            formImgPerfil.submit(function (e) {
                e.preventDefault();

                var formData = new FormData($(this)[0]);
                var files = $("#files").data("files");
                for(i=0;i<files.length;i++){
                    formData.append("imagenes[]", files[i]);
                }
                formData.append("sitio_id", sitio);

                //console.log(formData);

                $.ajax({
                    url: "{!! route('subirImgPerfil') !!}",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (result) {
                        $("#imgPortada").attr("src","data:image/jpg;base64,"+result.data);
                        $(".div-contenPreviw-inputfile").addClass("hidden");
                        $("#formImgPerfil").reset();
                        $(".input-text-label").html("");
                    },
                    error: function (error) {
                        console.log(error);
                    }
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

        function validarUpload($cantImagenes) {
            if ($cantImagenes != 6) {
                $("#divUploadImages").html("<div class='tema'>" +
                        "<label class='control-label'>Seleccionar archivos</label>" +
                        "<input id='inputGalery' name='inputGalery[]' type='file'  multiple class='file-loading' accept='image/*'>" +
                        "</div>");
                imagesUploaded = 0;
                $("#inputGalery").fileinput({
                    uploadAsync: true,
                    uploadUrl: '{{route("subirImagenGaleria")}}',
                    language: "es",
                    maxFileCount: 6 - (totalGaleria),
                    showUpload: true,
                    uploadExtraData: {sitio_id: sitio},
                    previewFileType: 'image',
                    allowedFileTypes: ['image'],
                    allowedFileExtensions: ['jpg','png'],
                    previewSettings: {image: {width: "200px", height: "160px"}},
                    maxImageWidth: 1200,
                    maxImageHeight: 1200,
                    maxFileSize: 2048
                }).on('fileuploaded', function (e, params) {
                    imagesUploaded++;
                    $("#imgsSliders").append("<div class='col-md-3 feature-grid' data-id='" + params.response.id + "' data-ruta='" + params.response.ruta + "'>" +
                            "<div class='editProfPic'>" +
                            "<i class='fa fa-trash fa-2x eliminar eliminarS manito' aria-hidden='true' data-toggle='confirmation' data-popout='true' data-placement='top' title='Eliminar?' data-btn-ok-label='Si' data-btn-cancel-label='No'></i>" +
                            "</div>" +
                            "<img src='data:image/jpg;base64," + params.response.data + "' alt=''>" +
                            "</div>");
                    eliminarImgSlider();
                    if (imagesUploaded == params.files.length) {
                        totalGaleria = parseInt(totalGaleria) + parseInt(imagesUploaded);
                        validarUpload(totalGaleria);
                    }
                });
            }
            else
                $("#divUploadImages").html("");
        }
        function ajaxEliminarImagen(elemento) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('deleteImgGaleria')}}',
                data: "&id=" + elemento.attr('data-id') + "&ruta=" + elemento.attr('data-ruta'),
                success: function (data) {
                    if (data == "exito") {
                        elemento.remove();
                    }
                },
                error: function (data) {
                }
            });
        }


        function eliminarImgSlider() {
            $(".eliminarS").each(function () {
                $(this).confirmation({
                    onConfirm: function () {
                        ajaxEliminarImagen($(this).parent().parent());
                        totalGaleria--;
                        validarUpload(totalGaleria);
                    }
                });
            });
        }
    </script>
@endsection

