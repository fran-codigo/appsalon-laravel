<script setup>
import { inject } from "vue";
import { useRouter } from "vue-router";
import AuthAPI from "../../api/AuthAPI";

const router = useRouter();
const toast = inject("toast");

const handleSubmit = async (formData) => {
    try {
        const {
            data: { token },
        } = await AuthAPI.login(formData);

        localStorage.setItem("AUTH_TOKEN", token);
        router.push({ name: "my-appointments" });
    } catch (error) {
        toast.open({
            message: Object.values(error.response.data.errors),
            type: "error",
        });
    }
};
</script>

<template>
    <p class="text-blue-600 text-center text-xl">App Salón</p>
    <h1 class="text-5xl font-extrabold text-center mt-10">Iniciar Sesión</h1>
    <p class="text-2xl text-center my-5">Si tienes una cuenta, Inicia sesión</p>

    <FormKit
        type="form"
        id="loginForm"
        :actions="false"
        incomplete-message="Revisa que todos los datos sean correctos"
        @submit="handleSubmit"
    >
        <FormKit
            type="text"
            label="Correo"
            name="email"
            placeholder="Tu correo"
            validation="required"
            :validation-messages="{
                required: 'El correo es obligatorio',
            }"
        />

        <FormKit
            type="password"
            label="Contraseña"
            name="password"
            placeholder="Tu contraseña"
            validation="required"
            :validation-messages="{
                required: 'la contraseña es obligatoria',
            }"
        />

        <FormKit type="submit">Iniciar Sesión</FormKit>
    </FormKit>
</template>

<style></style>
