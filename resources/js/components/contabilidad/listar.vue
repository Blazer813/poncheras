<style>



</style>
<template>

    <div class="row">
      <div class="d-flex justify-content-end mb-2">
        </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="col-3">Colaborador</th>
            <th scope="col" class="col-3">Valor Deuda</th>
            <th scope="col" class="col-2">Valor Abono</th>
            <th scope="col" class="col-2">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movimiento in movimientos" :key="movimiento.idmovimientos">
            <td class="col-3">{{ movimiento.nombrecompleto }}</td>
            <td class="col-3">{{ movimiento.total_deuda }}</td>
            <td class="col-2">{{ movimiento.total_abono }}</td>
            <td class="col-2">{{ movimiento.saldo }}</td>
          </tr>
          <tr>
            <td>Total: </td>
            <td>Deuda Total: {{ totalDeuda }} </td>
            <td>Abono Total: {{ totalAbono }}</td>
            <td>Saldo Total: {{ totalSaldo }}</td>
          </tr>
        </tbody>

      
         <!-- Agregar los enlaces de paginación -->
         <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: currentPage === 1 }">
                            <a class="page-link" href="#" @click="mostrarDatos(currentPage - 1)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item" v-for="page in lastPage" :key="page" :class="{ active: currentPage === page }">
                            <a class="page-link" href="#" @click="mostrarDatos(page)">{{ page }}</a>
                        </li>
                        <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                            <a class="page-link" href="#" @click="mostrarDatos(currentPage + 1)" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
      </table>

    </div>      
</template>

<script>
  export default {

    created(){
      this.mostrarDatos();
    },
    mounted (){

      
    },
    data (){
      return{
        movimientos:[],
        it:0,
        currentPage:1,
        lastPage: 1,
        totalDeuda: 0,
        totalAbono: 0,
        totalSaldo: 0
      }
    },
    methods: {
      calcularTotales(){
        console.log(this.movimientos)
        let acumuladorDeuda = 0; 
        let acumuladorAbono = 0;
        let acumuladorSaldo = 0;
        for (let i = 0; i < this.movimientos.length; i++) { 
          acumuladorDeuda += parseInt(this.movimientos[i].total_deuda);
          acumuladorAbono += parseInt(this.movimientos[i].total_abono);
          acumuladorSaldo += parseInt(this.movimientos[i].saldo);
         
        }
        this.totalDeuda = acumuladorDeuda;
        this.totalAbono = acumuladorAbono;
        this.totalSaldo = acumuladorSaldo;
      },

      mostrarDatos(page = 1){ // Agregamos un parámetro para la página
                axios
                .get(`/contabilidad/list?page=${page}`) // Agregamos el parámetro de página en la URL
                .then(response => {
                    this.currentPage = response.data.current_page; // Actualizamos la página actual
                    this.lastPage = response.data.last_page; // Actualizamos la última página
                    this.movimientos = response.data.data; // Actualizamos los datos de movimientos

                    this.calcularTotales();
                });
            },
  }
  
  } 
</script>
  