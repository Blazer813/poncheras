<template>
    <div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Formulario de Creación de Ponchera</h3>
            <div class="tile-body">
              <form>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Fecha del movimiento</label>
                    <input class="form-control" v-model="data.fcmovimiento" readonly type="date" placeholder="Seleccione la fecha">
                  </div>
                  <div class="col">
                    <label class="form-label">Colaborador</label>
                    <select class="form-select" v-model="data.idcolaborador" id="floatingSelect" aria-label="Floating label select example">
                      <option v-for="colaborador in all.colaboradores" :value="colaborador.idcolaborador" :key="colaborador.id">{{ colaborador.nombrecompleto }}</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Tipo Ponchera</label>
                    <select class="form-select" v-model="data.idponches" id="floatingSelect" aria-label="Floating label select example">
                      <option selected value="">Seleccione un tipo de ponchera</option>
                      <option v-for="Tponches in all.tponches" :value="Tponches.idponches" :key="Tponches.idponches">{{ Tponches.nombreponche }}</option>
                    </select>
                  </div>
                  <div class="col">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" v-model="data.descripcion" rows="4" placeholder=""></textarea>
                  </div>
                  <div class="col">
                    <label class="form-label">Evidencia</label>
                    <input class="form-control" type="file">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Valor a pagar</label>
                    <input class="form-control" v-model="data.valordeuda" type="number" placeholder="Ingrese el monto">
                  </div>
                  <div class="col">
                    <label class="form-label">Abono a la deuda</label>
                    <input class="form-control" v-model="data.valorabono" type="number" placeholder="Abono a la deuda">
                  </div>
                </div>
                <div  class="row mb-2">
                  <div v-if="data.valorabono != 0 && data.valorabono != 0 " class="col">
                    <label class="form-label">Fecha del pago</label>
                    <input class="form-control" v-model="data.fcpago" type="date" placeholder="Ingrese la fecha del pago">
                  </div>
                  <div class="col">
                    <label class="form-label">Estado</label>
                    <select class="form-select" v-model="data.idestado" id="floatingSelect" aria-label="Floating label select example">
                      <option selected value="">Seleccione un estado</option>
                      <option v-for="estado in all.estados" :value="estado.idestado" :key="estado.id">{{ estado.nomestado }}</option>
                    </select>
                  </div>
                 
                </div>
                <div v-if="data.idestado == 2 " class="row mb-2" >
                  <div class="col">
                    <label class="form-label">Fecha de la anulación</label>
                    <input class="form-control" v-model="data.fcanulacion" type="date" placeholder="Ingrese la fecha de la anulación">
                  </div>
                  <div class="col">
                    <label class="form-label">Detalles de la anulación</label>
                    <textarea class="form-control" v-model="data.detanulacion" rows="4" placeholder=""></textarea>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Estado Pago</label>
                    <select class="form-select" v-model="data.idestadopago" id="floatingSelect" aria-label="Floating label select example">
                      <option v-for="estadopago in all.estadospago" :value="estadopago.idestadopago" :key="estadopago.id">{{ estadopago.nomestado }}</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="tile-footer">
              <button v-if="btn.crear" class="btn btn-primary" @click="guardarDatos" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>
              &nbsp;&nbsp;&nbsp;<button v-if="btn.actualizar" class="btn btn-primary" @click="actualizarMovimiento" type="button"><i class="bi bi-check-circle-fill me-2"></i>Actualizar</button> 
              &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" @click="salirMovimiento"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
            </div>
          </div>
        </div> 
    </div> 
     
</template>

<script>
export default{
  data() {
    return {
      data:{
        fcmovimiento: new Date().toISOString().substr(0, 10),
        idcolaborador:'',
        descripcion:'',
        evidencia: null,
        idponches:'',
        valordeuda: 2500,
        valorabono:'',
        idestadopago: 2,
        fcpago: null,
        idestado: 1,
        detanulacion:'',
        fcanulacion:'',
      },
      all: {
        colaboradores:[],
        tponches:[],
        estadospago:[],
        estados:[],
      },
      validacion: {
        texto: '',
        icon: 'warning',
        boolean: true,
        title: '',
      },
      btn:{
        crear: 1,
        actualizar: 0,
      }
    }
  },
  props:{
    idmovimiento: {
      type: String,
      default(){
        return ''
      }
    },
    evento: {
      type: String,
      default(){
        return ''
      }
    }
  },

  created(){
    this.consultaTPonches();
    this.consultaEstados();
    this.consultaMovimiento(this.idmovimiento);
    this.consultaColaborador();
    this.consultaEstadoPago();
  },

  methods: {
    consultaEstados(){
      axios
        .get('/v1/estados/@')
        .then(response => {
            response = response.data;
            this.all.estados = response;
        });
    },
    salirMovimiento(){
      window.close();
    },

    consultaTPonches(){
      axios
        .get('/v1/tiposPoncheras/@')
        .then(response => {
            response = response.data;
            this.all.tponches = response;
        });
    },

    consultaMovimiento(id){
      if (this.evento == 'edit') {
          this.btn.crear = false;
          this.btn.actualizar = true;
      }
      if(id != ''){
        axios
        .get('/v1/movimientos/' + id)
        .then(response => {
            response = response.data[0];
            console.log(response);
            this.data.fcmovimiento = response.fcmovimiento;
            this.data.idcolaborador = response.colaborador.idcolaborador;
            this.data.idponches = response.tipoPonchera.idponches;
            this.data.descripcion = response.descripcion;
            this.data.valordeuda = response.valordeuda;
            this.data.valorabono = response.valorabono;
            this.data.fcpago = response.fcpago;
            this.data.idestado = response.estado.idestado;
            this.data.fcanulacion = response.fcanulacion;
            this.data.detanulacion = response.detanulacion;
            this.data.idestadopago = response.estadopago.idestadopago;
        });

      }
    },

    consultaColaborador(){
      axios
        .get('/v1/colaborador/@')
        .then(response => {
            response = response.data;
            this.all.colaboradores = response;
        });
    },

    consultaEstadoPago(){
      axios
        .get('/v1/estadopago/@')
        .then(response => {
            response = response.data;
            this.all.estadospago = response;
        });
    },

    funcFormData(data){
      const formData = new FormData();

      if(this.idmovimiento != ''){
        formData.append('_method', 'put')
      }

      formData.append("fcmovimiento", data.fcmovimiento)
      formData.append("idcolaborador", data.idcolaborador)
      formData.append("descripcion", data.descripcion)
      if(data.evidencia != null){
        formData.append("evidencia", data.evidencia)
      }
      formData.append("idponches", data.idponches)
      formData.append("valordeuda", data.valordeuda)
      formData.append("valorabono", data.valorabono)
      formData.append("idestadopago", data.idestadopago)
      if(data.fcpago != null){
        formData.append("fcpago", data.fcpago)
      }
      formData.append("idestado", data.idestado)
      formData.append("detanulacion", data.detanulacion)
      formData.append("fcanulacion", data.fcanulacion)
      
      return formData;
    }, 
    
    guardarDatos(){
      this.validacion.boolean = true;
      this.validation();
      if(this.validacion.boolean){
        let movimiento = this.funcFormData(this.data);
        axios
          .post("/v1/movimientos", movimiento,{ headers: { "Content-Type": "multipart/form-data", }, } )
          .then(response => {
            response = response.data;
            if (response.type == 'success') {
                swal.fire({
                        title: response.title,
                        html: response.msg,
                        icon: response.type,
                        confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar',
                        // cancelButtonText: 'Cancelar',
                        allowOutsideClick: false
                    })
                    .then((result) => {
                        if(result.isConfirmed) {
                                this.vaciarForm()
                        }
                    })
            }
            if (response.type == 'error') {
            this.data.foto1 = null;
            this.imgVieja = null;
            this.Toast.fire({
                title: response.title,
                text: response.msg,
                icon: 'warning',
                timer: 5000,
            });
            }
        })
      }

    },
    vaciarForm(){
      this.data.fcmovimiento = new Date().toISOString().substr(0, 10); 
      this.data.idcolaborador = '';
      this.data.idponches = '';
      this.data.descripcion = '';
      this.data.valordeuda = 2500;
      this.data.valorabono = '';
      this.data.fcpago = '';
      this.data.idestado = 1;
      this.data.fcanulacion = '';
      this.data.detanulacion = '';
      this.data.idestadopago = 2; 
    },
    actualizarMovimiento() {
      this.validacion.boolean = true;
      this.validation();
      if(this.validacion.boolean){
      let movimiento = this.funcFormData(this.data);
      axios
        .post('/v1/movimientos/' + this.idmovimiento, movimiento, { headers: { "Content-Type": "multipart/form-data", },})
        .then(response => {
          response = response.data
          if (response.type == 'success') {
              swal.fire({
                  title: response.title,
                  html: response.msg,
                  icon: response.type,
                  confirmButtonColor: '#3085d6',
                  // cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Continuar',
                  // cancelButtonText: 'Cancelar',
                  allowOutsideClick: false
              })
              .then((result) => {
                  if (result.isConfirmed) {
                      this.salirMovimiento()
                  }
              })
          }
          if (response.type == 'error') {
              this.data.foto1 = null;
              this.imgVieja = null;
              this.Toast.fire({
                  title: response.title,
                  text: response.msg,
                  icon: 'warning',
                  timer: 5000,
              });
          }
        })
        .finally(() => this.loading = false);
      }
        
      },
    validation(){
      if (this.data.idcolaborador == '' || this.data.idcolaborador == null) {
            this.validacion.title = "Colaborador";
            this.validacion.texto = "No se ha asignado un colaborador";
            this.validacion.boolean = false;
        }
      if (this.data.idponches == '' || this.data.idponches == null) {
          this.validacion.title = "Tipo de ponchera";
          this.validacion.texto = "No se ha asignado un tipo de ponchera";
          this.validacion.boolean = false;
        }
      if (this.data.descripcion == '' || this.data.descripcion == null) {
        this.validacion.title = "Descripción";
        this.validacion.texto = "Agregue una descripción";
        this.validacion.boolean = false;
        }
      if (this.validacion.boolean == false) {
            this.Toast.fire({
                title: this.validacion.title,
                text: this.validacion.texto,
                icon: this.validacion.icon,
                timer: 5000
            })
            return;
        }
    },
  }
}
    
</script>
