<script setup>

import Answer from "@/components/Answer/Answer.vue";
import Pagination from "@/components/Pagination.vue";
import useModal from "../../Composables/useModal.js";
import EditAnswerForm from "@/components/Answer/EditAnswerForm.vue";
import {reactive} from "vue";

const {Modal, showModal, hideModal, modalTitle } = useModal('#update-answer-modal')

defineProps({
    answers: {
        type: Object,
        required: true
    },
})

const editingAnswer = reactive({
    body: '',
    question_id: '',
    id: ''
})

const editAnswer = (payload) => {
    modalTitle.value = "Editing Answer"
    editingAnswer.id = payload.id
    editingAnswer.body = payload.body
    editingAnswer.question_id = payload.question_id
    showModal()

    console.log("Editing Answer Nya" + editingAnswer.body)
}

</script>

<template>
    <div class="d-flex justify-content-between align-items-center">
    <h2 class="mt-4 answer-header">{{ answers.meta.total }} Answers</h2>
        <Pagination :meta="answers.meta" />
    </div>
    <div class="answer-content mt-4" >
      <Answer
          v-for="answer in answers.data"
          :key="answer.id"
          :answer="answer"
            @edit="editAnswer"
      />
    </div>
    <Modal id="update-answer-modal" :title="modalTitle">
        <EditAnswerForm :answer="editingAnswer" @success="hideModal"/>
    </Modal>
</template>

<style scoped>

</style>
