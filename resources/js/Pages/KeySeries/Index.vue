<script setup>
import { ref, onMounted } from "vue"
import { Inertia } from "@inertiajs/inertia"
import { XCircleIcon } from "@heroicons/vue/24/outline"
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TableSeries from "./Partials/TableSeries.vue"
import CreateSeries from "./Partials/CreateSeries.vue";

defineProps({
    series: Object
})

const modal = ref(false)
const closeModal = () => {
    modal.value = false
}
</script>
<template>
    <AppLayout title="No Seri Faktur Pajak">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="font-bold text-xl text-gray-700">Nomer Seri Faktur Pajak</h1>
                    <PrimaryButton type="button" @click="modal = true">
                        TAMBAH NSFP
                    </PrimaryButton>
                </div>
                <TableSeries :data="series" />
            </div>
        </div>
        <Modal :show="modal">
            <div class="py-4 px-5"> 
                <div class="flex justify-between items-center">
                    <h1 class="uppercase font-semibold text-xl">Tambah NSFP</h1>
                    <button type="button" @click="modal = !modal">
                        <XCircleIcon class="w-7 h-7"/>
                    </button>
                </div>
              <CreateSeries  :actionClose="closeModal"/>
            </div>
        </Modal>
    </AppLayout>
</template>
