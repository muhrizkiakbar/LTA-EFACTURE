<script setup>
import { ref, watch } from "vue"
import AppLayout from '@/Layouts/AppLayout.vue';

import Modal from '@/Components/Modal.vue';
import ModalGenerate from '@/Components/Modal.vue';
import ModalUpdate from '@/Components/Modal.vue';
import FilterSection from "./Partials/Filter.vue"
import TableSeries from "./Partials/TableSeries.vue"
import DetailModal from "./Partials/DetailModal.vue"
import GeneratedModal from "./Partials/GeneratedModal.vue"
import UpdateArModal from "./Partials/UpdateArModal.vue"

const props = defineProps({
    series: Object,
    branch: Object,
    filters: Object,
    status: String,
    recap: Object
})
const modalDetail = ref(false)
const modalGenerate = ref(false)
const modalUpdate = ref(false)

const detail = ref(null)
const multiGenerate = ref(null)
const clearSelect = ref(false)
const openDetail = (item) => {
    modalDetail.value = true
    detail.value = item
}

const openModalAction = (item) => {
    if (item?.length > 0) {
        multiGenerate.value = item
        if (props.status == '0') {
            modalGenerate.value = true
        } else if(props.status == '1') {
            modalUpdate.value = true
        }
    }
}

const clearData = () => {
    multiGenerate.value = null
    clearSelect.value = true
    setInterval(() => {
        clearSelect.value = false
    }, 100)
}

watch(() => modalDetail.value , val => {
    if(!val) detail.value = null
})

watch(() => modalGenerate.value , val => {
    if(!val) multiGenerate.value = null
})
watch(() => modalUpdate.value , val => {
    if(!val) multiGenerate.value = null
})

</script>

<template>
    <AppLayout title="Ar Series">
        <div class="max-w-7xl mx-auto px-5 pb-10">
            <FilterSection :branch="branch" :filters="filters" :status="parseInt(status)" :recap="recap"/>
            <TableSeries :data-invoice="series.data" :openDetail="openDetail" :openGenerate="openModalAction" v-bind:isClear="clearSelect" :status="status"/>
        </div>
        <Modal :show="modalDetail">
            <DetailModal :detail="detail" @close="modalDetail = false"/>
        </Modal>
        <ModalGenerate :show="modalGenerate">
            <div class="px-5 py-4 bg-blue-700">
                <h1 class="text-white">GENERATE KEY SERIES</h1>
            </div>
            <GeneratedModal :data="multiGenerate" @close="modalGenerate = false" :clearSelect="clearData"/>
        </ModalGenerate>
        <ModalUpdate :show="modalUpdate">
            <div class="px-5 py-4 bg-emerald-700">
                <h1 class="text-white">UPDATE A/R INVOICE</h1>
            </div>
            <UpdateArModal :data="multiGenerate" @close="modalUpdate = false" :clearSelect="clearData"/>
        </ModalUpdate>
    </AppLayout>
</template>
