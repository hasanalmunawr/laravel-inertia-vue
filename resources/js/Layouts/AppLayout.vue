<script setup>
import { onMounted, reactive } from "vue";
import * as bootstrap from 'bootstrap'
import Navbar from "@/components/Navbar.vue";
import Toast from "@/components/Toast.vue";
import {router, usePage} from "@inertiajs/vue3";

const state = reactive({
    toastRef: null,
    toastMessage: ""
})

const page = usePage()

router.on('finish', () => {
    state.toastMessage = page.props.toast.success
    showToast()
})

onMounted(() => {
    state.toastRef = new bootstrap.Toast('#app-toast', {
        delay: 3000
    })
})

const showToast = () => state.toastRef.show()
</script>

<template>
    <Navbar />


    <main class="py-4">
      <slot />
    </main>
    <Toast id="app-toast" :message="state.toastMessage" />
</template>

<style scoped>

</style>
