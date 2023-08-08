<template>
        <div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Formulario de Estado</h3>
            <div class="tile-body">
              <form>
                <div class="row mb-2">
                  <div class="col">
                    <label class="form-label">Nombre estado</label>
                    <input   class="form-control" v-model="data.idestado" type="text" placeholder="Ingrese el nombre del Estado">
                   
                  </div>

                </div>
              </form>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" @click="guardarDatos" type="button"><i class="bi bi-check-circle-fill me-2"></i>Confirmar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="bi bi-x-circle-fill me-2"></i>Cancelar</a>
            </div>
          </div>
        </div>
    </div> 
</template>

<script>
import { toValidAssetId } from '@vue/compiler-core'

 export default {
      data() {
        return {
          data: {
            idestado: '',
            nomestado: '',
      },
      validacion: {
        texto: '',
        icon: 'warning',
        boolean: true,
        title: '',
      },




        mounted() {
            console.log('Component mounted.')
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
    this.consultadEstados();
  },

    methods: {
      consultadEstados(){
        axios
          .get('/v1/estados/@')
          .then(response =>{
              response = response.data;
              this.all.estados = response;
          });
      },

      funcFormData(data){
        const formData = new FormData();
        if(this.idestado != ''){
          formData.append('_method', 'put')

        }

        formData.append("idestado", data.idestado)

        return formData;
      },

      guardarDatos(){
        this.validacion.boolean = true;
        this.validation();
        if (this.validacion.boolean){
          let estados = this.funcFormData(this.data);
          axios
          .post("/v1/estados/", estados,{
            headers: {"content-type": "multipart/form-data", }, })
            .then(response => {
              response = response.data;
              // if (response.type == 'success'){
              //   swal.fire({
              //     title: response.title,
              //     html: response.msg,
              //     icon: response.type,
              //     confirmButtonColor:'#3085d6',
              //     confirmButtonText: 'Continuar',
              //     allowOutsideClick: false
              //   })
              // }
              // if (response)
            })
        }
      },
      validation(){
        if (this.data.idestado == '' || this.data.idestado == null){
          this.validacion.title = "estado";
          this.validacion.texto = "no se ha asignado un estado a este campo";
          this.validacion.boolean = false;

        }
      if (this.validacion.boolean == false){
        toast.fire({
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
   



