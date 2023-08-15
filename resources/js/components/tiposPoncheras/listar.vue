
<template>

    <div>
      <div class="d-flex justify-content-end mb-2">
        <button type="button" @click="nuevoTipoponchera" class="btn btn-primary">Nuevo</button>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="col-8">Nombre Tipo Ponchera</th>
            <th scope="col" class="col-2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tipoponchera in tiposPonches" :key="tipoponchera.idponches">
            <td class="col-8">{{ tipoponchera.nombreponche }}</td>
            <td class="col-2">
              <button type="button" @click="editTipoponchera(tipoponchera.idponches)" class="btn btn-primary">Editar</button>
              &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger">Eliminar</button>
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
        tiposPonches:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      }
    },
    methods: {
      mostrarDatos(page = 1){
        axios 
        .get(`/tipoponchera/list?page=${page}`)
        .then(response => { 
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page; 
          this.tiposPonches = response.data.data; 
        });
      },
      editTipoponchera(id){
        let edit = window.open(`/tipoponchera/edit/${id}`, `emergente`, `width=${screen.width},height=800`);
                edit.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
      },
      nuevoTipoponchera(){
        let nuevo = window.open(`/tipoponchera/nuevo`, `emergente`, `width=${screen.width},height=800`)
      }
    },

  }
   
</script>
