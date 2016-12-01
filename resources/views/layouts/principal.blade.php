<!DOCTYPE html>
<html lang="en">
<head>
    <title>D' Rumba</title>

    {!!Html::style('plugins/bootstrap/css/bootstrap.css')!!}

            <!--external css-->
    {!!Html::style('plugins/font-awesome/css/font-awesome.css')!!}
    {!!Html::style('css/zabuto_calendar.css')!!}
    {!!Html::style('plugins/gritter/css/jquery.gritter.css')!!}
    {!!Html::style('plugins/lineicons/style.css')!!}

            <!-- Custom styles for this template -->
    {!!Html::style('css/style.css')!!}
    {!!Html::style('css/style-responsive.css')!!}
    @yield('style')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta name='csrf-param' content='authenticity_token'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

    </style>

</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        @include('layouts.menutop')
    </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        @include('layouts.menuside')
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="col-xs-12">
                @yield('content')
            </div>
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2014 - Alvarez.is
            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>


{{--{!!Html::script('js/Chart.js')!!}--}}

<!-- js placed at the end of the document so the pages load faster -->
{!!Html::script('js/jquery.js')!!}
{!!Html::script('js/jquery-1.8.3.min.js')!!}
{!!Html::script('plugins/bootstrap/js/bootstrap.min.js')!!}
{!!Html::script('plugins/gritter/js/jquery.gritter.js')!!}


{{--{!!Html::script('js/jquery.dcjqaccordion.2.7.js')!!}--}}
{{--{!!Html::script('js/jquery.scrollTo.min.js')!!}--}}
{{--{!!Html::script('js/jquery.nicescroll.js')!!}--}}
{{--{!!Html::script('js/jquery.sparkline.js')!!}--}}
{{--{!!Html::script('js/common-scripts.js')!!}--}}

<!--common script for all pages-->

{{--<script type="text/javascript" src="assets/js/gritter-conf.js"></script>--}}

<!--script for this page-->
{{--<script src="assets/js/sparkline-chart.js"></script>--}}
{{--<script src="assets/js/zabuto_calendar.js"></script>--}}
{!!Html::script('js/inicio.js')!!}
@yield('scripts')


</body>
</html>
