
<template>

    <div>
      <div class="d-flex justify-content-end mb-2">
        <button type="button" @click="nuevoEstadoPago" class="btn btn-primary">Nuevo</button>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" class="col-8">Nombre Estado Pago</th>
            <th scope="col" class="col-2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="estadopago in estadosPagos" :key="estadopago.idestadopago">
            <td class="col-8">{{ estadopago.nomestado }}</td>
            <td class="col-2">
              <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><button type="button" style="width: 100%;" class="btn btn-success" @click="editEstadosPagos(estadopago.idestadopago)">Editar</button></li>
                        <li><button type="button" style="width: 100%;" class="btn btn-danger" @click="eliminarEstadoPago(estadopago.idestadopago)">Eliminar</button></li>
                    </ul>
              </div>
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
        estadosPagos:[],
        it:0,
        currentPage:1,
        lastPage: 1,
      }
    },
    methods: {
      mostrarDatos(page = 1){
        axios 
        .get(`/estadopago/list?page=${page}`)
        .then(response => { 
          this.currentPage = response.data.current_page;
          this.lastPage = response.data.last_page; 
          this.estadosPagos = response.data.data; 
        });
      },
      editEstadosPagos(id){
        let edit = window.open(`/estadopago/edit/${id}`, `emergente`, `width=${screen.width},height=800`);
                edit.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
      },
      nuevoEstadoPago(){
        let nuevo = window.open(`/estadopago/nuevo`, `emergente`, `width=${screen.width},height=800`);

          const interval = setInterval(()=>{
            if(nuevo.closed) {
              clearInterval(interval);
              window.location.reload();
            }
          }, 1000);
          
        
        // nuevo.addEventListener("beforeunload", function(event){
        //             window.location.reload()
        //         })
      },
      eliminarEstadoPago(id) {
        swal.fire({
                title: 'Eliminar Estado Pago',
                html: `Esta Seguro de que quiere eliminar el estado pago`,
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
                        title: 'Eliminar Estado Pago',
                        html: "Esta acción es irreversible, ¿desea continuar?: ",
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
                                .delete(`/estadopago/${id}`)
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
    },

  }
   
</script>
