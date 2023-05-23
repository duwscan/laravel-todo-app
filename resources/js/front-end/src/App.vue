<script setup>
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";
import TaskPage from "@/pages/TaskPage.vue";
import {onMounted, onBeforeMount} from "vue";
import {useAuthStore} from "./stores/auth";

const authStore = useAuthStore();
onBeforeMount(async () => {
    if (authStore.token) {
        await authStore.handleInitUser();
    } else {
        console.log("unAuthenticated");
    }
})
</script>
<template>
    <Navbar/>
    <TaskPage v-if="authStore.user"/>
    <h1 v-else class="text-center">LOGIN/REGISTER TO USE TOEDOE APP</h1>
    <Footer/>
</template>
<style scoped>

</style>
