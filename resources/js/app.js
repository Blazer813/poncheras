// Import
import Vue from 'vue';
import Movimientos from './components/movimientos/index.vue';

// Componentes
Vue.component('movimientos-index-component', Movimientos);

// Configuración de DataTables 
import './bootstrap';
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs4';
import 'datatables.net-autofill-bs4';
import 'datatables.net-buttons-bs4';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';

// Configuración de Alpine.js
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Instancia de Vue
const app = new Vue({
    el: '#app',
});
