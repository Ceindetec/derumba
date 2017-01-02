
@if(count($sitios)>0)
<div class="row">
    <h2 class="text-center">Sitios Registrados</h2>
</div>
@endif

@foreach($sitios as $sitio)
    <div class="row">
{!!Form::open(['id'=>'formActualizarSitio'.$sitio->id,'class'=>'form-horizontal'])!!}
<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading resaltado">
            <h3 class="panel-title"><b>Información del sitio</b> <i class="pull-right eliminar fa fa-times" aria-hidden='true' data-id="{{$sitio->id}}"
                                                                    data-toggle='confirmation' data-popout="true" data-placement='top'
                                                                    title='Eliminar?' data-btn-ok-label="Si" data-btn-cancel-label="No" aria-hidden="true"></i></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="nombre{{$sitio->id}}" class="col-sm-4 control-label">Nombre</label>
                        <div class="col-sm-8">
                            {{--<input type="text" class="form-control" id="nombreS" name="nombreS" placeholder="Nombres" required value="{{$sitio->nombre}}">--}}
                            {!! Form::text('nombre',$sitio->nombre,['class'=>"form-control",'placeholder' => 'Nombre del sitio', 'id'=>'nombre'.$sitio->id,'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="telefono{{$sitio->id}}" class="col-sm-4 control-label">Telefono</label>
                        <div class="col-sm-8">
                            {!! Form::text('telefono',$sitio->telefono,['class'=>"form-control",'placeholder' => 'Telefono','id'=>'telefono'.$sitio->id, 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('departamento'.$sitio->id, 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('departamento', $arrayDepartamento, $sitio->getMunicipio->departamento_id, ['class'=>"form-control",'placeholder' => 'Seleccione un Departamento','id'=>'departamento'.$sitio->id, 'required'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" id="divMinucipio">
                        {!! Form::label('municipio_id'.$sitio->id, 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('municipio_id', $sitio->arrayMunicipio, $sitio->municipio_id, ['class'=>"form-control",'placeholder' => 'Selecionar un Municipio', 'id'=>'municipio_id'.$sitio->id,'required'])!!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="alertEdit{{$sitio->id}}" class="col-sm-10 col-sm-offset-1">

                    </div>
            </div>

        </div>
        <div class="panel-footer text-center">
            <div class="row">
                <div class="form-group">
                    <div>
                        <button class="btn btn-default editar" data-id="{{$sitio->id}}">Editar Sitio</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}
    </div>
    @endforeach
<div class="row">
    <h2 class="text-center">Nuevo Sitio</h2>
</div>

<div class="row">
{!!Form::open(['id'=>'formNuevoSitio','class'=>'form-horizontal'])!!}
<div class="col-sm-10 col-sm-offset-1">
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
                            {!! Form::text('nombre',null,['class'=>"form-control",'placeholder' => 'Nombre del sitio', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="telefonoS" class="col-sm-4 control-label">Telefono</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('departamento', 'Departamento (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('departamento', $arrayDepartamento, null, ['id'=>'departamento','class'=>"form-control",'placeholder' => 'Seleccione un Departamento', 'required'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" id="divMinucipio">
                        {!! Form::label('municipio_id', 'Municipio (*)',['class'=>'col-sm-4 control-label']) !!}
                        <div class="col-sm-8">
                            {!!Form::select('municipio_id', [], null, ['id'=>'municipio_id','class'=>"form-control",'placeholder' => 'Selecionar un Municipio', 'required'])!!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer text-center">
            <div class="row">
                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-default">Nuevo Sitio</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
{!!Form::close()!!}
</div>