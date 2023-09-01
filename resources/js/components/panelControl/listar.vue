
<style>
body{
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #efefef;
}
.card-imge{
  position: relative;
  height: 120px;
  width: 120px;
  border-radius: 50%;
  background: #fff;
  padding: 3px;
}
  
.card-image .card-img{
  height: 10%;
  width: 10%;
  object-fit: cover;
  border-radius: 60%;
  border: 4px solid 
}




</style>

<template>


<!-- <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row">
        <div v-for="movimiento in movimientos" :key="movimiento.idmovimientos" class="col-md-4">
          <div class="card m-2" style="width: 18rem;">
            <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
              <img src="/img/Wilmer.png" style="max-height: 100%; max-width: 100%;" class="card-img-top" alt="">
            </div>
            <div class="card-body">
              <h5 class="card-title" style="text-align: center">{{ movimiento.nombrecompleto }}</h5>
              <p class="card-text"><i class="bi bi-coin"></i> Valor deuda: ${{ movimiento.total_deuda }}</p>
              <p class="card-text"><i class="bi bi-cash"></i> Valor abono: ${{ movimiento.total_abono }}</p>
              <p class="card-text"><i class="bi bi-wallet2"></i> Saldo: ${{ movimiento.saldo }}</p>
              <p class="card-text"><i class="bi bi-balloon"></i> Cumpleaños: {{ movimiento.fcnacimiento }}</p>
              <a href="#" class="btn btn-primary d-flex justify-content-center">Visitar Perfil</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div> -->
<body>
  <div class="slide-container">
  <div class="slide-content">
    <div class="card-wrapper">
      <div class="card">
          <div class="image-content">
          <span class="overlay"></span>

          <div class="card-image">
          | <img src="/img/Wilmer.png" alt="" class="card-img">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>



    <!-- <div class="row">
      <div class="d-flex justify-content-end mb-2">
        </div>
        <div v-for="movimiento in movimientos" :key="movimiento.idmovimientos" class="card m-2" style="width: 18rem;">
          <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
            <img src="/img/Wilmer.png" style="max-height: 100%; max-width: 100%;" class="card-img-top" alt="">
          </div>
          <div  class="card-body">
            <h5 class="card-title" style="text-align: center">{{ movimiento.nombrecompleto }}</h5>
            <p class="card-text"><i class="bi bi-coin"></i> Valor deuda: ${{ movimiento.total_deuda }}</p>
            <p class="card-text"><i class="bi bi-cash"></i> Valor abono: ${{ movimiento.total_abono }}</p>
            <p class="card-text"><i class="bi bi-wallet2"></i> Saldo: ${{ movimiento.saldo }}</p>
            <p class="card-text"><i class="bi bi-balloon"></i> Cumpleaños: {{ movimiento.fcnacimiento }}</p>
            <a href="#" class="btn btn-primary d-flex justify-content-center">Visitar Perfil</a>
          </div>
        </div>
    </div>       -->
</template>

<script>
  export default {

    mounted (){

      this.mostrarDatos();


    },
    data (){
      return{
        movimientos:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      }
    },
    methods: {
       mostrarDatos(page = 1){ // Agregamos un parámetro para la página
                axios
                .get(`/contabilidad/list?page=${page}`) // Agregamos el parámetro de página en la URL
                .then(response => {
                    this.currentPage = response.data.current_page; // Actualizamos la página actual
                    this.lastPage = response.data.last_page; // Actualizamos la última página
                    this.movimientos = response.data.data; // Actualizamos los datos de movimientos
                });
            },
  }
  
  } 
</script>
  