<script setup>
import { useAdminStore } from "../../store/admin";
import { formatCurrency } from "../../utils";

const admin = useAdminStore();

defineProps({
    services: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8 mt-20">
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 bg-white p-5"
                >
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-0"
                                >
                                    Servicio
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-md font-semibold text-gray-900"
                                >
                                    Precio
                                </th>
                                <th
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-md font-semibold text-gray-900"
                                >
                                    Estado
                                </th>
                                <th
                                    scope="col"
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-0 text-gray-900"
                                >
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="service in services" :key="service.id">
                                <td
                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"
                                >
                                    {{ service.name }}
                                </td>
                                <td
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ formatCurrency(service.price) }}
                                </td>
                                <td
                                    @click="
                                        admin.updateAvailabilityService(
                                            service.id
                                        )
                                    "
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 hover:cursor-pointer"
                                >
                                    <p
                                        class="border p-1 text-center rounded-md"
                                        :class="{
                                            'text-green-500 border-green-500':
                                                service.available,
                                            'text-red-500 border-red-500':
                                                !service.available,
                                        }"
                                    >
                                        {{
                                            service.available
                                                ? "Disponible"
                                                : "No disponible"
                                        }}
                                    </p>
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                >
                                    Editar
                                    <span class="sr-only">{{
                                        service.name
                                    }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
