<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const registerForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const submitRegister = () => {
    registerForm.post(route('register.store'), {
        onSuccess: () => {
            alert("Register Success")
            console.log("Register Success")
        },
        onError: () => {
            console.log("Register Failed")
        }
    })
}
</script>


<template>
    <Head title="Register"/>
    <GuestLayout>
        <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body py-4 px-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h3>Register</h3>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="submitRegister">
                        <div class="row gy-2 overflow-hidden">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" :class="{ 'is-invalid': registerForm.errors.name }" v-model="registerForm.name" name="name" id="name"
                                           placeholder="Name">
                                    <label for="name" class="form-label">Name</label>
                                    <div class="invalid-feedback" v-if="registerForm.errors.name">
                                        {{ registerForm.errors.name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" :class="{ 'is-invalid': registerForm.errors.email }" v-model="registerForm.email" name="email" id="email"
                                           placeholder="Email">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="invalid-feedback" v-if="registerForm.errors.email">
                                        {{ registerForm.errors.email }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" :class="{ 'is-invalid': registerForm.errors.password }" v-model="registerForm.password" name="password" id="password"
                                           value="" placeholder="Password">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="invalid-feedback" v-if="registerForm.errors.password">
                                        {{ registerForm.errors.password }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" :class="{ 'is_invalid': registerForm.errors.password_confirmation }" v-model="registerForm.password_confirmation" name="password_confirmation"
                                           id="password_confirmation" value="" placeholder="Password">
                                    <label for="password" class="form-label">Password Confirmation</label>
                                    <div class="invalid-feedback" v-if="registerForm.errors.password_confirmation">
                                        {{ registerForm.errors.password_confirmation }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary" type="submit">Register now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-4 mb-4 border-secondary-subtle">
                            <div class="text-center">
                                Already have an account?
                                <Link :href="route('login')" class="link-secondary text-decoration-none">Sign in</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
