<template>
    <section class="vh-100 position-absolute vw-100 top-0" v-if="show" @click="()=>$emit('toggleModal')">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;" @click.stop>
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5" v-if='action === "SIGN_IN"'>Sign in</h3>
                            <h3 class="mb-5" v-if='action === "SIGN_UP"'>Sign Up</h3>
                            <div class="form-outline mb-4 text-start">
                                <label class="form-label" for="typeEmailX-2">Email</label>
                                <input type="email" id="typeEmailX-2" class="form-control form-control-lg"
                                       v-model="formPayload.email"/>
                                <div class="form-text" v-if="formError.email">
                                    {{ formError.email.join("") }}
                                </div>
                            </div>
                            <div class="form-outline mb-4 text-start">
                                <label class="form-label" for="typePasswordX-2">Password</label>
                                <input type="password" id="typePasswordX-2"
                                       class="form-control form-control-lg"
                                       v-model="formPayload.password"/>
                                <div class="form-text" v-if="formError.password">
                                    {{ formError.password.join("") }}
                                </div>
                            </div>
                            <div class="form-outline mb-4 text-start" v-if='action === "SIGN_UP"'>
                                <label class="form-label" for="typePasswordX-3">Password Confirmation</label>
                                <input type="password" id="typePasswordX-3" class="form-control form-control-lg"/>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" @click.stop="handleAuth">{{
                                    action === "SIGN_IN" ? "Sign In" : "Sign Up"
                                }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
import {ref, defineProps, defineEmits, reactive} from "vue"
import {useAuthStore} from "../../stores/auth";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    action: String,
})
const emit = defineEmits(['toggleModal'])
const formError = ref({});
const authStore = useAuthStore();
const formPayload = reactive({
    email: "",
    password: "",
})
const handleAuth = async () => {
    props.action === "SIGN_IN" ? await authStore.handleLogin(formPayload) : await authStore.handleSignup({});
    if (authStore.errors) {
        formError.value = authStore.errors
    } else {
        console.log(authStore.user);
    }
};
</script>
