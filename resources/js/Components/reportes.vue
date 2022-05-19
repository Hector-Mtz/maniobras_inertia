<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { onMounted, ref, watch } from 'vue';

var props = defineProps({
    cedis: Object,
    maniobras:Object,
    asistencias:Object,
});

</script>
<template>

     <table class=" table table-striped display">
       <tr>
         <th colspan="6">
            <h4 style="text-align:center">REPORTES</h4>
         </th>
       </tr>
       <tr>
         <th>Filtro de fechas</th>
         <th>Asistencia</th>
       </tr>
       <tr>
         <td>
           <form>
             <input type="date" id="Fecha1Reporte" name="Fecha1Reporte" style="margin:2%;"  required>

             <input type="date" id="Fecha2Reporte" name="Fecha2Reporte"  required>
           </form>
          </td>
          <td>

          </td>
       </tr>
     </table>

</template>
