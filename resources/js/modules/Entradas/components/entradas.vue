<template>
    <table>
        <thead class="thead-dark">
            <tr class="table-active">
                <th scope="col">#</th>
                <th scope="col">Hra Entrada</th>
                <th scope="col">Fecha</th>
                <th scope="col"> Empleado</th>
                <th scope="col">Activo</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="entrada in entradas" :key="entrada" class="table">
                <td scope="row">{{ entrada.id_entrada }}</td>
                <td>{{ entrada.hora_format }}</td>
                <td>{{ entrada.fecha_format }}</td>
                <td>{{ entrada.empleados.nombres }}</td>
                <td>
                    <button id="button"><span class="fas fa-pen"></span></button>
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
            entradas: null,
        }
    },
    mounted() {
        this.getEntradas()
    },

    methods: {
        async getEntradas() {
            const { data } = await Apicontrol.get('/apiEntrada')
            this.entradas = data.data;

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