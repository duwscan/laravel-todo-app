<template>
    <a class="btn btn-outline-secondary ms-2 " @click="toggle">Login
    </a>
    <teleport to="body">
        <AuthModal :action="action" :show="show" @toggleModal="toggle"/>
    </teleport>
</template>
<script setup>
import AuthModal from "../modal/AuthModal.vue";
import {ref} from "vue";

const action = "SIGN_IN";
const show = ref(false);
const toggle = () => show.value = !show.value
</script>
