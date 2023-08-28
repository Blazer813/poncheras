
<template>

    <div>
      <div class="d-flex justify-content-end mb-2">
        <button type="button" @click="nuevoColaborador" class="btn btn-primary">Nuevo</button>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nombre del Colaborador</th>
            <th scope="col">Telefono</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="colaborador in colaboradores" :key="colaborador.idcolaborador">
            <td>{{ colaborador.nombrecompleto }}</td>
            <td>{{ colaborador.telefono }}</td>
            <td>{{ colaborador.correo }}</td>
            <td>{{ colaborador.fcnacimiento }}</td>
            <td>
              <button type="button" @click="editColaborador(colaborador.idcolaborador)" class="btn btn-primary">Editar</button>
              &nbsp;&nbsp;&nbsp;<button type="button" @click="eliminarColaborador(colaborador.idcolaborador)" class="btn btn-danger">Eliminar</button>
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
        colaboradores:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      }
    },
    methods: {

      salirColaborador(){
    window.close();
    window.location.reload();
  },
      mostrarDatos(page = 1){
        axios 
        .get(`/colaborador/list?page=${page}`)
        .then(response => { 
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page; 
          this.colaboradores = response.data.data; 
        });
      },
      editColaborador(id){
        let edit = window.open(`/colaborador/edit/${id}`, `emergente`, `width=${screen.width},height=800`);
                edit.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
      },
      nuevoColaborador(){
        let nuevo = window.open(`/colaborador/nuevo`, `emergente`, `width=${screen.width},height=800` );
        const interval = setInterval(()=>{
            if(nuevo.closed) {
              clearInterval(interval);
              window.location.reload();
            }
          }, 1000);
      },
      eliminarColaborador(id) {
        swal.fire({
                title: 'Eliminar Colaborador',
                html: `Esta seguro de que quiere eliminar el colaborador`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#00695c',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false
            })
            .then((result) => {
                if (result.isConfirmed) {
                    swal.fire({
                        title: 'Eliminar colaborador',
                        html: "Esta acción es irreversible, ¿desea continuar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#00695c',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                        allowOutsideClick: false
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            axios
                                .delete(`/colaborador/${id}`)
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
