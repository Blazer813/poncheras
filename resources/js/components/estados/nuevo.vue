<template>
        <div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Formulario de Estado</h3>
            <div class="tile-body">
              <form>
                <div class="row mb-2">
                  <div class="col">
                      <label class="form-label">Nombre de estado</label>
                      <input   class="form-control" v-model="data.nomestado" type="text" placeholder="Ingrese el nombre del Estado">
                  </div>
                 <div class="col"> 
                    <label class="form-label">Color de Fondo</label>
                    <input   class="form-control" v-model="data.color_fondo" type="color" placeholder="Ingrese el color del Fondo de Estado">
                  </div>
                  <div class="col"> 
                    <label class="form-label">Color de Letra</label>
                    <input class="form-control" v-model="data.color_letras" type="color" placeholder="Ingrese el Color de letra del Estado">
                  </div>
                </div>
              </form>
            </div>
            <div class="tile-footer">
              <button v-if="btn.crear" class="btn btn-primary" @click="guardarDatos" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>
              &nbsp;&nbsp;&nbsp;<button v-if="btn.actualizar" class="btn btn-primary" @click="actualizarEstado" type="button"><i class="bi bi-check-circle-fill me-2"></i>Actualizar</button> 
              &nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" @click="salirEstado"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
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
            idestado: '',
            nomestado: '',
            color_fondo: '#000000',
            color_letras: '#FFFFFF',
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
  props: {
    idestado: {
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
     this.consultadEstados(this.idestado);
  },

    methods: {

    
      consultadEstados(id){
        if(this.evento == 'edit'){
          this.btn.crear = false;
          this.btn.actualizar = true;
        }
        if(id != ''){ 
          console.log(id);
          axios
          .get('/v1/estados/' + id)
          .then(response =>{
              response = response.data[0];
              this.data.nomestado = response.nomestado;
              this.data.color_fondo = response.color_fondo;
              this.data.color_letras = response.color_letras;
           });
          }
      },

      funFormData(data){
        const formData = new formData();
        if(this.idestado != ''){
          formData.append('_method', 'put')
        }
      },


      salirEstados(){
        window.location.reload();
        window.close();
    },

      guardarDatos(){
        this.validacion.boolean = true;
        this.validation();
        if (this.validacion.boolean){
          axios
          .post("/v1/estados/", this.data)
                   
            .then(response => {
              response = response.data;
              if (response.type == 'success'){
                swal.fire({
                  title: response.title,
                  html: response.msg,
                  icon: response.type,
                  confirmButtonColor:'#3085d6',
                  confirmButtonText: 'Continuar',
                  allowOutsideClick: false
                })
                .then((result) => {
                  if(result.isConfirmed) {
                    if(this.event == 
                    'duplicate'){
                      this.
                      salirEstado()

                      } else {
                      this.vaciarForm()
                      }
                    }
                  })
              }
              if (response.type == 'Error') {
                this.data.foto1 = null;
                this.data.imgVieja = null;
                this.Toast.fire({
                  title: response.title,
                  text: response.msg,
                  icon: 'warning',
                  time:5000,
                });
              }
            })
            .finally(() => this.loading = false);

            nuevo.addEventListener("beforeunload", function(event) {
                    window.location.reload()
                });
        }

        
        
      },
      salirEstado(){
        window.close();
      },
      

      vaciarForm(){
        this.data.nomestado = '';
        this.data.color_fondo = '#000000';
        this.data.color_letras = '#FFFFFF';
      },

      actualizarEstado(){
        this.validacion.boolean = true;
        this.validation();
        if (this.validacion.boolean) {
          axios
          .put('/v1/estados/' + this.idestado, this.data)
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
                  this.salirEstado()

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

      salirEstado(){
        let nuevo = window.close(`/estados/nuevo`, `emergente`,`widht=${screen.width},height=800`);
        nuevo.addEventListener("beforeunload", function(event) {
                    window.location.reload();
                });
      
      },
      validation(){
        if (this.data.nomestado == '' || this.data.nomestado == null){
          this.validacion.title = "Nombre estado";
          this.validacion.texto = "No se ha asignado un nombre al estado";
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
   



