<style>
/* Estilos para el modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 5px;
}
</style>
<template>
    <div class="modal" v-if="showModal">
      <div class="modal-content">
        <button @click="closeModal">Cerrar</button>
        <!-- Mostrar la evidencia -->
        <div v-html="evidencia"></div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      evidencia: String, // Recibe la evidencia como prop
    },
    data() {
      return {
        showModal: false,
      };
    },
    methods: {
      closeModal() {
        this.showModal = false;
      },
    },
  };
  </script>
