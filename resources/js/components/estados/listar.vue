
<template>

  
    <div class="row">
      <div class="d-flex justify-content-end mb-2">
            <button type="button" @click="nuevoEstado" class="btn btn-primary">Nuevo</button>
        </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="col-8">Nombre Del Estado</th>
            <th scope="col" class="col-2 ">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="estado in estados" :key="estado.idestado" style="background-color: red;">
            <td class="col-8">{{ estado.nomestado }}</td>
            <td class="col-2">
              <button type="button" @click="editEstados(estado.idestado)" class="btn btn-primary">Editar</button>
              &nbsp;&nbsp;&nbsp;<button type="button" @click="eliminarEstado(estado.idestado)"  class="btn btn-danger">Eliminar</button>
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

          <div class="card">
            <div class="card-header"> 
              <h4 class="card-title">Colabodores</h4>
              <p class="card-category">Poncheras a travez de los meses</p>
            </div>
            <div class="card-body">
              <div id="div_1397441348880" class="ct-chart">
                <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="245px" class="ct-chart-line" style="width: 100%; height: 245px;">
                <g class="ct-grids">
                  <line y1="210" y2="210" x1="50" x2="415.328125" class="ct-grid ct-vertical"  ></line>                                       

                </g>  </svg>
              </div>
            </div>
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
                edit.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
      },

      nuevoEstado(){
        let nuevo = window.open(`/estados/nuevo`, `emergente`,`widht=${screen.width},height=800`);
      },
      eliminarEstado(id) {
                swal.fire({
                        title: 'Eliminar Estado',
                        html: `Esta Seguro de que quiere eliminar el estado`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            swal.fire({
                                title: 'Eliminar Estado',
                                html: "Se eliminará el estado, esta seguro de continuar: ",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Si',
                                cancelButtonText: 'No',
                                allowOutsideClick: false
                            })
                            .then((result) => {
                                if (result.isConfirmed) {
                                    axios
                                        .delete(`/estados/${id}`)
                                        .then(response => {
                                            if (response.data.status == 400) {
                                                Swal.fire({
                                                    icon: response.data.type,
                                                    title: response.data.title,
                                                    text: response.data.msg,
                                                    footer: 'Comuniquese con el adminisitrador para mas información'
                                                })
                                            } else {
                                                this.Toast.fire({
                                                    icon: response.data.type,
                                                    title: response.data.title,
                                                    text: response.data.msg,
                                                    timmer: 5000
                                                });
                                            if(response.status === 200){
                                                this.mostrarDatos();
                                            }
                                            }
                                        })
                                    
                                }
                            })
                        }
                    })
            }


  }
  
  } 
         
</script>
  