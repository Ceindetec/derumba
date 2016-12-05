<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="text-center">Marcas asociadas  {{$user->getPersona->nombre." ".$user->getPersona->apellido}} </h3></div>
        <div class="panel-body">
            <div class="row">

                @foreach($user->getMarcas as $marca)

                <div class="col-lg-4 col-md-6 col-sm-6 mb">
                    <div class="weather-2 pn">
                        <div class="weather-2-header">
                            <div class="row text-center">
                                <p><i class="pull-left editar fa fa-pencil" aria-hidden="true" data-id="{{$marca->id}}" data-nit="{{$marca->nit}}" data-razon="{{$marca->razon}}" data-iamgen="{{$marca->imagen}}"></i>
                                    {{(strlen($marca->razon)>26)?substr($marca->razon,0,23)."...":$marca->razon}}
                                    <i class="pull-right eliminar fa fa-times" aria-hidden='true' data-id="{{$marca->id}}"
                                                        data-toggle='confirmation' data-popout="true" data-placement='top'
                                                        title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No" aria-hidden="true"></i>
                                </p>

                            </div>
                        </div><!-- /weather-2 header -->
                        <div class="row centered">
                            <img src="image/{{$marca->imagen}}" class="img-circle" width="90" height="90">
                        </div>
                        <div class="row text-center">
                            <h3><b>{{$marca->getSitios->count()}} </b> {{($marca->getSitios->count()!=1)?" Sitios Registrados":" Sitio Registrado"}} </h3>
                        </div>
                    </div>
                </div><! --/col-md-4 -->

                    @endforeach


            </div>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="text-center">Nueva Marca asociada a  {{$user->getPersona->nombre." ".$user->getPersona->apellido}} </h3></div>
        {!!Form::open(['id'=>'formNuevaMarca','files' => true,'class'=>'form-horizontal','autocomplete'=>'off'])!!}
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nit" class="col-sm-4 control-label">Nit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nit" placeholder="Nit" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="razon" class="col-sm-4 control-label">Razón Socia</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="razon"
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
                                        Browse&hellip; <input type="file" style="display: none;" id="file" name="file" required>
                                    </span>
                        </label>
                        <input type="text" class="form-control" onkeypress="return false;" onpaste="return false;" required>
                    </div>
                    <span class="help-block">
                                Try selecting one or more files and watch the feedback
                            </span>
                </div>
            </div>

        </div>
        <div class="panel-footer text-center">
            <div class="row">
                <div class="form-group">
                    <div>
                        <button id="butonSub" type="submit" class="btn btn-default" data-idUser="{{$user->id}}">Guardar nueva marca</button>
                    </div>
                </div>
            </div>

        </div>
        {!!Form::close()!!}
    </div>
</div>