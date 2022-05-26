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
   let fechaInicio = reporte.FechaInicioReporte; //rescatamos el valor de fecha de inicio y la guardamos en una variable
   console.log('Fecha inicio '+ fechaInicio) // imprimimos la variable para verla en consola
   let fechaFinal = reporte.FechaFinalReporte;
   console.log('Fecha final '+fechaFinal);

   axios.get('api/lista_asistencia/'+fechaInicio+'/'+fechaFinal+'/reportes')
     .then((resp)=>{
           console.log(resp);
           console.log(resp.data);
           var html_select_montos = '<tr>'
                                    +'<th>CEDIS</th>'
                                    +'<th>Maniobras</th>'
                                    +'<th>Fecha de registro</th>'
                                    +'<th>Fecha inicial</th>'
                                    +'<th>Fecha final</th>'
                                    +'<th></th> </tr>';
           for (let index = 0; index < resp.data.length; index++) { //iteramos los elementos
              //asignamos los valores al html
               html_select_montos +=
                                        '<tr><td>'+ resp.data[index].nombreCEDIS + '</td>'
                                        +'<td>'+ resp.data[index].nombreManiobra +'</td>'
                                        +'<td>'+ resp.data[index].FechaDeRegistro +'</td>'
                                        +'<td>'+ resp.data[index].FechaInicio+'</td>'
                                        +'<td>'+ resp.data[index].FechaFinal+'</td>'
                                        +'<td><a>Descargar Reporte</a></td></tr>';

               $('#datos').html(html_select_montos);
           }
          })
        .catch(function (error) {
           console.log(error);
          });
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

    </table>
</template>
