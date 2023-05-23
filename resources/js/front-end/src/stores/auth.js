import {defineStore} from 'pinia';
import {computed, ref} from "vue";
import {login, logout, me, signup} from "../http/auth";

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null);
    const token = ref(localStorage.getItem("token"));
    const errors = ref(null);
    const isAuthenticated = computed(() => !!token);

    async function handleLogin(payload) {
        try {
            const data = await login(payload);
            user.value = data.data.user
            token.value = data.data.token
            errors.value = null;
            localStorage.setItem("token", token.value)
        } catch (error) {
            //TODO: implement toast
            errors.value = error.response.data.errors;
        }
    }

    async function handleSignup(payload) {
        try {
            const data = await signup(payload);
            user.value = data.data.user
            token.value = data.data.token
            errors.value = null;
            localStorage.setItem("token", token.value)
        } catch (error) {
            errors.value = error.response.data.errors;
        }
    }

    async function handleLogout() {
        try {
            await logout();
            localStorage.removeItem("token");
            user.value = null;
        } catch (e) {
            //TODO: implement toast
        }

    }

    async function handleInitUser() {
        try {
            const data = await me();
            user.value = data.data
        } catch (e) {
            //TODO: implement toast
        }
    }

    return {
        user,
        errors,
        isAuthenticated,
        token,
        handleLogin,
        handleLogout,
        handleSignup,
        handleInitUser,
    }
})
