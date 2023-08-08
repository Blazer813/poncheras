

import Alpine from 'alpinejs';
import './bootstrap';
import { createApp } from 'vue';



window.Alpine = Alpine;

Alpine.start();




const app = createApp({});


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





app.mount('#app');
