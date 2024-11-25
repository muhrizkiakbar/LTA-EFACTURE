<script setup>
import {ref, watch} from "vue"
import { useForm } from "@inertiajs/inertia-vue3"
import 'vue-good-table-next/dist/vue-good-table-next.css'

import AppLayout from '@/Layouts/AppLayout.vue'
import TextInput from "@/Components/TextInput.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import Modal from "@/Components/Modal.vue"

import TableInvoice from "./Partials/TableInvoice.vue"
import DetailModal from "./Partials/DetailModal.vue"

const modal = ref(false)
const detail = ref(null)
const columns = ref([
    { label: "Doc. Number", field: 'DocNum'},
    { label: "Card Code", field: 'CardCode'},
    { label: "Card Name", field: 'CardName'},
    { label: "NPWP", field: 'LicTradNum'},
    { label: "Action", field: 'action'},
    
])

const props = defineProps({
    invoice: Object,
    filter: Object,
    company: Object,
    branch: Object
})
const form = useForm({
    branch: props?.filter?.branch,
    dateStart: props?.filter?.dateStart,
    dateEnd: props?.filter?.dateEnd,
    company: props?.filter?.company,
})
const submit = () => form.get(route('arInvoice.index'))
const openDetail = (item) => {
    modal.value = true
    detail.value = item
}
watch(() => detail.value, val =>{
    if (!val) detail.value = null
})

const downloadExcel = () => {
// console.log(form.branch)
window.open(route('export.excel', {
    cabang: form.branch,
    from: form.dateStart,
    to: form.dateEnd,
}), '_blank')
}

</script>
<template>
    <AppLayout title="Ar Invoice">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- header -->
                <div class="flex flex-col lg:items-center lg:justify-between md:flex-row">
                    <form @submit.prevent="submit" class="flex-shrink space-x-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div class="space-y-1">
                                <label class="text-sm text-gray-700">Branch</label>
                                <select v-model="form.branch" class="text-sm w-full border-gray-300 rounded-md">
                                    <option v-for="item in branch" :value="item.bplId">{{item?.title}}</option>
                                </select>
                            </div>
                            <TextInput v-model="form.dateStart" label="Dari tangal" type="date"/>
                            <TextInput v-model="form.dateEnd" label="Sampai" type="date"/>
                            <div class="flex space-x-2">
                                <PrimaryButton type="submit" class="py-2.5"> sync a/r invoice </PrimaryButton>
                                <PrimaryButton type="button" @click="downloadExcel" class="py-2.5"> Download
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="py-4">
                    <TableInvoice :data-invoice="invoice" :open-detail="openDetail" :branch="form.branch" :company-id="company"/>
                </div> 
            </div>
        </div>
        <Modal :show="modal">
           <DetailModal :detail="detail" :branch="filter?.branch" :companyId="company" @close="modal = false"/>
        </Modal>
    </AppLayout>
</template>