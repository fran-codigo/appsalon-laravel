<script setup>
import { formatCurrency } from "../../utils";

defineProps({
    services: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div className="px-4 sm:px-6 lg:px-8 mt-20">
        <div className="mt-8 flow-root ">
            <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 bg-white p-5"
                >
                    <table className="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    className="py-3.5 pl-4 pr-3 text-left text-md font-semibold text-gray-900 sm:pl-0"
                                >
                                    Servicio
                                </th>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-md font-semibold text-gray-900"
                                >
                                    Precio
                                </th>
                                <th
                                    scope="col"
                                    className="px-3 py-3.5 text-left text-md font-semibold text-gray-900"
                                >
                                    Estado
                                </th>
                                <th
                                    scope="col"
                                    className="relative py-3.5 pl-3 pr-4 sm:pr-0 text-gray-900"
                                >
                                    <span className="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-gray-200">
                            <tr v-for="service in services" :key="service.id">
                                <td
                                    className="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"
                                >
                                    {{ service.name }}
                                </td>
                                <td
                                    className="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{ formatCurrency(service.price) }}
                                </td>
                                <td
                                    className="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    {{
                                        service.available
                                            ? "Disponible"
                                            : "No disponible"
                                    }}
                                </td>
                                <td
                                    className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0"
                                >
                                    Editar
                                    <span className="sr-only">{{
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
