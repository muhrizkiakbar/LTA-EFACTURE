<script setup>
import {reactive, ref, watch, onMounted} from "vue"
import { useForm } from '@inertiajs/inertia-vue3'
import {partial} from "filesize";
import moment from "moment"
import { Inertia } from "@inertiajs/inertia";
import Pagination from "@/Components/Pagination.vue";

import AppLayout from '@/Layouts/AppLayout.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import Modal from "@/Components/Modal.vue"
import TableCra from "./Partials/TableCra.vue"
import FilterSection from "./Partials/Filters.vue"

const size = partial({base: 2, standard: "jedec"});

const props = defineProps({
    cra: Object,
    filters: Object,
    user: Object
})

const modalUpload = ref(false)
const loading = ref(false)
const inputFile = ref(null)
const file = ref(null)
const form = useForm({
    file: null
})

const filters = reactive({
    sort: props.filters?.sort,
    tarashed: props.filters?.tarashed ?? null,
    search: props.filters?.search,
    date: props.filters?.date,
    size: props.filters?.size,
    status: props.filters?.status
})

const submit = () => form.post(route('masterCra.import'), {
    preserveScroll: true,
    forceFormData: true,
    onProgress:() => loading.value = true,
    onFinish:() => loading.value = false,
    onSuccess: (res) => {
        modalUpload.value = false
        form.file = null
    },
})
const pickFile = () => {
    inputFile.value.click()
}
const storeFile = (e) => {
    form.file = e.target.files[0]

}

const closeModal = () => {
    form.file = null
    modalUpload.value = false
}

console.log(props.user)
</script>
<template>
    <AppLayout title="Dashboard">
        <div class="pb-12 pt-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <FilterSection v-model="filters" :openModalUpload="() => modalUpload = true"/>
                <TableCra :data="cra.data" :total="cra.total" :user="user"/>
                <Pagination :links="cra.links"/>
            </div>
        </div>
        <Modal :show="modalUpload" :closeable="false">
            <form @submit.prevent="submit">
                <div class="px-5 py-4 space-y-3" >
                    <div class="border-2 border-dashed p-4 rounded -mx-1 text-center space-y-4 cursor-pointer" @click="pickFile">
                        <div v-if="form.file === null"  class="space-y-4">
                            <svg  xmlns="http://www.w3.org/2000/svg" class="w-20 h-auto mx-auto text-gray-500" 
                            viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m2.859 2.877 12.57-1.795a.5.5 0 0 1 .571.495v20.846a.5.5 0 0 1-.57.495L2.858 21.123a1 1 0 0 1-.859-.99V3.867a1 1 0 0 1 .859-.99zM4 4.735v14.53l10 1.429V3.306L4 4.735zM17 19h3V5h-3V3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-4v-2zm-6.8-7 2.8 4h-2.4L9 13.714 7.4 16H5l2.8-4L5 8h2.4L9 10.286 10.6 8H13l-2.8 4z" />
                            </svg>
                            <div>
                                <p class="text-700">Pilih file, pastikan extensi file yang di upload adalah <span class="font-bold text-gray-800">XLS/XLSX</span> .</p>
                            </div>
                        </div>
                        <div v-else class="realtive">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-auto mx-auto text-teal-800"  viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M644.7 669.2a7.92 7.92 0 0 0-6.5-3.3H594c-6.5 0-10.3 7.4-6.5 12.7l73.8 102.1c3.2 4.4 9.7 4.4 12.9 0l114.2-158c3.8-5.3 0-12.7-6.5-12.7h-44.3c-2.6 0-5 1.2-6.5 3.3l-63.5 87.8-22.9-31.9zM688 306v-48c0-4.4-3.6-8-8-8H296c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8zm-392 88c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8H296zm184 458H208V148h560v296c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V108c0-17.7-14.3-32-32-32H168c-17.7 0-32 14.3-32 32v784c0 17.7 14.3 32 32 32h312c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8zm402.6-320.8-192-66.7c-.9-.3-1.7-.4-2.6-.4s-1.8.1-2.6.4l-192 66.7a7.96 7.96 0 0 0-5.4 7.5v251.1c0 2.5 1.1 4.8 3.1 6.3l192 150.2c1.4 1.1 3.2 1.7 4.9 1.7s3.5-.6 4.9-1.7l192-150.2c1.9-1.5 3.1-3.8 3.1-6.3V538.7c0-3.4-2.2-6.4-5.4-7.5zM826 763.7 688 871.6 550 763.7V577l138-48 138 48v186.7z"/>
                            </svg>
                            <p class="text-700 font-semibold">{{ form.file?.name}} - {{ size(form?.file.size) }}</p>
                            <p class="text-sm">Date Modified: {{moment(form?.file?.lastModified).format('DD-MM-YYYY,  h:mm:ss a')}}</p>
                        </div>
                    </div>
                    <input ref="inputFile" type="file"  @change="storeFile($event)" :disabled="loading" hidden>
                    <div class="flex space-x-2 justify-end">
                        <PrimaryButton type="submit" :disabled="loading || form.file === null">{{loading ? 'uploading...' : 'upload'}}</PrimaryButton>
                        <SecondaryButton type="button" @click="closeModal">BATAL</SecondaryButton>
                    </div>
                </div>
            </form>
        </Modal>
    </AppLayout>
</template>