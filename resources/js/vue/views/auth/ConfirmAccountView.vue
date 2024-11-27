<script setup>
import { onMounted, inject } from "vue";
import { useRoute, useRouter } from "vue-router";
import AuthAPI from "../../api/AuthAPI";

const toast = inject("toast");
const route = useRoute();
const router = useRouter();

const { token } = route.params;

onMounted(async () => {
    try {
        const { data } = await AuthAPI.verifyAccount(token);
        toast.open({
            message: data.message,
            type: "success",
        });

        setTimeout(() => {
            router.push({ name: "login" });
        }, 2500);
    } catch (error) {
        toast.open({
            message: error.response.data.errors,
            type: "error",
        });
    }
});
</script>

<template>
    <h1 class="text-5xl font-extrabold text-center my-10">Verificar Cuenta</h1>
</template>
