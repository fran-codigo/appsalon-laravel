<script setup>
import { formatCurrency } from "../../utils/index";
import { displayDate } from "../../utils/date";

defineProps({
    appointment: {
        type: Object,
    },
});
</script>

<template>
    <div class="p-5 space-y-3 rounded-lg shadow-md shadow-blue-200">
        <p class="font-gray-500 font-black">
            Fecha: <span>{{ displayDate(appointment.date) }}</span>
        </p>
        <p class="font-black">
            Hora: <span class="font-light">{{ appointment.time }} Horas.</span>
        </p>

        <p class="text-lg font-black">Servicios solicitados en la cita</p>
        <div class="" v-for="service in appointment.services">
            <p>{{ service.name }}</p>
            <p class="text-xl font-black text-blue-500">
                {{ formatCurrency(service.price) }}
            </p>
        </div>
    </div>
</template>
