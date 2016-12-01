<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap core CSS -->
  {!!Html::style('plugins/bootstrap/css/bootstrap.css')!!}
    <!--external css-->
  {!!Html::style('plugins/font-awesome/css/font-awesome.css')!!}
        
    <!-- Custom styles for this template -->
  {!!Html::style('css/style.css')!!}
  {!!Html::style('css/style-responsive.css')!!}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
	  <div id="login-page">
	  	<div class="container">
			{!!Form::open(['route' => 'login','class'=>'form-login'])!!}
		        <h2 class="form-login-heading">Iniciar Sesión</h2>
		        <div class="login-wrap">
		            <input type="text" name="email" class="form-control" placeholder="email" autofocus>
		            <br>
		            <input type="password" name="password" class="form-control" placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="{{route("getEmail")}}"> Forgot Password?</a>
		
		                </span>
		            </label>
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" style="text-decoration: none; color: #000;">&times;</a>
							<strong>Ups!</strong> Favor corregir los siguientes errores.<br><br>
							<ul class="text-left">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> Iniciar Sesión</button>
		            <hr>
		            
{{--		            <div class="login-social-link centered">
		            <p>or you can sign in via your social network</p>
		                <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
		                <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
		            </div>--}}
		            <div class="registration">
						¿No tiene una cuenta todavía? <br/>
		                <a class="" href="#">
		                    Create an account
		                </a>
		            </div>
		
		        </div>

			{!!Form::close()!!}
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
	  {!!Html::script('js/jquery.js')!!}
	  {!!Html::script('plugins/bootstrap/js/bootstrap.min.js')!!}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("image/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
