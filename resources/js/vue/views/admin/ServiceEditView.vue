<script setup>
import { onMounted, reactive } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useAdminStore } from "../../store/admin";
import AdminAPI from "../../api/AdminAPI";

const route = useRoute();
const router = useRouter();
const admin = useAdminStore();

const formData = reactive({
    name: "",
    price: "",
});

const { id } = route.params;

onMounted(async () => {
    try {
        const { data } = await AdminAPI.getService(id);
        Object.assign(formData, data.data);
    } catch (error) {
        router.push({ name: "admin-appointments" });
    }
});

const handleSubmit = async () => {
    await admin.updateService(id, formData);
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
    <h2 class="text-3xl font-black text-center">Editar Servicio</h2>

    <div class="md:w-2/5 mx-auto">
        <FormKit
            id="editService"
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
                v-model="formData.name"
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
                v-model="formData.price"
                :validation-messages="{
                    required: 'El precio es obligatorio',
                }"
            />
            <FormKit type="submit">Guardar cambios</FormKit>
        </FormKit>
    </div>
</template>
