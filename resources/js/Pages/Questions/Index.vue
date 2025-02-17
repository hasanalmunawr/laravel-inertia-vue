<script setup>
import {Link, Head, usePage, router} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import QuestionSummary from "@/components/Question/QuestionSummary.vue";
import Pagination from "@/components/Pagination.vue";
import CreateQuestionForm from "@/components/Question/CreateQuestionForm.vue";
import {computed, onMounted, reactive, ref} from "vue";
import EditQuestionForm from "@/components/Question/EditQuestionForm.vue";
import useModal from "../../Composables/useModal.js";

const { Modal, showModal, hideModal, modalTitle} = useModal('#question-modal')

defineProps({
    questions: {
        type: Object,
        required: true
    },
    filter: String
})

// const state = reactive({
//     modalRef: null,
//     modalTitle: "Ask Question"
// })

const question = reactive({
    id: null,
    title: null,
    body: null
})

const editing = ref(false);

const page = usePage();
const isLoggedIn = computed(() => page.props.user)


const editQuestion = (payload) => {
    editing.value = true;
    modalTitle.value = "Edit Question"
    console.log("Editting" + payload.title)
    question.id = payload.id
    question.title = payload.title
    question.body = payload.body


    showModal();
}

const askQuestion = () => {
    modalTitle.value =  "Ask Question"
    //
    // // Reset data question agar tidak membawa data dari edit sebelumnya
    // question.id = null;
    // question.title = "";
    // question.body = "";

    showModal();
}

const removeQuestion = (payload) => {
    if (confirm('are you sure want to delete the ' + payload.title + ' ?')) {
        router.delete(route('questions.destroy', payload.id), {
            preserveScroll: true
        })
    }
}

</script>

<template>
    <Head title="All Questions" />

    <AppLayout>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="page-header">All Questions</h1>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <QuestionSummary
                                v-for="question in questions.data"
                                :key="question.id"
                                :question="question"
                                @edit="editQuestion"
                                @remove="removeQuestion"
                            />
                        </ul>
                    </div>

                <Pagination :meta="questions.meta" position="center"/>
                </div>
                <div class="col-md-3">
                    <div class="d-grid">
                        <button class="btn btn-primary" @click="askQuestion">Ask Question</button>
                    </div>

                    <ul class="nav nav-underline flex-column mt-4">
                        <li class="nav-item">
                            <Link class="nav-link"  :class="{ active: filter === 'latest'}" href="/?filter=latest">Latest</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :class="{ active: filter === 'unanswered'}"  href="/?filter=unanswered">Unanswered</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" :class="{ active: filter === 'scored'}"  href="/?filter=scored">Scored</Link>
                        </li>
                        <li class="nav-item" v-if="isLoggedIn">
                            <Link class="nav-link" :class="{ active: filter === 'mine'}"  href="/?filter=mine">Mine</Link>
                        </li>
                    </ul>
                    <h2 class="fs-5 mt-5">Related Tags</h2>
                    <ul class="tags-list mt-3">
                        <li><a href="#" class="tag mb-2">Javascript</a></li>
                        <li><a href="#" class="tag mb-2">JQuery</a></li>
                        <li><a href="#" class="tag mb-2">Vue.js</a></li>
                        <li><a href="#" class="tag mb-2">React.js</a></li>
                        <li><a href="#" class="tag mb-2">Inertia.js</a></li>
                        <li><a href="#" class="tag mb-2">PHP</a></li>
                        <li><a href="#" class="tag mb-2">Laravel</a></li>
                        <li><a href="#" class="tag mb-2">Bootstrap</a></li>
                        <li><a href="#" class="tag mb-2">Tailwind</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <Modal id="question-modal" :title="modalTitle" size="large" scrollable>
            <EditQuestionForm :question="question" @success="hideModal" v-if="editing"/>
            <CreateQuestionForm :question="question" @success="hideModal" v-else />
        </Modal>

    </AppLayout>
</template>

<style scoped>

</style>
