<style>

.slide-container{
    max-width: 1120px;
    width: 100%;
    padding: 40px 0;
}
.slide-content{
    margin: 0 40px;
    background-color: red;
    overflow: hidden;
    border-radius: 25px;
}
.card{
    border-radius: 25px;
    background-color: #FFF;
}
.image-content,
.card-content{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px 14px;
}
.image-content{
    position: relative;
    row-gap: 5px;
    padding: 25px 0;
}
.overlay1{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color: #00695c;
    border-radius: 25px 25px 0 25px;
}
.overlay1::before,
.overlay1::after{
    content: '';
    position: absolute;
    right: 0;
    bottom: -40px;
    height: 40px;
    width: 40px;
    background-color: #00695c;
}
.overlay1::after{
    border-radius: 0 25px 0 0;
    background-color: #FFF;
}
.card-image{
    position: relative;
    height: 150px;
    width: 150px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
}
.card-image .card-img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #00695c;
}
.name{
    font-size: 18px;
    font-weight: 500;
    color: #333;
}
.description{
    font-size: 14px;
    color: #707070;
    text-align: center;
}
.button{
    border: none;
    font-size: 16px;
    color: #FFF;
    padding: 8px 16px;
    background-color: #00695c;
    border-radius: 6px;
    margin: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.button:hover{
    background: #265DF2;
}


</style>

<template>
  <Carousel v-bind="settings" :breakpoints="breakpoints">
    <Slide v-for="movimiento in movimientos" :key="movimiento">
      <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="card swiper-slide">
                    <div class="image-content">
                        <span class="overlay1"></span>

                        <div class="card-image">
                            <img src="img/Wilmer.png" alt="" class="card-img">
                        </div>

                    </div>

                    <div class="card-content">
                      <h5 style="text-align: center">{{ movimiento.nombrecompleto }}</h5>
                      <p><i class="bi bi-coin"></i> Valor deuda: ${{ movimiento.total_deuda }}</p>
                      <p><i class="bi bi-cash"></i> Valor abono: ${{ movimiento.total_abono }}</p>
                      <p><i class="bi bi-wallet2"></i> Saldo: ${{ movimiento.saldo }}</p>
                      <p><i class="bi bi-balloon"></i> Cumpleaños: {{ movimiento.fcnacimiento }}</p>
                        <button class="button">Ver más</button>
                    </div>

                </div>


            </div>

          </div>
    </div>
    </Slide>

    <template #addons>
      <Pagination />
      <Navigation />
    </template>
  </Carousel>


  <highcharts :options="chartOptions" />
</template>

<script setup>
import { ref } from "vue";
const meses = [];
for (let i = 0; i < 12; i++) {
  const date = new Date(0, i);
  const mes = date.toLocaleString('default', { month: 'long' });
  meses.push(mes);
}
const chartOptions = ref({
        chart: {
            renderTo: 'container',
            type: 'line'
        },
        title: {
            text: 'Poncheras'
        },
        xAxis: {
            categories: meses,
            title: {
                text: 'Meses'
            },
            tickInterval: 1
        },
        yAxis: {
            title: {
                text: 'Nº de poncheras'
            },
            tickInterval: 1
        },
        series: [{
            name: 'Poncheras por mes',
            data: []
        }]
    });

</script>
<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Slide, Pagination } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import { ref } from "vue";

export default defineComponent({
  name: 'Empleados',
  components: {
    Pagination,
    Carousel,
    Slide,
    Navigation,
  },
  data: () => ({
    
        movimientos:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      
    // carousel settings
    settings: {
      itemsToShow: 1,
      snapAlign: 'center',
    },
    // breakpoints are mobile first
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 3.5,
        snapAlign: 'center',
      },
      // 1024 and up
      1024: {
        itemsToShow: 5,
        snapAlign: 'start',
      },
    },
  }),
  mounted (){
    this.mostrarDatos();
  },
    methods: {
          mostrarDatos(page = 1) {
            axios
              .get(`/contabilidad/list?page=${page}`)
              .then(response => {
                this.currentPage = response.data.current_page;
                this.lastPage = response.data.last_page;
                this.movimientos = response.data.data;
              })
              .catch(error => {
                console.error('Error al cargar datos:', error);
              });
          },
        }
})

</script>