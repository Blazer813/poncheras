<template>
    <div>
    <div class="col-md-12">
      <div class="tile">
        <h3 class="tile-title">Formulario de Colaborador</h3>
        <div class="tile-body">
          <form>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Nombre</label>
                <input   class="form-control" v-model="data.nombrecompleto" type="text" placeholder="Ingrese el nombre del Colaborador" maxlength="30"> 
              </div>
              <div class="col">
                    <label class="form-label">Telefono</label>
                    <input   class="form-control" v-model="data.telefono" type="number" placeholder="Ingrese el numero de telefono"> 
                  </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label class="form-label">Correo</label>
                <input   class="form-control" v-model="data.correo" type="email" placeholder="Ingrese el correo electronico"> 
              </div>
              <div class="col">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input   class="form-control" v-model="data.fcnacimiento" type="date" placeholder="Ingrese la fecha de nacimiento"> 
                  </div>
            </div>
          </form>
        </div>
        <div class="tile-footer">
          <button v-if="btn.crear" class="btn btn-primary" @click="guardarDatos" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>
              &nbsp;&nbsp;&nbsp;<button v-if="btn.actualizar" class="btn btn-primary" @click="actualizarColaborador" type="button"><i class="bi bi-check-circle-fill me-2"></i>Actualizar</button> 
              &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" @click="salirColaborador"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
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
        idcolaborador: '',
        nombrecompleto: '',
        telefono: '',
        correo: '',
        fcnacimiento: '',
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
idcolaborador: {
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
    this.consultaColaborador(this.idcolaborador);
},

methods: {

  consultaColaborador(id){
    if (this.evento == 'edit'){
      this.btn.crear = false;
      this.btn.actualizar = true;
    }
    if(id != ''){
      axios
      .get('/v1/colaborador/' + id)
      .then(response => {
        console.log(response)
        response = response.data[0];
        this.data.nombrecompleto = response.nombrecompleto;
        this.data.telefono = response.telefono;
        this.data.correo = response.correo;
        this.data.fcnacimiento = response.fcnacimiento;
      });
    }
  },



  salirColaborador(){
    window.close();
  },

  guardarDatos(){
    this.validacion.boolean = true;
    this.validation();
    if (this.validacion.boolean){
      axios
      .post("/v1/colaborador/", this.data)     
        .then(response => {
          response = response.data;
          if(response.type == 'success'){
            swal.fire({
                        title: response.title,
                        html: response.msg,
                        icon: response.type,
                        confirmButtonColor: '#00695c',
                        // cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Continuar',
                        // cancelButtonText: 'Cancelar',
                        allowOutsideClick: false
                    })
                    .then((result) => {
                        if(result.isConfirmed) {
                            if (this.event == 'duplicate') {
                                this.salirMovimiento()
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
    this.data.nombrecompleto = '';
    this.data.telefono = '';
    this.data.correo = '';
    this.data.fcnacimiento = '';
  },
  actualizarColaborador(){
    axios
    .put('/v1/colaborador/' + this.idcolaborador, this.data)
    .then(response => {
      response = response.data
      if (response.type == 'success'){
        swal.fire({
                  title: response.title,
                  html: response.msg,
                  icon: response.type,
                  confirmButtonColor: '#00695c',
                  // cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Continuar',
                  // cancelButtonText: 'Cancelar',
                  allowOutsideClick: false
              })
              .then((result) => {
                if(result.isConfirmed){
                  this.salirColaborador()
                }
              })
          }
          if (response.type == 'error') {
            console.log('error');
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
      },
  validation(){
    if (this.data.nombrecompleto == '' || this.data.nombrecompleto == null){
      this.validacion.title = "Nombre Colaborador";
      this.validacion.texto = "No se ha asignado un nombre colaborador";
      this.validacion.boolean = false;

    }
    if (this.data.telefono == '' || this.data.telefono == null){
      this.validacion.title = "Telefono";
      this.validacion.texto = "No se ha asignado un telefono";
      this.validacion.boolean = false;

    }
    if (this.data.correo == '' || this.data.correo == null){
      this.validacion.title = "Correo";
      this.validacion.texto = "No se ha asignado un correo";
      this.validacion.boolean = false;

    }
    if (this.data.fcnacimiento == '' || this.data.fcnacimiento == null){
      this.validacion.title = "Fecha de nacimiento";
      this.validacion.texto = "No se ha asignado una fecha de nacimiento";
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
  },

}


}
</script>




