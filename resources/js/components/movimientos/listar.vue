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
                    <td>{{ movimiento.fcpago == null ? 'No hay fecha' : movimiento.fcpago }}</td>
                    <td>{{ movimiento.estado.nomestado }}</td>
                    <td>
                        <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        <li><button type="button" style="width: 100%;" class="btn btn-success" @click="editMovimiento(movimiento.idmovimiento)">Editar</button></li>
                        <li><button type="button" style="width: 100%;" class="btn btn-warning" @click="abonarMovimiento(movimiento.idmovimiento)">Abonar</button></li>
                        <li><button type="button" style="width: 100%;" class="btn btn-danger" @click="eliminarMovimiento(movimiento.idmovimiento)">Eliminar</button></li>
                    </ul>
                    </div>
    <!-- <div class="btn-group btn-group-default">
    <button class="btn btn-default" type="button"><i class="fa fa-bars" aria-hidden="true"></i></button>
    <button style="height: 28px;" data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"><span class="caret"></span></button>
    <ul class="dropdown-menu" style="margin-left: -70px;">
        <li class="btn-warning" data-toggle="tooltip" title="Editar"><a class="edit"><i class="fa fa-edit" style="color:#000000;cursor: pointer;"></i> Editar</a></li>
        <li class="btn-primary" data-toggle="tooltip" title="Ver"><a class="ver"><i class="fa fa-print" style="color:#000000;cursor: pointer;"></i> Ver</a></li>
        <li class="btn-danger" data-toggle="tooltip" title="Eliminar"><a class="delete"><i class="fa fa-trash" style="color:#ffffff;cursor: pointer;"></i> Eliminar</a></li>
    </ul>
</div> -->

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
        <template>
  <Calendar v-model:checkIn="checkIn" v-model:checkOut="checkOut" />
</template>
    </div>
</template>

<script>
import { Calendar } from "vue-calendar-3";
    export default {
        mounted() {
        },
        data(){
            return{
                movimientos:[],
                it:0,
                currentPage: 1,
                lastPage: 1,
                checkIn: null,
                checkOut: null,
            }
        },
        created(){
            this.mostrarDatos();
        },
        components: {
    Calendar,
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
            abonarMovimiento(id) {
                let edit = window.open(`/movimiento/abonar/${id}`, `emergente`, `width=${screen.width},height=800`);
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


