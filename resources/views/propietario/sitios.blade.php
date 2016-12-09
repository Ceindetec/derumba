@extends('layouts.principal')

@section('style')
    <style>
        .pn {
            height: 100%;
        }
        h3{
            margin: 15px 0;
        }
        #foto, .marca, .sitio{
            cursor: pointer;
        }
        .marca {
            transition: all .2s ease-out;
        }
        .marca:hover, .sitio:hover{
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
            <h1><b>Administrar Sitios Registrados</b></h1>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Selecciona una marca:</h3>
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
            </div>
        </div>

        <div class="panel panel-default hidden" id="info">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h3>Selecciona el sitio que deseas editar:</h3>
                    </div>
                    <div class="row" class="marginAA">
                        <div class="col-sm-10 col-sm-offset-1" id="sitios"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var seleccionado = null;
        $(function () {
            $(".marca").click(function(){
                $(".marca").removeClass("activar");
                seleccionado = $(this);
                seleccionado.addClass("activar");
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('getSitiosxMarca')}}',
                    data: {"marca": seleccionado.data('marca')},
                    success: function (data) {
                        var html = "";
                        $.each(data,function (index,valor) {
                            ruta = (valor['foto'].length != 0)?valor['foto'][0]['url']:"default.jpg";
                            html = html + "<div class='col-lg-4 col-md-6 col-sm-6 mb'>" +
                                            "<div class='weather-2 pn sitio' data-marca='"+valor['id']+"'>" +
                                                "<div class='weather-2-header'>" +
                                                    "<div class='row text-center'>" +
                                                        "<p>"+valor['nombre']+"</p>" +
                                                    "</div>" +
                                                "</div>" +
                                                "<div class='row centered'>" +
                                                    "<img src='/image/"+ruta+"' class='img-circle fotoMarca' width='90' height='90'>" +
                                                "</div>" +
                                                "<div class='row text-center'>" +
                                                    "<h4><b>"+valor['municipio']+"</b><br>"+valor['departamento']+"</h4>" +
                                                "</div>" +
                                            "</div>" +
                                        "</div>";
                        });
                        $("#sitios").html(html);
                        $("#info").removeClass('hidden');
                    },
                    error: function () {
                        console.log('ok');
                    }
                });
            })
            .mouseenter(function(){
                $(".marca").removeClass("activar");
            })
            .mouseleave(function(){
                if (seleccionado != null)
                    seleccionado.addClass("activar");
            });


            $("#sitios").on("click",".sitio",function () {
                window.location="/propietario/sitio/"+$(this).data('marca');
//                $(".marca").removeClass("activar");
//                seleccionado = $(this);
//                seleccionado.addClass("activar");
//                $(".cargar").removeClass("hidden");
//                $('.notif').removeClass("alert-danger alert-success").addClass("hidden");
            });
        });
    </script>
@endsection