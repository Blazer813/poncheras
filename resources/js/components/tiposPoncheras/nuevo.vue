<template>
    <div>
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Formulario de Tipos de Poncheras</h3>
        <div class="tile-body">
          <form>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Nombre Tipo de Ponchera</label>
                <input   class="form-control" v-model="data.nombreponche" type="text" placeholder="Ingrese el nombre del Tipo de Ponchera">
                <label class="form-label">Valor</label>
                <input   class="form-control" v-model="data.valor" type="number" readonly placeholder="Ingrese el valor de la ponchera">
              </div>

            </div>
          </form>
        </div>
        <div class="tile-footer">
          <button v-if="btn.crear" class="btn btn-primary" @click="guardarDatos" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>
          &nbsp;&nbsp;&nbsp;<button v-if="btn.actualizar" class="btn btn-primary" @click="actulizarTipoPonchera" type="button"><i class="bi bi-check-circle-fill me-2"></i>Actualizar</button> 
          &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" @click="salirTipoPonchera"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
        </div>
      </div>
    </div>
</div> 
</template>

<script>


export default {
  data() {
    return {
      data: {
        nombreponche: '',
        valor: 2500,
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
  },
    mounted() {
        console.log('Component mounted.')
    }
}

},
props: {
  idponches: {
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
created (){
    this.consultaTipoPonchera(this.idponches)
},

methods: {
    consultaTipoPonchera(id){
        if (this.evento == 'edit') {
            this.btn.crear = false;
            this.btn.actualizar = true;
        }
        if (id != '') {
            axios
            .get('/v1/tiposPoncheras/' + id)
            .then(response => {

                response = response.data[0];
                console.log(response);
                this.data.nombreponche = response.nombreponche;
                this.data.valor = response.valor;
            })
        }
    },

    salirTipoPonchera(){
        window.close();
    },

  guardarDatos(){
    this.validacion.boolean = true;
    this.validation();
    if (this.validacion.boolean){
      axios
      .post("/v1/tiposPoncheras/", this.data)
               
        .then(response => {
          response = response.data;
          if(response.type == 'success'){
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
                            if (this.event == 'duplicate') {
                                this.salirTipoPonchera()
                            } else {
                                this.vaciarForm()
                            }
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
    this.data.nombreponche = '';
    this.data.valor = '';
  },

  actulizarTipoPonchera(){
    this.validacion.boolean = true;
    this.validation();
    if (this.validacion.boolean){
    axios
    .put('/v1/tiposPoncheras/' + this.idponches, this.data)
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
                if(result.isConfirmed){
                  this.salirTipoPonchera()
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
    if (this.data.nombreponche == '' || this.data.nombreponche == null){
      this.validacion.title = "Nombre Tipo Ponchera";
      this.validacion.texto = "No se ha asignado un nombre al tipo de ponchera";
      this.validacion.boolean = false;

    }
    if (this.data.valor == '' || this.data.valor == null){
      this.validacion.title = "Valor";
      this.validacion.texto = "No se ha asignado un valor";
      this.validacion.boolean = false;

    }
  if (this.validacion.boolean == false){
    this.Toast.fire({
      title: this.validacion.title,
      text: this.validacion.texto,
      icon: this.validacion.icon,
      timer: 5000
    })
    this.loading = false;
    return;
  }  
  }

}


}
</script>




