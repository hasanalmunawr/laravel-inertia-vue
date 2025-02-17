<script setup>
import QuestionForm from "@/components/Question/QuestionForm.vue";

const emit = defineEmits(['success'])

defineProps({
    question: {}
})
</script>

<template>
    <QuestionForm
        :action="route('questions.store')"
        :question="question"
        @success="emit('success')"
    />
</template>

<style scoped>

</style>
