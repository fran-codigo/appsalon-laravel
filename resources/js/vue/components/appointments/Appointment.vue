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
    <div class="p-5 rounded-lg shadow-md shadow-blue-200 flex flex-col justify-between">
        <div class="space-y-3">
            <p class="font-gray-500 font-black">
                Fecha: <span>{{ displayDate(appointment.date) }}</span>
            </p>
            <p class="font-black">
                Hora:
                <span class="font-light">{{ appointment.time }} Horas.</span>
            </p>

            <p class="text-lg font-black">Servicios solicitados en la cita</p>
            <div class="" v-for="service in appointment.services">
                <p>{{ service.name }}</p>
                <p class="text-xl font-black text-blue-500">
                    {{ formatCurrency(service.price) }}
                </p>
            </div>

            <p class="text-xl font-black text-right py-1">
                Total a pagar:
                <span class="text-blue-500">{{
                    formatCurrency(appointment.total)
                }}</span>
            </p>
        </div>

        <div class="flex gap-2">
            <a
                href=""
                class="bg-cyan-700 rounded-lg p-3 text-white text-sm uppercase font-black flex-1 md:flex-none"
                >Editar cita</a
            >
            <button
                class="bg-red-600 rounded-lg p-3 text-white text-sm uppercase font-black flex-1 md:flex-none"
            >
                Cancelar cita
            </button>
        </div>
    </div>
</template>
