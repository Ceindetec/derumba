@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/jquery-ui-1.12.1/jquery-ui.css')!!}
    <style>
        .pn {
            height: 100%;
            box-shadow: 0 2px 1px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        @media (min-width: 768px) {
            .form-horizontal .control-label {
                text-align: right;
            }
        }

        .marcaSelect{
            box-shadow: 5px 5px 5px rgba(46, 52, 44, 0.86);
        }

        .eliminar {

            cursor: pointer;
        }
        .editar {
            margin-left: 20px;
            margin-top: 5px;
            cursor: pointer;
        }

        .popover-content {
            width: 125px;
        }
        .popover-title {
            color: #000;
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1><b>Administrar Sitios</b></h1>
        </div>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        {!!Form::open(['id'=>'formbuscarUser','class'=>'form-horizontal'])!!}
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="usuario" class="col-sm-4 control-label">Usuario</label>
                                <div class="col-sm-8">
                                    {!!Form::text('usuario',null,['id'=>'usuario','class'=>'form-control','placeholder'=>"usuario a colocar marca de agua", 'required',"onkeyup"=>"buscarUsuario(this)"])!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>

                        </form>

                    </div>
                    <div class="row" id="infUser">

                    </div>
                    <div class="row" id="infSitios">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editarMarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Editar <b>"<span id="tituMarca"></span>"</b></h4>
                </div>
                {!!Form::open(['id'=>'formEditMarca','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}
                <input type="hidden"  name="id" id="idMarca">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nit" class="col-sm-4 control-label">Nit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nit" id="nit" placeholder="Nit" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="razon" class="col-sm-4 control-label">Razón Socia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="razon" id="razon"
                                           placeholder="Razón Socia o Nombre" required>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn btn-info">Guardar Cambios</button>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>





@endsection

@section('scripts')
    {!!Html::script('plugins/jquery-ui-1.12.1/jquery-ui.js')!!}
    {!!Html::script('plugins/bootstrapConfirmation/bootstrap-confirmation.min.js')!!}

    <script>
        var marcaActiva;
        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function() {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        $(function() {
            // We can watch for our custom `fileselect` event like this
            $(':file').on('fileselect', function(event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }
            });

            var formbuscarUser = $("#formbuscarUser");
            formbuscarUser.submit(function (e) {
                e.preventDefault();

                traerUserXEmail($("#usuario").val());
            });

            var formEditMarca = $("#formEditMarca");
            formEditMarca.submit(function (e) {
                var formData = new FormData($(this)[0]);
                e.preventDefault();
                $.ajax({
                    url: "{!! route('editMarca') !!}",
                    type: "POST",
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,   // tell jQuery not to set contentType
                    success: function (result) {
                        traerUserXEmail($("#usuario").val());
                        $("#editarMarca").modal('hide');

                    },
                    error: function (error) {
//                        alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                        console.log(error);
                    }
                });
            });




        });


        $('#editarMarca').on('hidden.bs.modal', function (e) {
            console.log("se cerro el modal");
            var formEditMarca = $("#formEditMarca");
            formEditMarca.reset();
        });


        $("#infUser").on("click", ".pn",function () {
            $(".pn").removeClass("marcaSelect");
            $(this).addClass("marcaSelect");
            marcaActiva=$(this).data("idmarca");
            sitioXMarca();

        });


        function sitioXMarca() {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('sitioXMarca')}}',
                data: {"marca": marcaActiva},
                success: function (data) {
                    //console.log(data);
                    $("#infSitios").html(data);
                    $(".eliminar").each(function () {
                        $(this).confirmation({
                            onConfirm: function () {
                                removeSitio($(this).data("id"));
                            }
                        });
                    });
                },
                error: function () {
                    console.log('ok');
                }
            });
        }

        function removeSitio(id) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('removeSitio')}}',
                data: {"id": id},
                success: function (data) {

                    sitioXMarca()
                },
                error: function () {
                    console.log('ok');
                }
            });
        }


        $("#infSitios").on("click",".editar",function (e) {
            e.preventDefault();
            var id=$(this).data("id");
            var formularioEdit=$("#formActualizarSitio"+id);
           // console.log(formularioEdit.serialize());
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('editarSitio')}}',
                data: formularioEdit.serialize()+"&idSitio="+id,
                success: function (data) {

                    if(data=="exito"){
                        var html='<div class="alert alert-success alert-dismissible">'+
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+
                        '<strong>Perfecto!</strong> La información fue almacenada correctamente'+
                        '</div>';
                        $("#alertEdit"+id).html(html);
                    }
                },
                error: function () {
                    console.log('ok');
                }
            });

        });

        $("#infSitios").on("submit","#formNuevoSitio",function (e) {
            e.preventDefault();
            var formNuevoSitio= $("#formNuevoSitio");
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('nuevoSitio')}}',
                data: formNuevoSitio.serialize()+"&marca_id="+marcaActiva,
                success: function (data) {
                    sitioXMarca();
                },
                error: function () {
                    console.log('ok');
                }
            });

        });

        $("#infSitios").on("change","#departamento", function () {
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

                        });
                    },
                    error: function (data) {
                    }
                });
            }

        });


        $("#infUser").on("submit","#formNuevaMarca",function (e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            var user_id = $("#butonSub").data("iduser");
            formData.append("user_id", user_id);
            $.ajax({
                url: "{!! route('addNuevaMarca') !!}",
                type: "POST",
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                success: function (result) {
                    traerUserXEmail($("#usuario").val());

                },
                error: function (error) {
//                        alert("danger","Ups","algo salio mal por favor intentar nuevamente","<i class='fa fa-ban' aria-hidden='true'></i>");
                    console.log(error);
                }
            });
        });

        $("#infUser").on("click",".editar",function () {
            $("#tituMarca").text($(this).data("razon"));
            $("#nit").val($(this).data("nit"));
            $("#razon").val($(this).data("razon"));
            $("#idMarca").val($(this).data("id"));
            $("#editarMarca").modal('show');
        });

        function buscarUsuario(elemento) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('autoCompleUsuarios')}}',
                data: {"nombre": $(elemento).val()},
                success: function (data) {
                    // console.log(data);
                    $("#usuario").autocomplete({
                        source: data,
                        select: function (event, ui) {
                            traerUserXEmail(ui.item.value);
                        }
                    });
                },
                error: function () {
                    console.log('ok');
                }
            });
        }

        function traerUserXEmail (email) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('traerUserXEmailSitio')}}',
                data: {"email": email},
                success: function (data) {
                    //console.log(data);
                    $("#infUser").html(data);
                    $(".eliminar").each(function () {
                        $(this).confirmation({
                            onConfirm: function () {
                                removeMarca($(this).data("id"));
                            }
                        });
                    });
                    $(document).on('change', ':file', function() {
                        var input = $(this),
                                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [numFiles, label]);
                    });
                    // We can watch for our custom `fileselect` event like this
                    $(':file').on('fileselect', function(event, numFiles, label) {

                        var input = $(this).parents('.input-group').find(':text'),
                                log = numFiles > 1 ? numFiles + ' files selected' : label;

                        if( input.length ) {
                            input.val(log);
                        } else {
                            if( log ) alert(log);
                        }
                    });
                },
                error: function () {
                    console.log('ok');
                }
            });
        }

        function removeMarca(id) {
            $.ajax({
                type: "POST",
                context: document.body,
                url: '{{route('removeMarca')}}',
                data: {"id": id},
                success: function (data) {

                    traerUserXEmail($("#usuario").val());
                },
                error: function () {
                    console.log('ok');
                }
            });
        }
    </script>
@endsection