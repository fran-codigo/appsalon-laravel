<script setup>
import VueTailwindDatePicker from "vue-tailwind-datepicker";
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

    <div class="space-y-8" v-if="!appointment.noServiceSelected">
        <h3 class="text-2xl font-extrabold">Fecha y Hora</h3>

        <div class="lg:flex gap-5 items-start">
            <div class="w-full lg:w-96 flex justify-center rounded-lg">
                <VueTailwindDatePicker
                    i18n="es-mx"
                    as-single
                    no-input
                    v-model="appointment.date"
                />
            </div>

            <div
                class="flex-1 grid grid-cols-2 lg:grid-cols-3 gap-5 mt-5 lg:mt:0"
            >
                <button
                    v-for="hour in appointment.hours"
                    class="block text-blue-500 rounded-lg text-xl font-black p-3 border border-blue-200"
                >
                    {{ hour }}
                </button>
            </div>
        </div>

        <div class="flex justify-end">
            <button
                class="w-full md:w-auto bg-blue-500 hover:bg-blue-800 p-3 rounded-lg font-black text-white"
            >
                Confirmar Reservación
            </button>
        </div>
    </div>
</template>
