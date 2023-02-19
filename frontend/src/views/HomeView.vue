<template>
    <h1>{{ message }} mundo</h1>
</template>

<script setup lang="ts">
import { ref } from 'vue';
const message = ref("Hola")
</script>