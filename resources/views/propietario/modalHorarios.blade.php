{!!Html::style('plugins/timepicker/bootstrap-timepicker.min.css')!!}
{!!Html::style('plugins/iCheck/all.css')!!}
<style>
    .border{
        border: solid 2px red;
        padding: 10px;
    }
    #inicio{
        cursor: default;
    }
    #fin, #hInicio, #hFin{
        cursor: pointer;
    }
    .panel-default{
        margin-bottom: 0;
    }
    .no-margin{
        padding: 0;
    }
    #panelNuevoH{
        margin-bottom: 15px;
    }
    .rangoDias{
        color: #0001ff;

    }
    .listaHorario{
        margin-bottom: 5px;
    }
</style>


<div id="NombreDelModal">
    {!!Form::open(['id'=>'formHorario'])!!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4>Configurar horarios de atención</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-default" id="panelNuevoH">
                    {!!Form::open(['id'=>'formHorario'])!!}
                        <div class="panel-heading">
                            <button type="button" class="close" onclick="mostrarAyuda()" style="padding:1px 6px; color: #001cbf;">?</button>
                            <b>Nuevo horario</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6 text-center">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="tooltip" title="Dia inicio!">
                                            <input type="text" class="form-control" id="inicio" name="inicio" readonly value="Lunes">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <div class="form-group">
                                        <div class="input-group" data-toggle="tooltip" title="Dia fin">
                                            <select class="form-control" id="fin" name="fin">
                                                <option value="0">Lunes</option>
                                                <option value="1">Martes</option>
                                                <option value="2">Miércoles</option>
                                                <option value="3">Jueves</option>
                                                <option value="4">Viernes</option>
                                                <option value="5">Sábado</option>
                                                <option value="6">Domingo</option>
                                            </select>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <div class="form-group no-margin">
                                        <label>
                                            Abierto
                                            <input type="radio" class="minimal" id="abierto" name="estado" checked>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-left">
                                    <div class="form-group no-margin">
                                        <label>
                                            Cerrado
                                            <input type="radio" class="minimal" id="cerrado" name="estado">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-center hora">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Desde:</label>
                                            <div class="input-group" data-toggle="tooltip" title="Hora abrir!">
                                                <input type="text" class="form-control timepicker" id="hInicio" name="hInicio" required onkeypress="return false">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 text-center hora">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Hasta:</label>
                                            <div class="input-group" data-toggle="tooltip" title="Hora cerrar!">
                                                <input type="text" class="form-control timepicker" id="hFin" name="hFin" required onkeypress="return false">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <input type="submit" class="btn btn-primary" value="Guardar" id="guardadr">
                        </div>
                    {!!Form::close()!!}
                </div>

                <div class="panel panel-default hidden" id="panelHorarios">
                    <div class="panel-heading text-center"><b>Horarios ingresados</b></div>
                    <div class="panel-body"></div>
                </div>
            </div>





            <div class="col-xs-12" id="divAyuda"></div>

            <div class="col-xs-10 col-xs-offset-1" id="alertar"> </div>


        </div>
    </div>
    <div class="modal-footer hidden" id="footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardar">Guardar</button>
    </div>


</div>


{!!Html::script('plugins/timepicker/bootstrap-timepicker.min.js')!!}
{!!Html::script('plugins/iCheck/icheck.min.js')!!}
<script>
    var horario = '';
    var lunes = null;
    var ultimoCierre = null;
    var ultimoHorario = '';
    $(function(){
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        $('[data-toggle="tooltip"]').tooltip();

        $(".timepicker").timepicker({
            showInputs: false,
            showSeconds: false,
            showMeridian: false,
            minuteStep: 60,
            defaultTime: false
        }).on('show.timepicker', function(e) {
            valorCambiado = "";
            $("#alertar").empty();
            if ($(this).val() == "")
                $(this).timepicker('setTime', '12:00');
            else
                valorCambiado = $(this).val();
        });

        $("#abierto").on('ifChecked', function(e){
            $("#hInicio").removeAttr('disabled');
            $("#hFin").removeAttr('disabled');
            $(".hora").removeClass('hidden');
        })
        .on('ifUnchecked', function(e){
            $("#hInicio").attr('disabled', 'true').val('');
            $("#hFin").attr('disabled', 'true').val('');
            $(".hora").addClass('hidden');
        });

        $("#guardar").on('click', function(e){
            if(horario != ''){
                $(this).attr('disabled', true);
                var sitio = "{{$sitio->id}}";
                $.ajax({
                    type: "POST",
                    context: document.body,
                    url: '{{route('updateInfoSitio')}}',
                    data: "horario="+horario+"&sitio="+sitio,
                    success: function (data) {
                        if(data == "exito"){
                            $("#alertar").html("<div class='alert alert-success alert-dismissible'>" +
                                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
                                    "<span aria-hidden='true'>&times;</span>" +
                                    "</button>" +
                                    "<p>" +
                                    "<b>Correcto!</b> Los horarios del sitio se han actualizado de forma exitosa:" +
                                    "</p>" +
                                    "</div>");
                            $("#hora").removeClass('fa-times-circle no').addClass('fa-check ok').attr('data-original-title', 'Listo!');
                            setTimeout(function(){modalBs.modal('hide');} , 5000);

                        }
                    },
                    error: function (data) {
                    }
                });
            }
        });
    });

    var formulario = $("#formHorario");
    formulario.submit(function(e){
        e.preventDefault();
        var diaInicio = $("#inicio");
        var diaFin = $("#fin");
        var horaInicio = $("#hInicio");
        var horaFin = $("#hFin");
        var mostrar = false;
        var alertar = '';
//        debugger;
        if($("#abierto")[0]['checked']) {
            if(ultimoCierre != null){
                if(parseInt(ultimoCierre) <= parseInt(horaInicio.val())){
                    if($("#fin option:selected")[0]['label'] == "Domingo"){
                        if(lunes != null){
                            if(horaFin.val().split(':')[0] <= parseInt(lunes)){
                                ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                                horario = horario + ultimoHorario;
                                $("#panelNuevoH").addClass('hidden');
                                $("#footer").removeClass('hidden');
                                mostrar = true;
                            }
                            else
                                alertar = 'Este horario, interfiere con el horario ingresado para el dia lunes!';
                        }
                        else {
                            ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                            horario = horario + ultimoHorario;
                            $("#panelNuevoH").addClass('hidden');
                            $("#footer").removeClass('hidden');
                            mostrar = true;
                        }
                    }
                    else {
                        ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                        if (horaFin.val() <= horaInicio.val())
                            ultimoCierre = horaFin.val().split(':')[0];
                        horario = horario + ultimoHorario + ",";
                        if (diaInicio.val() == 'Lunes')
                            lunes = horaInicio.val().split(':')[0];
                        vaciarFormulario();
                        mostrar = true;
                    }
                }
                else
                    alertar = "Este horario, interfiere con el ingresado para "+ultimoHorario;
//                    console.log("cruce con horario ingresado: "+ultimoHorario);
            }
            else {
                if($("#fin option:selected")[0]['label'] == "Domingo"){
                    if(lunes != null){
                        if(horaFin.val().split(':')[0] <= parseInt(lunes)){
                            ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                            horario = horario + ultimoHorario;
                            $("#panelNuevoH").addClass('hidden');
                            $("#footer").removeClass('hidden');

                            mostrar = true;
                        }
                        else
                            alertar = 'Este horario, interfiere con el horario ingresado para el dia lunes!';

                    }
                    else {
                        ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                        horario = horario + ultimoHorario;
                        $("#panelNuevoH").addClass('hidden');
                        $("#footer").removeClass('hidden');

                        mostrar = true;
                    }
                }
                else {
                    if (horaFin.val() <= horaInicio.val())
                        ultimoCierre = horaFin.val().split(':')[0];

                    ultimoHorario = generarRangoDias() + ":" + horaInicio.val().split(':')[0] + "-" + horaFin.val().split(':')[0];
                    horario = horario + ultimoHorario + ",";

                    if (diaInicio.val() == 'Lunes')
                        lunes = horaInicio.val().split(':')[0];
                    vaciarFormulario();
                    mostrar = true;
                }
            }
        }
        else {
            ultimoHorario = generarRangoDias() + ":Cerrado";
            horario = horario + ultimoHorario;
            mostrar = true;
            if($("#fin option:selected")[0]['label'] != "Domingo") {
                horario = horario + ",";
                ultimoCierre = null;
                vaciarFormulario();
                mostrar = true;
            }
            else{
                $("#panelNuevoH").addClass('hidden');
                $("#footer").removeClass('hidden');
            }
        }

        if (mostrar){
            var explotar = ultimoHorario.split(":");
            var dias = explotar[0].split('-');
            var horarioMostrar = '';
            if (dias.length > 1)
                horarioMostrar = traducirRangoDias(dias[0])+"-"+traducirRangoDias(dias[1]);
            else
                horarioMostrar = traducirRangoDias(dias[0]);
            ultimoHorario = horarioMostrar + ":" + explotar[1];

            $("#panelHorarios").find('.panel-body').append("<div class='row tex-center listaHorario'><div class='col-xs-12 text-center'><b class='rangoDias'>"+horarioMostrar+"</b>: "+explotar[1]+"</div></div>");
            $("#panelHorarios").removeClass("hidden");
        }
        else
            $("#alertar").html("<div class='alert alert-danger alert-dismissible' style='margin-bottom:15px;'>"+
                    "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>"+
                    "<h4><i class='icon fa fa-ban'></i> Horario no admitido</h4> "+ alertar + "<br>Modifica el horario para continuar" +
                    "</div>");

    });

    function vaciarFormulario(){
        var diaInicio = $("#inicio");
        var diaFin = $("#fin");
        var horaInicio = $("#hInicio");
        var horaFin = $("#hFin");
        var data_dia = parseInt(diaFin.prop('selectedIndex'))+1;

        for(var i=0; i<data_dia; i++)
            diaFin.find('option')[0].remove();

        diaInicio.val(diaFin.find('option')[0]['label']);
        $('#abierto').iCheck('check');
        horaInicio.val('');
        horaFin.val('');

    }

    function generarRangoDias(){
        var rango = '';
        if ($("#inicio").val() != $("#fin option:selected").text())
            rango = $("#inicio").val().substring(0, 2) + "-" + $("#fin option:selected").text().substring(0, 2);
        else
            rango = $("#inicio").val().substring(0, 2);

        return rango;
    }

    function mostrarAyuda(){

    }

    function traducirRangoDias(inicialDia){
        var dia = '';
        switch(inicialDia){
            case 'Lu':
                dia = 'Lunes';
                break;
            case 'Ma':
                dia = 'Martes';
                break;
            case 'Mi':
                dia = 'Miercoles';
                break;
            case 'Ju':
                dia = 'Jueves';
                break;
            case 'Vi':
                dia = 'Viernes';
                break;
            case 'Sá':
                dia = 'Sábado';
                break;
            case 'Do':
                dia = 'Domingo';
                break;
        }
        return dia;
    }
</script>