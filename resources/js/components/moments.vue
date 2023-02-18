<template>
    <div>
        <span>{{fecha_creacion}} </span>
    </div>
</template>

<script>
export default {
    props:{
        fecha:{
            type:String,
            require:false
        }
    },
    computed:{
        fecha_creacion(){
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
        }
    }
}
</script>

<style>

</style>
