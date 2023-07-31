

import Alpine from 'alpinejs';
import './bootstrap';
import { createApp } from 'vue';



window.Alpine = Alpine;

Alpine.start();




const app = createApp({});


//Componentes
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);


app.mount('#app');
