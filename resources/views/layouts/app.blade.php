<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Poncheras EF</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <!-- Font-icon css-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @yield('styles')
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Poncheras</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="bi bi-search"></i></button>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="bi bi-person fs-4"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-gear me-2 fs-5"></i> Configuración</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="bi bi-person me-2 fs-5"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>

    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
        <div>
          <a href=""><p class="app-sidebar__user-name"> {{ auth()->user()->name }}</p></a>
          <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item active" href="{{ route('PanelControlListar') }}"><i class="app-menu__icon bi bi-speedometer"></i><span class="app-menu__label">Panel de Control</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-laptop"></i><span class="app-menu__label">Movimientos</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
             <li>
              <a class="treeview-item" onclick="Nuevo('movimiento')" target="_blank" rel="noopener">
                <i class="icon bi bi-circle-fill"></i> Nuevo</a>
            </li>
            <li>
              <a class="treeview-item" href="{{ route('MovimientoListar') }}">
                <i class="icon bi bi-circle-fill"></i> Listar</a>
            </li>
           
           
            </li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Colaboradores</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" onclick="Nuevo('colaborador')"><i class="icon bi bi-circle-fill"></i> Nuevo</a></li>
            <li>
              <a class="treeview-item" href="{{ route('ColaboradorListar') }}">
              <i class="icon bi bi-circle-fill"></i> Listar</a>
            </li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-ui-checks"></i><span class="app-menu__label">Tipos de Poncheras</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" onclick="Nuevo('tipoponche')"><i class="icon bi bi-circle-fill"></i> Nuevo</a>
            </li>
            <li>
              <a class="treeview-item" href="{{ route('TipoPoncheraListar') }}"><i class="icon bi bi-circle-fill"></i> Listar</a>
            </li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-table"></i><span class="app-menu__label">Estados</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" onclick="Nuevo('estado')" target="_blank" rel="noopener">
              <i class="icon bi bi-circle-fill"></i> Nuevo</a>
            </li>
            <li>
              <a class="treeview-item" href="{{ route('EstadosListar') }}">
              <i class="icon bi bi-circle-fill"></i> Listar</a>
            </li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-file-earmark"></i><span class="app-menu__label">Estados de Pago</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" onclick="Nuevo('estadopago')" target="_blank" rel="noopener">
              <i class="icon bi bi-circle-fill"></i> Nuevo</a>
            </li>
            <li>
              <a class="treeview-item" href="{{ route('EstadoPagoListar') }}">
              <i class="icon bi bi-circle-fill"></i> Listar</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon bi bi-file-earmark"></i><span class="app-menu__label">Contabilidad</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
          <ul class="treeview-menu">
            <li>
              <a class="treeview-item" href="{{ route('Contabilidad') }}">
              <i class="icon bi bi-circle-fill"></i> Listar</a>
            </li>
          </ul>
        </li>

      </ul>
    </aside>
    <main class="app-content">
      @yield('migas')

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div id="app">
              @yield('contenido')
            </div>
          </div>
        </div>
      </div>
      @vite('resources/js/app.js')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ asset('js/plugins/chart.js') }}"></script>
    <script type="text/javascript">
      const salesData = {
      	type: "line",
      	data: {
      		labels: [
      			"Jan",
      			"Feb",
      			"March",
      			"April",
      			"May",
      			"June",
      		],
      		datasets: [{
      			label: 'Monthly Sales',
      			data: [65, 59, 80, 81, 56, 55, 40],
      			fill: false,
      			borderColor: 'rgb(75, 192, 192)',
      			tension: 0.1
      		}]
      	}
      }
      
      const supportRequests = {
      	type: "doughnut",
      	data: {
      		labels: [
      			'In-Progress',
      			'Complete',
      			'Delayed'
      		],
      		datasets: [{
      			label: 'Support Requests',
      			data: [300, 50, 100],
      			backgroundColor: [
      				'#EFCC00',
      				'#5AD3D1',
      				'#FF5A5E'
      			],
      			hoverOffset: 4
      		}]
      	}
      };
      
      const salesChartCtx = document.getElementById('salesChart');
      new Chart(salesChartCtx, salesData);
      
      const supportChartCtx = document.getElementById('supportRequestChart');
      new Chart(supportChartCtx, supportRequests);
    </script>
      
    <script>
      function Nuevo(vista){
        let url = '';
        switch (vista) {
          case 'movimiento':
            url = '/movimiento/nuevo'
            break;
          case 'colaborador':
            url = '/colaborador/nuevo'
            break;
          case 'estado':
            url = '/estados/nuevo'
            break;
          case 'tipoponche':
            url = '/tipoponchera/nuevo'
            break;
          case 'estadopago':
            url = '/estadopago/nuevo'
        
          default:

            break;
        }
        let ventanaEmergente = window.open(url, '_blank', `width=${screen.width},height=800`);
        if (ventanaEmergente === null) {
          console.log('No se pudo abrir la ventana emergente. Es posible que esté bloqueada por el navegador.');
        }
      }

    </script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>
    @yield('js')
  </body>
</html>