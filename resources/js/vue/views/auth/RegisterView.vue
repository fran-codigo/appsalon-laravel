<script setup>
import { inject, ref } from "vue";
import { reset } from "@formkit/vue";
import AuthAPI from "../../api/AuthAPI";

const toast = inject("toast");
const loading = ref(false);

const handleSubmit = async ({ password_confirm, ...formData }) => {
    loading.value = true;
    const formDataNew = {
        ...formData,
        password_confirmation: password_confirm,
    };
    try {
        const { data } = await AuthAPI.register(formDataNew);
        toast.open({
            message: data.message,
            type: "success",
        });

        reset("registerForm");
    } catch (error) {
        toast.open({
            message: Object.values(error.response.data.errors),
            type: "error",
        });
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <p class="text-blue-600 text-center text-xl">App Salón</p>
    <h1 class="text-5xl font-extrabold text-center mt-10">Crear cuenta</h1>
    <p class="text-2xl text-center my-5">
        Crea una cuenta y empieza a reservar citas
    </p>

    <FormKit
        type="form"
        id="registerForm"
        :actions="false"
        incomplete-message="Revisa que todos los datos sean correctos"
        @submit="handleSubmit"
    >
        <FormKit
            type="text"
            label="Nombre"
            name="name"
            placeholder="Tu nombre"
            validation="required"
            :validation-messages="{
                required: 'El nombre es obligatorio',
            }"
        />

        <FormKit
            type="text"
            label="Correo"
            name="email"
            placeholder="Tu correo"
            validation="required|email"
            :validation-messages="{
                required: 'El correo es obligatorio',
                email: 'Ingresa un correo válido',
            }"
        />

        <FormKit
            type="password"
            label="Contraseña"
            name="password"
            placeholder="Tu contraseña"
            validation="required|length:8"
            :validation-messages="{
                required: 'La contraseña es obligatoria',
                length: 'La contraseña debe tener al menos 8 caracteres',
            }"
        />

        <FormKit
            type="password"
            label="Repite tu Contraseña"
            name="password_confirm"
            placeholder="Repite tu contraseña"
            validation="required|confirm"
            :validation-messages="{
                required: 'Repetir contraseña es obligatoria',
                confirm: 'Las contraseñas no son iguales',
            }"
        />

        <FormKit
            type="submit"
            :disabled="loading"
            :classes="{
                submit: true,
                submitLoading: loading,
            }"
            >{{ loading ? "Cargando..." : "Crear Cuenta" }}</FormKit
        >
    </FormKit>
</template>

<style></style>
