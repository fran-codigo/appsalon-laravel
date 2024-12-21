import { computed, onMounted, ref, inject, watch } from "vue";
import { useRouter } from "vue-router";
import { defineStore } from "pinia";
import { convertToISO, convertToDDMMYYYY } from "../utils/date";
import AppointmentAPI from "../api/AppointmentAPI";
import { useUsersStore } from "./users";

export const useAppointmentsStore = defineStore("appointments", () => {
    const appointmentId = ref(null);
    const services = ref([]);
    const date = ref("");
    const hours = ref([]);
    const time = ref("");
    const appointmentsByDate = ref([]);

    const toast = inject("toast");
    const router = useRouter();
    const user = useUsersStore();

    onMounted(() => {
        const startHour = 9;
        const endHour = 18;

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minutes = 0; minutes < 60; minutes += 30) {
                // Aumenta en intervalos de 30 minutos
                const timeHour = `${hour.toString().padStart(2, "0")}:${
                    minutes === 0 ? "00" : "30"
                }`;

                if (hour === endHour && minutes > 0) break;

                hours.value.push(timeHour);
            }
        }
    });

    watch(date, async () => {
        time.value = "";
        if (date.value === "") return;

        const { data } = await AppointmentAPI.getByDate(date.value);

        if (appointmentId.value) {
            // Se habilita la hora de la cita a editar
            appointmentsByDate.value = data.data.filter(
                (appointment) => appointment.id != appointmentId.value
            );

            time.value = data.data.filter(
                (appointment) => appointment.id === appointmentId.value
            )[0].time;
        } else {
            appointmentsByDate.value = data.data;
        }
    });

    function setSelectedAppointment(appointment) {
        services.value = appointment.services;
        date.value = convertToDDMMYYYY(appointment.date);
        time.value = appointment.time;
        appointmentId.value = appointment.id;
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

    async function saveAppointment() {
        const appointment = {
            services: services.value,
            date: convertToISO(date.value),
            time: time.value,
            total: totalAmount.value,
        };

        if (appointmentId.value) {
            try {
                const { data } = await AppointmentAPI.update(
                    appointmentId.value,
                    appointment
                );
                toast.open({
                    message: data.message,
                    type: "success",
                });
            } catch (error) {
                console.log(error);
            }
        } else {
            try {
                const { data } = await AppointmentAPI.create(appointment);
                toast.open({
                    message: data.message,
                    type: "success",
                });
            } catch (error) {
                console.log(error);
            }
        }

        clearAppointmentData();
        user.getUserAppointments();
        router.push({ name: "my-appointments" });
    }

    function clearAppointmentData() {
        appointmentId.value = "";
        services.value = [];
        date.value = "";
        time.value = "";
    }

    async function cancelAppointment(id) {
        if (confirm("¿Deseas cancelar la cita?")) {
            try {
                const { data } = await AppointmentAPI.cancelAppointment(id);

                toast.open({
                    message: data.message,
                    type: "success",
                });
            } catch (error) {
                console.log(error);
            }
        }
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

    const isDateSelected = computed(() => {
        return date.value ? true : false;
    });

    const disableTime = computed(() => {
        return (hour) => {
            return appointmentsByDate.value.find(
                (appointment) => appointment.time === hour
            );
        };
    });

    return {
        services,
        date,
        hours,
        time,
        setSelectedAppointment,
        onServiceSelected,
        saveAppointment,
        clearAppointmentData,
        cancelAppointment,
        isServiceSelected,
        noServiceSelected,
        totalAmount,
        isValidReservation,
        isDateSelected,
        disableTime,
    };
});
