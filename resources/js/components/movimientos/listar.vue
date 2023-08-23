<template>
    <div class="row">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" @click="nuevoMovimiento" class="btn btn-primary">Nuevo</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <!-- <th scope="col">it</th> -->
                <th scope="col">Fecha Movimiento</th>
                <th scope="col">Responsable</th>
                <th scope="col">Causante</th>
                <th scope="col">Descripción</th>
                <th scope="col">Tipo de Ponchera</th>
                <th scope="col">Valor Deuda</th>
                <th scope="col">Valor Abono</th>
                <th scope="col">Estado Pago</th>
                <th scope="col">Fecha Pago</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="movimiento in movimientos" :key="movimiento.idmovimiento">
                    <!-- <th scope="row">{{ it+=1 }}</th> -->
                    <td>{{ movimiento.fcmovimiento }}</td>
                    <td>{{ movimiento.colaborador.nombrecompleto }}</td>
                    <td>{{ movimiento.user.name }}</td>
                    <td>{{ movimiento.descripcion }}</td>
                    <td>{{ movimiento.tipo_ponchera.nombreponche }}</td>
                    <td>{{ movimiento.valordeuda }}</td>
                    <td>{{ movimiento.valorabono == null || movimiento.valorabono == '' ? 'No hay abono': movimiento.valorabono}}</td>
                    <td>{{ movimiento.estado_pago.nomestado }}</td>
                    <td>{{ movimiento.fcPago == null ? 'No hay fecha' : movimiento.fcPago }}</td>
                    <td>{{ movimiento.estado.nomestado }}</td>
                    <td>
                        <button type="button" @click="editMovimiento(movimiento.idmovimiento)" class="btn btn-primary">Editar</button>
                        &nbsp;&nbsp;&nbsp;<button type="button" @click="eliminarMovimiento(movimiento.idmovimiento)"  class="btn btn-danger">Eliminar</button>
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
        mounted() {

        },
        data(){
            return{
                movimientos:[],
                it:0,
                currentPage: 1,
                lastPage: 1,
            }
        },
        created(){
            this.mostrarDatos();
        },
        methods: {
            windowClose(){
                window.location.reload();
            },
            mostrarDatos(page = 1){ // Agregamos un parámetro para la página
                axios
                .get(`/movimiento/list?page=${page}`) // Agregamos el parámetro de página en la URL
                .then(response => {
                    this.currentPage = response.data.current_page; // Actualizamos la página actual
                    this.lastPage = response.data.last_page; // Actualizamos la última página
                    this.movimientos = response.data.data; // Actualizamos los datos de movimientos
                });
            },
            editMovimiento(id) {
                let edit = window.open(`/movimiento/edit/${id}`, `emergente`, `width=${screen.width},height=800`);
                edit.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
            },
            nuevoMovimiento(){
                let nuevo = window.open(`/movimiento/nuevo`, `emergente`, `width=${screen.width},height=800`);
                nuevo.addEventListener("beforeunload", function(event){
                    window.location.reload()
                })
            },
            eliminarMovimiento(id) {
                swal.fire({
                        title: 'Eliminar Movimiento',
                        html: `Esta Seguro de que quiere eliminar el movimiento`,
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
                                title: 'Eliminar Movimiento',
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
                                        .delete(`/movimiento/${id}`)
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


