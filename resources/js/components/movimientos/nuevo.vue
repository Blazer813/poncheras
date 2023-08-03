<template>
    <div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Formulario de Registro</h3>
            <div class="tile-body">
              <form>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Fecha del movimiento</label>
                    <input class="form-control" v-model="data.fcmovimiento" type="date" placeholder="Seleccione la fecha">
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
                    <label class="form-label">Tipo de ponchera</label>
                    <input class="form-control" v-model="data.idponches" type="" placeholder="Seleccione el tipo de ponchera">
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
                    <label class="form-label">Deuda Total</label>
                    <input class="form-control" v-model="data.valordeuda" type="number" placeholder="Ingrese el monto de la deuda">
                  </div>
                  <div class="col">
                    <label class="form-label">Abono a la deuda</label>
                    <input class="form-control" v-model="data.valorabono" type="number" placeholder="Abono a la deuda">
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col">
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
              <button class="btn btn-primary" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
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
        fcmovimiento: '',
        idcolaborador:'',
        descripcion:'',
        evidencia:'',
        idponches:'',
        valordeuda:'',
        valorabono:'',
        idestadopago: 2,
        fcpago:'',
        idestado:'',
        detanulacion:'',
        fcanulacion:'',
      },
      all: {
        colaboradores:[],
        tponches:[],
        estadospago:[],
        estados:[],
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
    consultaMovimiento(id){
      if(id != ''){
        axios
        .get('/v1/movimientos/' + id)
        .then(response => {
            response = response.data[0];
            this.data.fcmovimiento = response.fcmovimiento;
            this.data.idcolaborador = response.colaborador.idcolaborador;
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
    }
    
  }
}
    
</script>
