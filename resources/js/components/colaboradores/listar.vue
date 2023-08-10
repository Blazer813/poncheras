
<template>

    <div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="col-8">Nombre estado</th>
            <th scope="col" class="col-2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="estado in estados" :key="estado.idestado">
            <td class="col-8">{{ estado.nomestado }}</td>
            <td class="col-2">
              <button type="button" @click="editMovimiento(estado.idestado)" class="btn btn-primary">Editar</button>
              <button type="button" class="btn btn-danger">Eliminar</button>
            </td>
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

    mounted (){

      this.mostrarDatos();


    },
    data (){
      return{
        estados:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      }
    },
    methods: {
      mostrarDatos(page = 1){
        axios 
        .get(`/estados/list?page=${page}`)
        .then(response => { 
          console.log(response)
          this.currentPage = response.data.current_page; // Actualizamos la página actual
          this.lastPage = response.data.last_page; // Actualizamos la última página
          this.estados = response.data.data; // Actualizamos los datos de estados
        });
      },
      editEstados(id){
        let edit =window.open(`/estados/edit/${id}`,`emergente`,`widht=${screen.width},height=800`);
      },
    },

  }
   
</script>
