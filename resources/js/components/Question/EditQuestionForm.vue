<script setup>
import QuestionForm from "@/components/Question/QuestionForm.vue";

const emit = defineEmits(['success'])

const props = defineProps({
    question: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <QuestionForm
        :action="route('questions.update', question.id)"
        :question="question"
        @success="emit('success')"
        method="PUT"
    />
</template>

<style scoped>

</style>
