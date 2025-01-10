<script setup>
import { useAdminStore } from "../../store/admin";
import AdminSidebar from "../../components/admin/AdminSidebar.vue";

const admin = useAdminStore();
</script>

<template>
    <div class="md:flex h-screen">
        <AdminSidebar />

        <div class="w-4/5 lg:w-4/6 m-auto my-10">
            <div class="flex justify-between">
                <div class="">
                    <h1 class="text-2xl lg:text-2xl font-black">
                        Panel de Administración
                    </h1>
                </div>

                <div class="flex flex-col space-y-5">
                    <div class="flex gap-2 items-center">
                        <p class="text-right">
                            Hola:
                            <span class="font-bold">
                                {{ admin.getAdminName }}
                            </span>
                        </p>

                        <button
                            type="button"
                            @click="admin.logout"
                            class="bg-red-600 hover:bg-red-700 p-2 text-white uppercase text-xs font-extrabold rounded-lg"
                        >
                            Cerrar Sesión
                        </button>
                    </div>
                </div>
            </div>

            <main class="space-y-6">
                <RouterView />
            </main>
        </div>
    </div>
</template>
