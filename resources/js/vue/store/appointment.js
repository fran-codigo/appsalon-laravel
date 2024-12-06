import { computed, onMounted, ref } from "vue";
import { defineStore } from "pinia";

export const useAppointmentsStore = defineStore("appointments", () => {
    const services = ref([]);
    const date = ref("");
    const hours = ref([]);
    const time = ref("");

    onMounted(() => {
        const startHour = 9;
        const endHour = 18;

        for (let hour = startHour; hour <= endHour; hour++) {
            hours.value.push(hour + ":00");
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

    function createAppointment() {
        const appointment = {
            services: services.value.map((service) => service.id),
            date: date.value,
            time: time.value,
        };
    }

    const isServiceSelected = computed(() => {
        return (id) => services.value.some((service) => service.id === id);
    });

    const noServiceSelected = computed(() => services.value.length === 0);

    return {
        services,
        date,
        hours,
        time,
        onServiceSelected,
        isServiceSelected,
        noServiceSelected,
    };
});
