<script setup>
import { formatCurrency } from "../../utils";
import { displayDate } from "../../utils/date";

defineProps({
    appointment: {
        type: Object,
    },
});
</script>

<template>
    <div class="p-5 space-y-3 rounded-lg shadow-md shadow-blue-200">
        <p class="text-gray-500 font-black">
            Fecha:
            <span class="font-light">{{ displayDate(appointment.date) }}</span>
            Hora: <span class="font-light">{{ appointment.time }}</span> Horas.
        </p>

        <p class="text-gray-500 font-black">
            Nombre Cliente:
            <span class="font-light">{{ appointment.user.name }}</span> Email:
            <span class="font-light"> {{ appointment.user.email }}</span>
        </p>

        <p>Servicios solicitados de la cita</p>
        <div v-for="service in appointment.services" class="">
            <p>{{ service.name }}</p>
            <p class="text-2xl font-black text-blue-500">
                {{ formatCurrency(service.price) }}
            </p>
        </div>

        <p class="text-2xl font-black text-right">
            Total a pagar: <span class="text-blue-600">{{formatCurrency(appointment.total)}}</span>
        </p>
    </div>
</template>
