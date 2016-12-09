<div class="col-sm-10 col-sm-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="text-center">Marcas asociadas  {{$user->getPersona->nombre." ".$user->getPersona->apellido}} </h3></div>
        <div class="panel-body">
            <div class="row">
                @foreach($user->getMarcas as $marca)
                <div class="col-lg-4 col-md-6 col-sm-6 mb">
                    <div class="weather-2 pn" data-idmarca="{{$marca->id}}">
                        <div class="weather-2-header">
                            <div class="row text-center">
                                <p>
                                    {{(strlen($marca->razon)>26)?substr($marca->razon,0,23)."...":$marca->razon}}
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
</div>