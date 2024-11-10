<script setup></script>

<template>
    <p class="text-blue-600 text-center text-xl">App Salón</p>
    <h1 class="text-5xl font-extrabold text-center mt-10">Iniciar Sesión</h1>
    <p class="text-2xl text-center my-5">Si tienes una cuenta, Inicia sesión</p>

    <FormKit
        type="form"
        :actions="false"
        incomplete-message="Revisa que todos los datos sean correctos"
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
