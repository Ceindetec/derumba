@extends('layouts.principal')

@section('style')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 section-heading text-center">

            <div class="row" style="margin-top: 40px;">

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8 col-md-offset-2 subtext">
                                <h3>Ingresa el correo asociado a tu cuenta</h3>
                            </div>
                            {!!Form::open(['id'=>'formEnviarEmail','class'=>'form-horizontal'])!!}

                            <div class="form-group">
                                {!! Form::label('correo', 'E-Mail',['class'=>'col-sm-3 control-label']) !!}
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="email" class="form-control" placeholder="ejemplo@miscanchas.com" name="email" id="correo" required>
                                    </div>
                                </div>
                            </div>

                            <div id="alertContacto" class="">


                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group ">
                                        {{--<input class="btn btn-primary btn-lg" value="Send Message" type="submit" >--}}
                                        <button class="mybutton center-block " type="submit">Enviar <i class="fa fa-spinner fa-pulse fa-3x fa-fw cargando hidden"></i>
                                            <span class="sr-only">Loading...</span> </button>
                                    </div>
                                </div>
                            </div>


                            {!!Form::close()!!}

                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
@endsection