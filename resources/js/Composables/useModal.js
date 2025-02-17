import * as bootstrap from 'bootstrap';
import Modal from "../components/Modal.vue";
import {onMounted, reactive, computed} from "vue";

export default (modalId, options = {}) => {
    const modal = reactive({
        ref: null,
        title: ''
    })

    onMounted(() => {
        modal.ref = new bootstrap.Modal(modalId, Object.assign(options, {
            backdrop: 'static',
            keyboard: false
        }))
    })

    const showModal = () => modal.ref.show();
    const hideModal = () => modal.ref.hide();

    const modalTitle = computed({
        get: () => modal.title,
        set: (title) => modal.title = title
    })

    return {
        Modal, showModal, hideModal, modalTitle
    }

}
