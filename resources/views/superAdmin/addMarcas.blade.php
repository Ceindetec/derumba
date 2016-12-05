@extends('layouts.principal')

@section('style')
    {!!Html::style('plugins/jquery-ui-1.12.1/jquery-ui.css')!!}
    <style>
        .pn {
            height: 100%;
            box-shadow: 0 2px 1px rgba(0, 0, 0, 0.2);
        }
        @media (min-width: 768px) {
            .form-horizontal .control-label {
                text-align: right;
            }
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <h1><b>nuevas marcas</b></h1>
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!!Html::script('plugins/jquery-ui-1.12.1/jquery-ui.js')!!}

    <script>

        $(function () {

            var formbuscarUser = $("#formbuscarUser");
            formbuscarUser.submit(function (e) {
                e.preventDefault();

                traerUserXEmail($("#usuario").val());
            });

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
                url: '{{route('traerUserXEmail')}}',
                data: {"email": email},
                success: function (data) {

                    console.log(data);

                    $("#infUser").html(data);
                },
                error: function () {
                    console.log('ok');
                }
            });
        }


    </script>
@endsection