import { computed, onMounted, ref, inject } from "vue";
import { useRouter } from "vue-router";
import { defineStore } from "pinia";
import { convertToISO } from "../utils/date";
import AppointmentAPI from "../api/AppointmentAPI";

export const useAppointmentsStore = defineStore("appointments", () => {
    const services = ref([]);
    const date = ref("");
    const hours = ref([]);
    const time = ref("");

    const toast = inject("toast");
    const router = useRouter();

    onMounted(() => {
        const startHour = 9;
        const endHour = 18;

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minutes = 0; minutes < 60; minutes += 30) {
                // Aumenta en intervalos de 30 minutos
                const time = `${hour.toString().padStart(2, "0")}:${
                    minutes === 0 ? "00" : "30"
                }`;

                if (hour === endHour && minutes > 0) break;

                hours.value.push(time);
            }
        }
    });

    function setSelectedAppointment(appointment) {
        services.value = appointment.services;

        console.log(services);
    }

    function onServiceSelected(service) {
        if (
            services.value.some(
                (selectedService) => selectedService.id === service.id
            )
        ) {
            services.value = services.value.filter(
                (selectedService) => selectedService.id !== service.id
            );
        } else {
            if (services.value.length === 2) {
                alert("Máximo 2 servicios por cita");
                return;
            }
            services.value.push(service);
        }
    }

    async function createAppointment() {
        const appointment = {
            services: services.value,
            date: convertToISO(date.value),
            time: time.value,
            total: totalAmount.value,
        };

        try {
            const { data } = await AppointmentAPI.create(appointment);
            toast.open({
                message: data.message,
                type: "success",
            });
            clearAppointmentData();
            router.push({ name: "my-appointments" });
        } catch (error) {
            console.log(error);
        }
    }

    function clearAppointmentData() {
        services.value = [];
        date.value = "";
        time.value = "";
    }

    const isServiceSelected = computed(() => {
        return (id) => services.value.some((service) => service.id === id);
    });

    const noServiceSelected = computed(() => services.value.length === 0);

    const totalAmount = computed(() => {
        return services.value.reduce(
            (total, service) => total + service.price,
            0
        );
    });

    const isValidReservation = computed(() => {
        return services.value.length && date.value.length && time.value.length;
    });

    return {
        services,
        date,
        hours,
        time,
        onServiceSelected,
        createAppointment,
        isServiceSelected,
        noServiceSelected,
        totalAmount,
        isValidReservation,
    };
});
