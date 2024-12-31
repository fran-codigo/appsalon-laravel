<script setup>
import { inject } from "vue";
import { reset } from "@formkit/vue";
import AuthAPI from "../../api/AuthAPI";

const toast = inject("toast");

const handleSubmit = async ({ email }) => {
    try {
        const { data } = await AuthAPI.forgotPassword({ email });
        toast.open({
            message: data.message,
            type: "success",
        });
        reset("forgot-password");
    } catch (error) {
        toast.open({
            message: error.response.data.errors,
            type: "error",
        });
    }
};
</script>

<template>
    <h1 class="text-5xl font-extrabold text-center mt-10">
        Olvide mi Contraseña
    </h1>
    <p class="text-xl text-center my-5">Recupera el acceso a tu cuenta</p>

    <FormKit
        id="forgot-password"
        type="form"
        :actions="false"
        incomplete-message="No se pudo enviar, revisa las notificaciones"
        @submit="handleSubmit"
    >
        <FormKit
            type="email"
            label="Correo Electrónico"
            name="email"
            placeholder="Tu correo"
            validation="required|email"
            :validation-messages="{
                required: 'El correo es obligatios',
                email: 'Email no válido',
            }"
        />

        <FormKit type="submit">Enviar Instrucciones</FormKit>
    </FormKit>
</template>
