<script setup>
import { useRoute } from "vue-router";
const route = useRoute();

const authRoutes = [
    // { name: "register", text: "Crear Cuenta" },
    // { name: "forgot-password", text: "Olvide mi contraseña" },
    { name: "login", text: "Iniciar Sesión" },
];
</script>

<template>
    <div class="container mx-auto mt-20 md:h-2/3 lg:w-2/5">
        <nav
            class="mt-10 flex flex-col items-center space-y-5 lg:flex-row lg:justify-between lg:space-y-0"
        >
            <RouterLink
                v-for="authRoute in authRoutes"
                class="uppercase font-bold"
                :to="{ name: authRoute.name }"
                :class="{ hidden: route.name === authRoute.name }"
                >{{ authRoute.text }}</RouterLink
            >
        </nav>
        <RouterView />
    </div>
</template>
