<script setup>
import { useAdminStore } from "../../store/admin";

const admin = useAdminStore();

const handleSubmit = async (formData) => {
    await admin.saveService(formData);
};
</script>

<template>
    <div class="mt-10">
        <RouterLink
            :to="{ name: 'admin-services-list' }"
            class="text-lg text-white bg-blue-500 px-2 py-1 rounded-lg font-bold"
            >Regresar</RouterLink
        >
    </div>
    <h2 class="text-3xl font-black text-center">Agregar Servicio</h2>
    <p class="text-xl text-center my-5">Agrega un nuevo servicio en AppSalón</p>
    <div class="md:w-2/5 mx-auto">
        <FormKit
            id="addService"
            type="form"
            :actions="false"
            incomplete-message="No se pudo guardar, revisa las notificaciones"
            @submit="handleSubmit"
        >
            <FormKit
                type="text"
                label="Nombre"
                name="name"
                placeholder="Nombre del servicio"
                validation="required"
                :validation-messages="{
                    required: 'El nombre es obligatorio',
                }"
            />
            <FormKit
                type="number"
                label="Precio"
                name="price"
                placeholder="Precio del servicio"
                validation="required"
                :validation-messages="{
                    required: 'El precio es obligatorio',
                }"
            />
            <FormKit type="submit">Guardar servicio</FormKit>
        </FormKit>
    </div>
</template>
