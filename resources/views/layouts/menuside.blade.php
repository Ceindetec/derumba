<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">

        @if(Auth::guest())


        @else


            <p class="centered"><a href="profile.html"><img src="assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
            <h5 class="centered">{{explode("@",Auth::user()->email)[0]}}</h5>


            @if( Auth::user()->rol =="SuperAdmin")
                <li class="mt">
                    <a class="{{ (\Request::route()->getName() == 'registroPropietario') ? 'active' : '' }}" href="{{route("registroPropietario")}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Registrar Propietarios</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-desktop"></i>
                        <span>Administrar</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="{{route("addMarcas")}}">Marcas</a></li>
                        <li><a  href="{{route("addSitios")}}">Sitios</a></li>
                    </ul>
                </li>
            @elseif ( Auth::user()->rol =="Propietario")
                <li class="sub-menu">
                    <a href="{{route("editarPerfil")}}" >
                        <i class="fa fa-desktop"></i>
                        <span>Administrar</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route("editarPerfil")}}">Informacion</a></li>
                        <li><a href="{{route("editarMarcas")}}">Marcas</a></li>
                        <li><a href="{{route("editarSitios")}}">Sitios</a></li>
                    </ul>
                </li>

            @endif
        @endif
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-cogs"></i>
                <span>Components</span>
            </a>
            <ul class="sub">
                <li><a  href="calendar.html">Calendar</a></li>
                <li><a  href="gallery.html">Gallery</a></li>
                <li><a  href="todo_list.html">Todo List</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-book"></i>
                <span>Extra Pages</span>
            </a>
            <ul class="sub">
                <li><a  href="blank.html">Blank Page</a></li>
                <li><a  href="login.html">Login</a></li>
                <li><a  href="lock_screen.html">Lock Screen</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-tasks"></i>
                <span>Forms</span>
            </a>
            <ul class="sub">
                <li><a  href="form_component.html">Form Components</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class="fa fa-th"></i>
                <span>Data Tables</span>
            </a>
            <ul class="sub">
                <li><a  href="basic_table.html">Basic Table</a></li>
                <li><a  href="responsive_table.html">Responsive Table</a></li>
            </ul>
        </li>
        <li class="sub-menu">
            <a href="javascript:;" >
                <i class=" fa fa-bar-chart-o"></i>
                <span>Charts</span>
            </a>
            <ul class="sub">
                <li><a  href="morris.html">Morris</a></li>
                <li><a  href="chartjs.html">Chartjs</a></li>
            </ul>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>