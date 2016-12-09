@extends('layouts.principal')

@section('style')
    <style>
        .pn {
            height: 100%;
        }
        h3{
            margin: 15px 0;
        }
        #foto, .marca{
            cursor: pointer;
        }
        .marca {
            transition: all .2s ease-out;
        }
        .marca:hover {
            box-shadow: 8px 8px 5px #1f1d90;
            transform: scale(1.05);
        }
        .activar{
            box-shadow: 8px 8px 5px #1f1d90;
            transform: scale(1.05);
            /*border: 1px solid #000fff;*/
        }
        .marginAA{
            margin: 10px 0;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div class="row">
            <h1><b>Administrar Marcas Registradas</b></h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Selecciona la marca que deseas modificar:</h3>
                    </div>
                </div>
                <div class="row marginAA">
                    <div class="col-sm-10 col-sm-offset-1">
                        @foreach($marcas as $marca)
                            <div class="col-lg-4 col-md-6 col-sm-6 mb">
                                <div class="weather-2 pn marca" data-marca="{{$marca->id}}">
                                    <div class="weather-2-header">
                                        <div class="row text-center">
                                            <p>{{$marca->razon}}</p>
                                        </div>
                                    </div>
                                    <div class="row centered">
                                        <img src="/image/{{$marca->imagen}}" class="img-circle fotoMarca" width="90" height="90">
                                    </div>
                                    <div class="row text-center">
                                        <h3><b>{{$marca->getSitios->count()}} </b> {{($marca->getSitios->count()!=1)?" Sitios Registrados":" Sitio Registrado"}} </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="marginAA cargar hidden">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>Selecciona la nueva imagen para la marca:</h3>
                        </div>
                    </div>
                    <div class="row">
                        {!!Form::open(['id'=>'formImagen','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-info">
                                        Buscar&hellip; <input type="file" style="display: none;" id="file" name="file" required>
                                    </span>
                                </label>
                                <input id="foto" type="text" class="form-control" onpaste="return false" onkeypress="return false" required>
                            </div>
                        </div>
                        <div class="col-sm-8 col-sm-offset-2 text-center" style="margin-top: 10px">
                            <button id="butonSub" type="submit" class="btn btn-default">Actualizar</button>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
                <div class="notif marginAA alert"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var seleccionado = null;

        $(document).on('change', ':file', function() {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(function () {
            $(':file').on('fileselect', function(event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                if( input.length )
                    input.val(log);
                else
                    if( log ) alert(log);
            });

            $(".marca").click(function(){
                $(".marca").removeClass("activar");
                seleccionado = $(this);
                seleccionado.addClass("activar");
                $(".cargar").removeClass("hidden");
                $('.notif').removeClass("alert-danger alert-success").addClass("hidden");
            })
            .mouseenter(function(){
                $(".marca").removeClass("activar");
            })
            .mouseleave(function(){
                if (seleccionado != null)
                    seleccionado.addClass("activar");
            });

            $("#foto").click(function(){
                    $("#file").click().blur();
            });

            var formImagen = $("#formImagen");
            formImagen.submit(function(e){
                e.preventDefault();
                if (seleccionado != null){
                    var marca = seleccionado;
                    var formData = new FormData($(this)[0]);
                    formData.append('marca', marca.data("marca"));
                    $.ajax({
                        url: "{!! route('updateImagenMarca') !!}",
                        type: "POST",
                        data: formData,
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,   // tell jQuery not to set contentType
                        success: function (data) {
                            if(data[0] == "exito"){
                                marca.find("img")[0].src = "/image/"+data[1];
                                $("#foto").val("");
                                $("#file").empty();
                                $(".cargar").addClass("hidden");
                                $(".notif").removeClass("alert-danger hidden").addClass("alert-success").html("<b>Correcto!</b> La imagen de la marca ha sido actualizada con extio.");
                                $(".marca").removeClass("activar");
                                window.setTimeout(function(){
                                    $('.notif').removeClass("alert-danger alert-success").addClass("hidden");
                                }, 4000);
                                seleccionado = null;
                            }

                        },
                        error: function (error) {
//                        alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                            console.log(error);
                        }
                    });
                }
                else
                    $(".notif").removeClass("alert-success").addClass("alert-danger").html("<strong>Error!</strong> Primero debes seleccionar una marca");
            });
        });
    </script>
@endsection