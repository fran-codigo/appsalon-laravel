<script setup>
import { useAppointmentsStore } from "../../store/appointment";
import SelectedService from "../../components/appointments/SelectedService.vue";
import { formatCurrency } from "../../utils";

const appointment = useAppointmentsStore();
</script>

<template>
    <h2 class="text-3xl font-extrabold">Detalles Cita y Resúmen</h2>
    <p class="text-lg">
        A continuación verifica la información y confirma tu cita
    </p>

    <h3 class="text-2xl font-extrabold">Servicios</h3>

    <p v-if="appointment.noServiceSelected" class="text-xl text-center">
        No hay servicios Seleccionados
    </p>

    <div v-else>
        <div class="grid md:grid-cols-2 gap-5">
            <SelectedService
                v-for="service in appointment.services"
                :key="service.id"
                :service="service"
            />
        </div>

        <p class="mt-5 text-xl">
            Total a pagar:
            <span class="font-black">{{
                formatCurrency(appointment.totalAmount)
            }}</span>
        </p>
    </div>
</template>
