<script setup>
import { RouterLink } from "vue-router";

const fetchData = async () => {
    const res = await fetch(route("services.index"));
    const data = await res.json();

    console.log(data);
};

await fetchData();
</script>

<template>
    <h1>Home Page</h1>
    <RouterLink to="/login">Login</RouterLink>
</template>

<style></style>
