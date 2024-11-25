<script setup>
import {ref, computed, watch} from "vue"
import { useForm } from "@inertiajs/inertia-vue3"
import { CreditCardIcon, MapPinIcon, WalletIcon, ArrowRightCircleIcon } from "@heroicons/vue/24/outline"
import ExcelIcon from "@/Components/Icons/Excel.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import TextInput from "@/Components/TextInput.vue"

const props = defineProps({
    dataInvoice : {
        type: Object,
        default: {}
    },
    openDetail: {
        type: Function,
        default: () => {}
    },
    branch: String,
    companyId: Number
})
const filterStatus = ref(true)
const selected = ref([])
const selectAll = ref(false)


const invoices = computed(() => {
    return props.dataInvoice.filter(item => {
        const status = filterStatus.value
        if (status == null) {
            return props.dataInvoice
        } else if (status == true) {
            return item.isValid == status
        } else if(status == false)
        {
            return item.isValid == false;
        } else if (status == 'nsfp'){
            return item.NSFP == null && item?.isValid == true
        } else {
            return item.isValid == status
        }
    })
})
const companyLabel = computed(() => {
    switch (props.companyId) {
        case 1 :
            return 'PT Laut Timur Ardiprima'
            break;
        case 2 :
            return 'PT Trijaya Adhiraja Abadi'
            break;
    }
})
watch(() => selectAll.value, val => {
    if(val) {
        for (const i in invoices.value) {
            selected.value.push({
                ...invoices.value[i],
                company_id: props.companyId
            })
        } 
    } else {
        selected.value = []
    }
})
const addSelect = (e) => {
    const isSelected = selected.value.filter(item => item.DocNum == e.DocNum)
}
const download = () => {
    window.open(route('export.excel', {data: selected.value}), '_blank')
}
const StoreMultipleData = () => {
    const form = useForm({
        invoices: selected.value,
        branch: props.branch
    })
    form.post(route('arInvoice.multipleStore'), {
        onSuccess: () => selected.value = []
    })
}
</script>
<template>
    <div class="px-5">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle px-3">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class="bg-slate-50  flex justify-between px-3 py-3 border-b">
                            <div class="flex space-x-3 items-center">
                                <div v-if="selected.length > 0" class="flex space-x-2">
                                    <!-- <PrimaryButton  class="py-2 flex space-x-2" @click="download"> 
                                        <ExcelIcon class="w-5 h-5"/>
                                        <span>{{selected.length}} Selected</span>
                                    </PrimaryButton> -->
                                    <PrimaryButton class="py-2 flex space-x-2 bg-emerald-700" @click="StoreMultipleData"> 
                                        <span>SAVE AR</span>
                                        <ArrowRightCircleIcon class="w-5 h-5"/>
                                    </PrimaryButton>
                                </div>
                                <div class="flex items-end space-x-3">
                                    <div>
                                        <select v-model="filterStatus" class="text-sm border border-gray-300 rounded">
                                            <option :value="null">
                                                All
                                            </option>
                                            <option :value="true">
                                                Verified
                                            </option>
                                            <option :value="false">
                                                unverified
                                            </option>
                                            <option :value="'nsfp'">
                                                NSFP
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs">AR: {{ dataInvoice.length ?? 0 }}</p>
                                    <p class="text-xs">Selected: {{ selected.length ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <div class="flex space-x-2 items-center text-gray-700">
                                    <WalletIcon class="w-5 h-5"/> <span>NPWP</span>
                                </div>
                                <div class="flex space-x-2 items-center text-gray-700">
                                    <CreditCardIcon class="w-5 h-5"/> <span>NIK</span>
                                </div>
                                <div class="flex space-x-2 items-center text-gray-700">
                                    <MapPinIcon class="w-5 h-5"/> <span>Address</span>
                                </div>
                            </div>
                        </div>
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th class="px-3 py-3.5 w-10 text-left text-sm font-semibold text-gray-900">
                                        <input type="checkbox" v-model="selectAll">
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Doc. number</th>
                                    <th scope="col" class="px-3 py-3.5 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900">
                                        Card code</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Customer</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        NSFP</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Cus. Ref Number</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Company</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 text-center sm:pr-6">
                                        {{dataInvoice?.length}} Invoice
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="dataInvoice?.length > 0" class="bg-white">
                                <tr v-for="(item, index) in invoices.sort((a, b ) => a.DocNum - b.DocNum)" 
                                :class="[index % 2 ? 'bg-gray-50' : '', item?.isValid  ? '' : 'bg-orange-100 hover:bg-orange-200', 'hover:bg-gray-100 cursor-pointer']">
                                    <td class="px-3 py-2">
                                        <input type="checkbox" :value="{...item, company_id: companyId}" v-model="selected" @change="addSelect({...item, company_id: companyId})">
                                    </td>
                                    <td @click="openDetail(item)" class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 hover:underline">
                                        {{ item?.DocNum }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.CardCode }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-900">{{ item?.CardName }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.NSFP }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.NumAtCard }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ companyLabel }}</td>
                                    <td class="relative whitespace-nowrap py-2 text-sm font-medium flex items-center space-x-4 justify-center">
                                        <WalletIcon class="w-5 h-5" :class="[ item?.LicTradNum == '00.000.000.0-000.000' || item?.LicTradNum == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
                                        <CreditCardIcon class="w-5 h-5" :class="[ item?.NIK == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
                                        <MapPinIcon class="w-5 h-5" :class="[ item?.Street == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
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
    </div>
</template>