<script setup>
import { onMounted, ref, inject } from "vue";
import { useRoute, useRouter } from "vue-router";
import AuthAPI from "../../api/AuthAPI";

const toast = inject("toast");
const route = useRoute();
const router = useRouter();

const { token } = route.params;

const validToken = ref(false);

onMounted(async () => {
    try {
        await AuthAPI.verifyPasswordResetToken(token);
        validToken.value = true;
    } catch (error) {
        toast.open({
            message: error.response.data.errors,
            type: "error",
        });
    }
});

const handleSubmit = async ({ password }) => {
    try {
        const { data } = await AuthAPI.updatePassword(token, { password });
        toast.open({
            message: data.message,
            type: "success",
        });

        setTimeout(() => {
            router.push({ name: "login" });
        }, 1500);
    } catch (error) {
        toast.open({
            message: error.response.data.msg,
            type: "error",
        });
    }
};
</script>

<template>
    <div v-if="validToken" class="">
        <h1 class="text-5xl font-extrabold text-center mt-10">
            Nueva Contraseña
        </h1>
        <p class="text-xl text-center my-5">Coloca tu nueva contraseña</p>

        <FormKit
            id="new-password-form"
            type="form"
            :actions="false"
            incomplete-message="No se pudo enviar, revisa las notificaciones"
            @submit="handleSubmit"
        >
            <FormKit
                type="password"
                label="Contraseña"
                name="password"
                placeholder="Tu Contraseña - Min 8 caracteres"
                validation="required|length:8"
                :validation-messages="{
                    required: 'La contraseña es obligatoria',
                    length: 'La contraseña debe tener al menos 8 caracteres',
                }"
            />

            <FormKit type="submit">Guardar Contraseña</FormKit>
        </FormKit>
    </div>
    <p v-else class="text-center text-xl font-black">Token no válido</p>
</template>
