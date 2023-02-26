<template>
    <table>
        <thead class="thead-dark">
          <tr class="table-active">
            <th scope="col">#</th>
            <th scope="col">Hra Salida</th>
            <th scope="col">Hra Entrada</th>
            <th scope="col">Fecha</th>
            <th scope="col">Empleado</th>
            <th scope="col">Activo</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="salida in salidas" :key="salida" class="table">
            <td scope="row">{{ salida.id_salida }}</td>
            <td>{{ salida.hora_format }}</td>
            <td>{{ salida.entradas.hora_format }}</td>
            <td>{{ salida.fecha_format }}</td>
            <td>{{ salida.entradas.empleados.nombres }}</td>
          
            <td>
            <button id="button" ><span class="fas fa-pen"></span></button>
            <button><span class="fas fa-trash"></span></button>    
         
            </td>
          </tr>
        </tbody>
      </table>
</template>

<script>
    import Apicontrol from '../../../api/apiEmpleado'

export default {

    data() {
        return {
            salidas: null,
        }
    },
     mounted() {
        this.getSalidas()
     }, 
    
    methods: {
        async getSalidas() {
            const { data } = await Apicontrol.get('/apiSalida')
            this.salidas = data.data;

        },
    }
}
</script>

<style scoped>
table {
  margin: 0px auto;
  width: 95%;
  text-align: center;
}

#button {
  margin: 3%;
}
</style>