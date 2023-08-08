

import Alpine from 'alpinejs';
import './bootstrap';
import { createApp } from 'vue';
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs4';
import 'datatables.net-autofill-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';


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


//Componentes
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import NuevoMovimiento from './components/movimientos/nuevo.vue';
app.component('nuevo-movimiento-comoponent', NuevoMovimiento);

import ListarMovimiento from './components/movimientos/listar.vue';
import { Alert } from 'bootstrap';
app.component('listar-movimiento-component', ListarMovimiento);




app.mount('#app');
