<template>
    <div>
        {{datos}}
        <button class="btn btn-primary" @click="mostrarid(datos.id)">Mostrar alerta</button>
    </div>
</template>

<script>
export default {
    props:['datos'],
    // computed:{
    //     getdatos(){
    //         return this.datos
    //     }
    // },
    methods:{
        mostrarid(id){
            alert(id)
        }
    }

}
</script>

<style scoped>
    div{
        margin:20px;
        padding: 10px;
        border: 1px solid #ccc;
    }
</style>
