<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import ModalManiobras from '@/Components/DialogModal.vue';
import JetActionSection from '@/Jetstream/ActionSection.vue';
import JetDangerButton from '@/Jetstream/DangerButton.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';

defineProps({
    cedis: Object,
    clientes:Object,
    maniobras:Object,
    turnos:Object,
    users:Object,
    montos:Object
});

//FUNCION PARA RECUPERAR LOS DATOS DEL FORM de CEDIS
const form = useForm({
    nombreCEDIS: '',
    cliente_id: '',
    coordenadas: '',
});

//FUNCION PARA AGREGAR NUEVO CEDIS
const agregarCEDIS = () => {
    form.post(route('cedis.store'), {
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    });
};

//FUNCION PARA RECUPERAR LOS DATOS DEL FORM DE CLIENTES
const cliente = useForm({
    nombreCliente: '',
});

//FUNCION PARA AGREGAR NUEVO CLIENTE
const agregarCliente =   () => {
    cliente.post(route('clientes.store'), {
        onSuccess: () => closeModal(),
        onFinish: () => cliente.reset(),
    });
};

//FUNCION PARA RECUPERAR LOS DATOS DEL FORM DE Maniobras
const maniobra = useForm({
    nombreManiobra: '',
    cedis_id:'',
    activo:''
});

//FUNCION PARA AGREGAR NUEVA MANIOBRA
const agregarManiobra =   () => {
    maniobra.post(route('maniobras.store'), {
        onSuccess: () => closeModal(),
        onFinish: () => maniobra.reset(),
    });
};

//FUNCION PARA RECUPERAR LOS DATOS DEL FORM DE turnos
const turno = useForm({
    NombreTurno: '',
    FechaInicio : '',
    FechaFinal:'',
    HoraInicio:'',
    HoraFinal:'',
    NumeroManiobristas:'',

    cantidad:'',
    maniobras_id:'',

    rango:'',
    nota:''
});

//FUNCION PARA AGREGAR TURNOS
const agregarTurno =   () => {
    turno.post(route('turnos.store'), {
        onFinish: () => turno.reset(),
    });
};

//FUNCION PARA RECUPERAR LOS DATOS DEL FORM DE trabajadores
const trabajador = useForm({
    asistencia: '',
    turno: ''
});

//FUNCION PARA AGREGAR TRABAJADORES
const  agregarTrabajador = () => {
    trabajador.post(route('asistencia.store'), {
        onFinish: () => trabajador.reset(),
    });
};
//FUNCION PARA MODALES
const NuevoCEDIS = ref(false);
const NuevoCliente = ref(false);
const NuevaManiobra = ref(false);
const NuevoTrabajador = ref(false);

const NewCEDIS = () => {
    NuevoCEDIS.value = true;

};

const NewClient =() => {
    NuevoCliente.value = true;

};

const NewManiobra =() => {
    NuevaManiobra.value = true;

};

const NewTrabajador =() => {
    NuevoTrabajador.value = true;

};

const closeModal = () => {
    NuevoCEDIS.value = false;
    NuevoCliente.value = false;
    NuevaManiobra.value = false;
    NuevoTrabajador.value = false;
};

const enviarIdCedisManiobra = (idC, idM) => {
  console.log(idC,idM); //comprobamos si recibimos id
  Inertia.get("/maniobras", {idCedis:idC,idManiobra:idM}, { preserveState: true })
}


</script>

<template>
    <!--HEADER-->
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Maniobras
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                   <div class="container mt-2" >
                      <div class="row table-responsive">
                        <table class=" table table-striped display">
                           <thead>
                             <tr>
                               <th class="p-3">CEDIS <JetButton @click="NewCEDIS">+</JetButton> </th>

                               <th class="p-3">
                                    Maniobras
                                    <JetButton @click="NewManiobra" class="btn-sm" >+</JetButton>
                               </th>

                               <th class="p-3" >Turnos</th>


                               <th class="p-3"  >Notificaciones <JetButton class="btn-sm" @click="NewTrabajador">+</JetButton> </th>

                             </tr>
                           </thead>
                           <tbody>
                           <tr>
                             <td>
                               <tr v-for="cedi in cedis" :key="cedi.id">
                                 <!--SE RECORRE LAS CEDIS-->
                                    <td>
                                         <button class="btn btn-success" @click="enviarIdCedisManiobra(cedi.id)">{{cedi.nombreCEDIS}}</button>
                                    </td>
                               </tr>
                            </td>
                             <td class="p-3" >
                               <tr>
                                  <td >
                                    <tr v-for="maniobra in maniobras" :value="maniobra.id" :key="maniobra.id">
                                      <td><button class="btn btn-success" @click="enviarIdCedisManiobra(maniobra.cedis_id,maniobra.id)">{{maniobra.nombreManiobra}}</button></td> <!--SE DESPLIAGAN LAS MANIOBRAS-->
                                    </tr>
                                  </td>
                               </tr>
                             </td>
                             <td class="p-3">
                             <!--SE DESPLIAGAN LAS TURNOS-->
                               <div class="t-container">
                                 <ul class="t-tabs">
                                   <li class="t-tab">+</li>
                                   <li class="t-tab" v-for="turno in turnos" :value="turno.id" :key="turno.id">{{turno.NombreTurno}}</li>
                                 </ul>
                                 <ul class="t-contents">
                                   <!--FORMULARIO DE INSERCION-->
                                   <li class="t-content">
                                      <form  style="margin-top:5%;" @submit.prevent="agregarTurno" >
                                        <input type="text"  id="maniobras_id"  v-model="turno.maniobras_id" >
                                         <label for="NombreTurno">Turno:</label>
                                         <input type="text" name="NombreTurno" id="NombreTurno" v-model="turno.NombreTurno" placeholder="Nombre del turno">
                                         <label for="FechaInicio">Fecha de inicio</label>
                                         <input type="date" name="FechaInicio" id="FechaInicio" v-model="turno.FechaInicio" required>
                                         <label for="FechaFinal">Fecha de final</label>
                                         <input type="date" name="FechaFinal" id="FechaFinal" v-model="turno.FechaFinal"  required><br><br>
                                         <label for="HoraInicio">Hora de inicio</label>
                                         <input type="time" id="appt" name="HoraInicio" v-model="turno.HoraInicio" required>
                                         <label for="HoraFinal">Hora de final</label>
                                         <input type="time" id="appt" name="HoraFinal" required v-model="turno.HoraFinal"  ><br><br>
                                         <label for="NumeroManiobristas">Numero de maniobristas</label>
                                         <input type="number" placeholder="0/20" name="NumeroManiobristas" v-model="turno.NumeroManiobristas" required>

                                         <!--Datos para tabla tabla de MONTOS-->
                                         <label for="cantidad">Monto $:</label>
                                         <input type="number" name="cantidad" v-model="turno.cantidad"  required>
                                         <br><br>
                                         <!--Fin Datos para tabla tabla de MONTOS-->

                                         <label for="rango">Radio</label>
                                         <div class="spinner-grow spinner-grow-sm" role="status">
                                           <span class="visually-hidden">Loading...</span>
                                         </div>
                                         <input type="number" name="rango" placeholder="0 KM" v-model="turno.rango" required><br><br>
                                         <label for="nota">Notas</label><br>
                                         <textarea name="nota" id="nota" cols="100" rows="5" v-model="turno.nota"></textarea>
                                         <button style="float:right;" class="btn btn-primary mb-3" type="submit">Enviar</button>
                                      </form>
                                   </li>
                                    <!--FORMULARIO DE Edicion-->
                                   <li class="t-content" v-for="turno in turnos" :value="turno.id" :key="turno.id">
                                      <form  style="margin-top:5%;" @submit.prevent="actualizarTurno" >
                                        <input type="text"  id="maniobras_id"  v-model="turno.maniobras_id" hidden  >
                                         <label for="NombreTurno" style="margin:1%;">Turno:</label>
                                         <input type="text" name="NombreTurno" id="NombreTurno" style="margin:1%;" v-model="turno.NombreTurno" placeholder="Nombre del turno">
                                         <label for="FechaInicio" >Fecha de inicio:</label>
                                         <input type="date" name="FechaInicio" id="FechaInicio" style="margin:1%;" v-model="turno.FechaInicio" required>
                                         <label for="FechaFinal" >Fecha de final:</label>
                                         <input type="date" name="FechaFinal" id="FechaFinal" style="margin:1%;" v-model="turno.FechaFinal"  required><br><br>
                                         <label for="HoraInicio" style="margin:1%;">Hora de inicio:</label>
                                         <input type="time" id="appt" name="HoraInicio" v-model="turno.HoraInicio" required style="margin:1%;">
                                         <label for="HoraFinal" style="margin:1%;">Hora de final:</label>
                                         <input type="time" id="appt" name="HoraFinal" required v-model="turno.HoraFinal" style="margin:1%;"  ><br><br>
                                         <label for="NumeroManiobristas" style="margin:1%;">Numero de maniobristas:</label>
                                         <input type="number" placeholder="0/20" name="NumeroManiobristas" v-model="turno.NumeroManiobristas" required >

                                         <!--Datos para tabla tabla de MONTOS-->
                                         <label for="cantidad" style="margin:1%;">Monto $:</label>
                                         <input type="number" name="cantidad" v-model="turno.cantidad"  required>
                                         <br><br>
                                         <!--Fin Datos para tabla tabla de MONTOS-->

                                         <label for="rango" style="margin:1%;">Radio</label>
                                         <div class="spinner-grow spinner-grow-sm" role="status">
                                           <span class="visually-hidden">Loading...</span>
                                         </div>
                                         <input type="number" name="rango" placeholder="0 KM" v-model="turno.rango" required><br><br>
                                         <label for="nota">Notas</label><br>
                                         <textarea name="nota" id="nota" cols="100" rows="5" v-model="turno.nota"></textarea>
                                         <button style="float:right;" class="btn btn-primary mb-3" type="submit">Enviar</button>
                                      </form>
                                   </li>
                                 </ul>
                               </div>
                             </td>
                             <!--SE DESPLIAGAN LAS NOTIFICACIONES-->
                             <td class="p-3">
                                 <div class="content"></div>
                             </td>
                           </tr>
                         </tbody>
                      </table>
                     </div>
                   </div>
                </div>
            </div>

            <!--Modal para AGREGAR CEDIS -->
            <ModalManiobras :show="NuevoCEDIS" @close="closeModal">
                <template #title>
                    Agregar nuevo CEDIS
                </template>

                <template #content>
                    <form @submit.prevent="agregarCEDIS">
                        <label for="nombreCEDIS">Nombre CEDIS:</label>
                        <input type="text" id="nombreCEDIS" name="nombreCEDIS" v-model="form.nombreCEDIS" placeholder="Nombre del CEDIS"><br><br>
                        <label for="cliente_id">Cliente:</label>
                        <select id="cliente_id" v-model="form.cliente_id">
                           <option  v-for="cliente in clientes" :value="cliente.id" :key="cliente.id">{{cliente.nombreCliente}}</option>
                         </select>
                         <JetButton class="btn-sm m-l2" @click="NewClient">+</JetButton>
                         <br><br>
                         <label for="coords">Coordenadas</label>
                         <div id="map"></div>
                         <br>
                         <input type="text" id="coords" name="coordenadas" placeholder="Coordenadas" v-model="form.coordenadas" required> <br><br>
                         <button class="btn btn-success"  type="submit" >Guardar</button>
                     </form><br><br>

                        <JetSecondaryButton  @click="closeModal">
                           Cerrar
                       </JetSecondaryButton>
                </template>
            </ModalManiobras>

            <!--Modal para AGREGAR CLIENTES -->
            <ModalManiobras :show="NuevoCliente" @close="closeModal">
                <template #title>
                    Agregar nuevo cliente
                </template>

                <template #content>
                    <form @submit.prevent="agregarCliente">
                        <label for="nombreCliente">Cliente: </label>
                        <input id="nombreCliente" name="nombreCliente" type="text" placeholder="Nombre de cliente" v-model="cliente.nombreCliente">
                        <button class="btn btn-success"  type="submit" >Guardar</button>
                    </form><br><br>
                     <JetSecondaryButton  @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
            </ModalManiobras>

             <!--Modal para AGREGAR Maniobras -->
            <ModalManiobras :show="NuevaManiobra" @close="closeModal">
                <template #title>
                    Agregar nueva maniobra
                </template>

                <template #content>
                    <form @submit.prevent="agregarManiobra">
                        <label for="nombreManiobra">Nombre de la maniobra: </label>
                        <input id="nombreManiobra" name="nombreManiobra" type="text" placeholder="Nombre de la maniobra" v-model="maniobra.nombreManiobra">
                         <br><br>
                        <label for="cedis_id">CEDIS:</label>
                        <select id="cedis_id" v-model="maniobra.cedis_id">
                           <option  v-for="cedi in cedis" :value="cedi.id" :key="cedi.id">{{cedi.nombreCEDIS}}</option>
                         </select>
                         <br><br>
                         <div class="form-check">
                           <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault1" value="1" v-model="maniobra.activo"  checked>
                           <label class="form-check-label" for="flexRadioDefault1">
                             Activo
                           </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault2" value="0" v-model="maniobra.activo" >
                          <label class="form-check-label" for="flexRadioDefault2">
                            No activo
                          </label>
                        </div>
                        <button class="btn btn-success"  type="submit" >Guardar</button>
                    </form><br><br>
                     <JetSecondaryButton  @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
            </ModalManiobras>

            <!--Modal para AGREGAR Trabajadores -->
            <ModalManiobras :show="NuevoTrabajador" @close="closeModal">
                <template #title>
                    Agregar nuevo trabajador
                </template>

                <template #content>
                    <form @submit.prevent="agregarTrabajador">
                        <label for="turno_id">Turno:</label><br>
                         <select id="turno_id" v-model="trabajador.turno_id">
                           <option  v-for="turno in turnos" :value="turno.id" :key="turno.id">{{turno.NombreTurno}}</option>
                         </select>
                         <br><br>
                         <label for="user_id">Trabajador:</label><br>
                         <select id="user_id" v-model="trabajador.user_id">
                           <option  v-for="user in users" :value="user.id" :key="user.id">{{user.name}}</option>
                         </select>
                         <br><br>
                         <label for="monto_id">Cantidad a pagar:</label><br>
                         <select id="monto_id" v-model="trabajador.monto_id">
                           <option  v-for="monto in montos" :value="monto.id" :key="monto.id">{{monto.cantidad}}</option>
                         </select>
                         <br><br>
                         <label for="asistencia">Asistencia</label>
                         <div class="form-check">
                           <input class="form-check-input" type="radio" name="asistencia" id="flexRadioDefault1" value="1" v-model="trabajador.asistencia"  checked>
                           <label class="form-check-label" for="flexRadioDefault1">
                             Si
                           </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="activo" id="flexRadioDefault2" value="0" v-model="trabajador.asistencia" >
                          <label class="form-check-label" for="flexRadioDefault2">
                            No
                          </label>
                        </div>
                        <br>
                        <button class="btn btn-success"  type="submit" >Guardar</button>
                    </form><br><br>
                     <JetSecondaryButton  @click="closeModal">
                        Cerrar
                     </JetSecondaryButton>
                </template>
            </ModalManiobras>
        </div>
    </AppLayout>
</template>
