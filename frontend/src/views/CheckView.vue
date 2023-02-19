<template>
    <div class="w-full h-100 d-flex justify-center align-center">
        <v-sheet class="pa-4 w-50" min-width="380" rounded="lg" elevation="2">
            <div class="d-lg-flex mb-4 flex-sm-column flex-md-row justify-space-between align-center">
                <h2>{{ mode }}</h2>
                <h4>{{ now }} - {{ hour }} </h4>
            </div>
            <v-form @submit.prevent>
                <v-text-field v-model="employeeForm.username" type="text" label="Introduce tu usuario" />
                <v-text-field v-model="employeeForm.password" type="password" label="Introduce tu contraseña" />
                <v-btn class="w-100" height="50" color="light-blue-darken-2">Enviar</v-btn>
            </v-form>
        </v-sheet>
    </div>
</template>

<script setup lang="ts">
import { useClock, useDate } from '@/composable/Clock';
import { useEmployeeLayoutMode } from '@/composable/EmployeeLayoutMode';
import { reactive } from 'vue';

const { mode } = useEmployeeLayoutMode()
const { hour } = useClock()
const { now } = useDate()

const employeeForm = reactive({
    username: "",
    password: ""
})
</script>