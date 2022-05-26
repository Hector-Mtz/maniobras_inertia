<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, reactive, ref, watch } from 'vue';
import axios from 'axios';

let listaAsistencias = ref([]);

const reporte = useForm({
    FechaInicioReporte:'',
    FechaFinalReporte:''
});

//FUNCION PARA CONSULTAR REPORTES
const  consultarReporte = () => {
   console.log(reporte);
   let fechaInicio = reporte.FechaInicioReporte; //rescatamos el valor de fecha de inicio y la guardamos en una variable
   console.log('Fecha inicio '+ fechaInicio) // imprimimos la variable para verla en consola
   let fechaFinal = reporte.FechaFinalReporte;
   console.log('Fecha final '+fechaFinal);

   axios.get('api/lista_asistencia/'+fechaInicio+'/'+fechaFinal+'/reportes')
     .then((resp)=>{
            //console.log(resp.data);
            listaAsistencias.value = resp.data;
            console.log(listaAsistencias)
          })
        .catch(function (error) {
           console.log(error);
          });
}

const  generarReporte = () => {
     alert('hola');
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


    <table id="datos" class="table">
         <thead>
            <tr>
               <th>CEDIS</th>
               <th>Maniobras</th>
               <th>Fecha de registro</th>
               <th>Fecha inicial</th>
               <th>Fecha final</th>
               <th>Número de inscritos</th>
               <th>Número de asitencias</th>
               <th>Reportes</th>
            </tr>
         </thead>
         <tbody>
         <tr v-for="item in listaAsistencias" :key="item.id">
             <td >{{item.nombreCEDIS}}</td>
             <td>{{item.nombreManiobra}}</td>
             <td>{{item.FechaDeRegistro}}</td>
             <td>{{item.FechaInicio}}</td>
             <td>{{item.FechaFinal}}</td>
             <td></td>
             <td></td>
             <td><button @click="generarReporte()" class="btn btn-outline-primary">Descargar reporte</button></td>
         </tr>
         </tbody>
    </table>
</template>
