<script setup>
import { RouterLink } from "vue-router";
import { useUsersStore } from "../../store/users";

const user = useUsersStore();
</script>

<template>
    <div class="p-10">
        <h1 class="text-2xl lg:text-5xl font-bold text-center">App Salón</h1>

        <div
            class="flex flex-col md:flex-row md:justify-center items-center space-y-5 md:space-y-0 mt-5 md:gap-12"
        >
            <div class="flex gap-5 items-center">
                <p class="text-right">Hola: {{ user.getUserName }}</p>
                <button
                    type="button"
                    @click="user.logout"
                    class="bg-red-600 hover:bg-red-700 p-2 text-white uppercase text-xs font-extrabold rounded-lg"
                >
                    Cerrar sesión
                </button>
            </div>

            <nav class="flex gap-5 items-center">
                <RouterLink
                    :to="{ name: 'my-appointments' }"
                    class="p-3 uppercase text-xs font-black rounded-lg hover:underline"
                    >Mis Citas</RouterLink
                >
                <RouterLink
                    :to="{ name: 'new-appointment' }"
                    class="p-3 text-gray-200 uppercase text-xs font-black rounded-lg bg-blue-700"
                    >Nueva Cita</RouterLink
                >
            </nav>
        </div>
    </div>

    <main>
        <RouterView />
    </main>
</template>
