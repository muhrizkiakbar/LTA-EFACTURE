<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3"
import { XCircleIcon } from "@heroicons/vue/20/solid"
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from "@/Components/Modal.vue"
import TextInput from "@/Components/TextInput.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"

defineProps({
    params: String,
    series: Object,
})
const modal = ref(false)
const detail = ref(null)
const id = ref(null)

const openDetail = (item) => {
    modal.value = true
    detail.value = item?.series
    id.value = item?.id
}
const update = () => {
    const form = useForm({
        series: detail.value,
    })
    form.put(route('keySeries.update', {KeySeries: id.value }), {
        onSuccess: () => modal.value = false
    })
}
</script>

<template>
    <AppLayout title="Detail Serial Key">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- {{series}}  -->
                <h1 class="text-xl font-semibold">{{params}}</h1>
                <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nomer Seri Faktur Pajak</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    AR - INVOICE
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    AR - DOCNUM
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">
                                    Satus
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-for="item in series">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 cursor-pointer sm:pl-6 hover:underline" @click="openDetail(item)">
                                    {{item.series}}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{item?.ar_invoice_id != null ? item?.invoice?.CardCode : '-'}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{item?.ar_invoice_id != null ? item?.invoice?.DocNum : '-'}}</td>
                                <td :class="[item?.status == 0 ? 'bg-green-50 text-green-700 font-bold' : 'bg-gray-50 text-gray-700 font-bold' , 'whitespace-nowrap px-3 py-4 text-sm text-center']">{{item?.status == 0 ? 'OPEN' : 'CLOSE'}}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <Modal :show="modal">
            <div>
                <div class="px-5 py-1 flex justify-between items-center border-b">
                  <div class="text-lg font-semibold text-gray-600">Detail</div>
                  <div>
                    <button class="p-2" @click="modal = false">
                        <XCircleIcon class="w-6 h-6 text-gray-600"/>
                    </button>
                  </div>
                </div>
                <div class="py-4 px-5">
                   <TextInput v-model="detail" label="No. Seri Faktur Pajak"/>
                </div>
                <div class="border-t py-3 px-5 flex justify-end space-x-3">
                    <SecondaryButton @click="modal = false">Batal</SecondaryButton>
                    <PrimaryButton @click="update">UPDATE</PrimaryButton>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
