<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container py-2">
            <a href="#" class="navbar-brand">
                <span>Toedoe</span>
                <strong>List</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Summary</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <template v-if="!authStore.user">
                        <li class="nav-item">
                            <Login/>
                        </li>
                        <li class="nav-item">
                            <Register/>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" :class="toggleClass" @click.prevent="toggle" href="#"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ authStore.user.name }}
                            </a>
                            <ul class="dropdown-menu" :class="toggleClass">
                                <li><a href="#" class="dropdown-item" @click="authStore.handleLogout()">Logout</a></li>
                            </ul>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {ref, computed} from "vue";
import Login from "./buttons/Login.vue";
import Register from "./buttons/Register.vue";
import {useAuthStore} from "../stores/auth";

const authStore = useAuthStore();
const isOpen = ref(false)
const toggle = () => isOpen.value = !isOpen.value
const toggleClass = computed(() => isOpen.value === true ? 'show' : '')
</script>
<style scoped>
.nav-link.div-active {
    color: rgba(0, 0, 0, .9);
}
</style>
