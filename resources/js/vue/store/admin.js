import { ref } from "vue";
import { defineStore } from "pinia";

export const AdminUseStore = defineStore("admin", () => {

  const admin = ref({})
  const adminAppointments = ref([])
  const loading = ref(true)
  
  
  
    return {};
});
