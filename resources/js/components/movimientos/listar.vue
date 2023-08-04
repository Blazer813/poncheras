<template>
    <div class="container">
        <table>
            <thead>
                <div class="row justify-content-center">    
                    <th>Fecha movimiento</th>
                    <th>Colaborador</th>
                    <th>Descripcion</th>
                    <th>Tipo de ponchera</th>
                    <th>Valor deuda</th>
                    <th>Valor abono</th>
                    <th>Estado pago</th>
                    <th>Fecha pago</th>
                    <th>Estado</th>
                    <th>Fecha anulación</th>
                    <th>Detalles anulación</th>
                </div>
            </thead>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
