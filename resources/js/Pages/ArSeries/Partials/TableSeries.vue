<script setup>
import { ref, watch, computed } from "vue"
import { useForm } from "@inertiajs/inertia-vue3"
import { ArrowUturnLeftIcon } from "@heroicons/vue/24/outline"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"

const props = defineProps({
    dataInvoice : {
        type: Object,
        default: {}
    },
    openDetail: {
        type: Function,
        default: () => {}
    },
    openGenerate: {
        type: Function,
        default: () => {}
    },
    status: String || Number,
    isClear: Boolean
})
const emit = defineEmits(["update:isClear"])
const selectAll = ref(false)
const selected = ref([])

watch(() => selectAll.value, val => {
    if (val) {
        for (const i in props.dataInvoice) {
            selected.value.push(props.dataInvoice[i])
        }
    } else {
        selected.value = []
    }
})
watch(() => props.isClear, data => {
    if(data) {
        selectAll.value = false
        selected.value = []
    }
})
const addSelect = (e) => {
    const isSelected = selected.value.filter(item => item.DocNum == e.DocNum)
}
const generate = () => {
    props.openGenerate(selected.value)
}
const statusLabel = (item) => {
    switch (item) {
        case '0':
            return 'NEW'
            break;
        case '1':
            return 'PROGRESS'
            break;
        case '2':
            return 'UPDATED'
            break;
        default:
            return '-'
            break;
    }
}
const companyLabel = (item) => {
    switch (item) {
        case '1':
            return 'LTA'
            break;
        case '2':
            return 'TAA'
            break;
        default:
            return '-'
            break;
    }
}
const rollbackStatus = (item) => {
    let conf = confirm('Apakah anda yakin ini mengembalikan data ini ke status sebelumnya ?')
    if (conf) {
        useForm({id: item?.id}).post(route('arSeries.rollback'))
    }else {
        console.log('cancel')
    }
}
</script>
<template>
    <div class="flex space-x-3 py-2">
        <div v-if="selected?.length > 0" class="flex space-x-2 pb-3">
            <PrimaryButton  class="py-2 flex space-x-2"  @click="generate"> 
                <span>{{selected?.length}} Selected</span>
            </PrimaryButton>
        </div>
    </div>
    <div class="px-5 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle px-3">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-white">
                            <tr>
                                <th v-if="(status != 2)" class="px-3 py-3.5 w-10 text-left text-sm font-semibold text-gray-900">
                                        <input type="checkbox" v-model="selectAll">
                                    </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Doc. number</th>
                                <th scope="col"
                                    class="px-3 py-3.5 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900">
                                    Card code</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Customer</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    NPWP</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 text-center sm:pr-6">
                                    NSFP
                                </th>
                                 <th scope="col" class="relative py-3.5 pl-3 pr-4 text-center sm:pr-6">
                                    Company
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 text-center sm:pr-6">
                                    Status
                                </th>
                                <th scope="col" class="relative py-3.5 pr-4 text-left sm:pr-6">
                                    Time
                                </th>
                                <th scope="col" class="relative py-3.5 pr-4 text-left sm:pr-6">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="dataInvoice?.length > 0" class="bg-white">
                            <tr v-for="(item, index) in dataInvoice"
                                :class="[index % 2 ? 'bg-gray-50' : '', 'hover:bg-gray-100 cursor-pointer']">
                                <td v-if="(status != 2)" class="px-3 py-2">
                                        <input type="checkbox" :value="item" v-model="selected" @change="addSelect(item)">
                                    </td>
                                <td @click="openDetail(item)"
                                    class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 hover:underline">
                                    {{ item?.DocNum }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.CardCode }}</td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-900">{{ item?.CardName }}</td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.LicTradNum }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.key?.series }}
                                </td>
                                <td
                                    class="relative whitespace-nowrap py-2 text-sm font-medium flex items-center space-x-4 justify-center">
                                   {{companyLabel(item?.company_id)}}
                                </td>
                                <td class="text-center">
                                    <span :class="['text-[13px] font-semibold']">{{statusLabel(item?.status)}}</span>
                                </td>
                                <td class="text-left pr-2">
                                    <p v-if="status === '0'" :class="['text-[13px] text-gray-500']">{{item?.time.sync}}</p>
                                    <p v-if="status === '1'" :class="['text-[13px] text-gray-500']">{{item?.time.sync}}</p>
                                    <p v-if="status === '2'" :class="['text-[13px] text-gray-500']">{{item?.time.updated}}</p>
                                </td>
                                <td class="text-left pr-2">
                                    <SecondaryButton @click="rollbackStatus(item)" v-if="item?.status == 1 && item?.key?.series == null">
                                        <ArrowUturnLeftIcon class="w-4 h-4"/>
                                    </SecondaryButton>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="6" class="py-3 text-center">
                                    Ar invoice kosong
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>