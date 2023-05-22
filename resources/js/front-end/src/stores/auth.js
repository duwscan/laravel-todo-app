import {defineStore} from 'pinia';
import {computed, ref} from "vue";
import {login, logout, signup} from "../http/auth";

export const useAuthStore = defineStore('auth', () => {
    const user = ref(null);
    const token = ref(null);
    const errors = ref(null);
    const isAuthenticated = computed(() => !!token);

    async function handleLogin(payload) {
        try {
            const data = await login(payload);
            // console.log(data);
            user.value = data.data.user
            token.value = data.data.token
        } catch (error) {
            console.log(error)
            errors.value = error.response.data.errors;
        }
    }

    async function handleSignup(payload) {
        const data = await signup(payload);
        console.log(data);
    }

    async function handleLogout() {
        await logout();
    }

    return {
        user,
        errors,
        isAuthenticated,
        token,
        handleLogin,
        handleLogout,
        handleSignup,
    }
})
