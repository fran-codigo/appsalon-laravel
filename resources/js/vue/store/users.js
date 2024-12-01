import { ref, onMounted, computed } from "vue";
import { defineStore } from "pinia";
import AuthAPI from "../api/AuthAPI";

export const useUsersStore = defineStore("users", () => {
    const user = ref({});

    onMounted(async () => {
        try {
            const { data } = await AuthAPI.auth();
            user.value = data;
        } catch (error) {
            console.log(error);
        }
    });

    const getUserName = computed(() =>
        user.value?.name ? user.value?.name : ""
    );

    return {
        user,
        getUserName,
    };
});
