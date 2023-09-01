

import Alpine from 'alpinejs';
import './bootstrap';
import { createApp } from 'vue';




window.Alpine = Alpine;

Alpine.start();

  

const app = createApp({});


//Alertas Globales
app.config.globalProperties.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
  });

  // import 'bootstrap/dist/css/bootstrap.min.css';
  import 'bootstrap/dist/js/bootstrap.min.js';
  

//Componentes
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import NuevoMovimiento from './components/movimientos/nuevo.vue';
app.component('nuevo-movimiento-comoponent', NuevoMovimiento);

import ListarMovimiento from './components/movimientos/listar.vue';
app.component('listar-movimiento-component', ListarMovimiento);

import NuevoEstado from './components/estados/nuevo.vue';
app.component('nuevo-estado-comoponent', NuevoEstado);

import ListarEstado from './components/estados/listar.vue';
app.component('listar-estado-component', ListarEstado);

import NuevoColaborador from './components/colaboradores/nuevo.vue';
app.component('nuevo-colaborador-component', NuevoColaborador);

import ListarColaborador from './components/colaboradores/listar.vue';
app.component('listar-colaborador-component', ListarColaborador);

import NuevoEstadoPago from './components/estadosPagos/nuevo.vue';
app.component('nuevo-estadopago-component', NuevoEstadoPago);

import ListarEstadoPago from './components/estadosPagos/listar.vue';
app.component('listar-estadopago-component', ListarEstadoPago);

import NuevoTipoPonchera from './components/tiposPoncheras/nuevo.vue';
app.component('nuevo-tipoponchera-component', NuevoTipoPonchera);

import ListarTipoPonchera from './components/tiposPoncheras/listar.vue';
app.component('listar-tipoponchera-component', ListarTipoPonchera);

import ListarContabilidad from './components/contabilidad/listar.vue';
app.component('listar-contabilidad-component', ListarContabilidad);

import ListarPanelControl from './components/panelControl/listar.vue';
app.component('listar-panelcontrol-component', ListarPanelControl)





app.mount('#app');
