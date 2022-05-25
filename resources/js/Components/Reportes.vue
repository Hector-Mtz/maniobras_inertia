<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref, watch } from 'vue';
import axios from 'axios';

var props = defineProps({
    lista:Object
});

const reporte = useForm({
    FechaInicioReporte:'',
    FechaFinalReporte:''
});

//FUNCION PARA CONSULTAR REPORTES
const  consultarReporte = () => {
   console.log(reporte);



}

</script>
<template>
      <h4>Reportes</h4>
      <form  @submit.prevent="consultarReporte">
        <label for="FechaInicioReporte">Fecha inicial:</label>
        <input type="date" name="FechaInicioReporte" id="FechaInicioReporte" v-model="reporte.FechaInicioReporte" style="margin:1%;" required>
        <label for="FechaInicioReporte">Fecha final:</label>
        <input type="date" name="FechaFinalReporte" id="FechaFinalReporte" v-model="reporte.FechaFinalReporte" style="margin:1%;" required>
        <button type="submit" class="btn btn-outline-success">Consultar listas de asistencias</button>
    </form>

</template>
