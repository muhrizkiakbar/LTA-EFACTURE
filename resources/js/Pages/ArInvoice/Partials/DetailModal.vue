<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"

const props = defineProps({
    detail: {
        type: Object,
        default: {}
    },
    branch: {
        type: String, 
        default: ''
    },
    companyId: String
})
const emit = defineEmits(['close', 'submit'])

const submit = () => {
    console.log(props.detail)
    const form = useForm({
        DocNum: props.detail?.DocNum, 
        CardCode: props.detail?.CardCode, 
        CardName: props.detail?.CardName, 
        Street: props.detail?.Street, 
        LicTradNum: props.detail?.LicTradNum, 
        status: 0,
        branch_id: props.branch,
        posting_date: props?.detail?.DocDate,
        company_id: props?.companyId
    })

    if (props.detail?.isValid) {
        form.post(route('arInvoice.store'), {
            onError: err => alert(err['DocNum']),
            onSuccess: res => console.log(res),
            onFinish: () => emit('close')
        })
    }else {
        alert('Data not valid')
    }
}
</script>
<template>
    <div class="px-5 ">
        <div>
            <div :class="[detail?.isValid  ? 'text-gray-900' : 'bg-orange-500 text-white', 'flex space-x-4 justify-between -mx-5 px-5 py-4'] ">
                <div>
                    <p :class="[detail?.isValid ? 'text-gray-600' : 'text-white']">Doc. Number</p>
                    <h1 class="font-semibold">{{ detail?.DocNum }}</h1>
                </div>
                <div>
                    <p :class="[detail?.isValid ? 'text-gray-600' : 'text-white']">Customer Code</p>
                    <h1 class="font-semibold">{{ detail?.CardCode }}</h1>
                </div>
                <div>
                    <p :class="[detail?.isValid ? 'text-gray-600' : 'text-white']">NPWP</p>
                    <h1 class="font-semibold">{{ detail?.LicTradNum !== null ? detail?.LicTradNum : 'KOSONG'  }}</h1>
                </div>
            </div>
            <div class="bg-slate-100 -mx-5 px-5 py-2 flex justify-between">
                <div>
                    <p class="text-gray-600">Customer</p>
                    <h1 class="font-semibold">{{ detail?.CardName }}</h1>
                </div>
                <div>
                    <p class="text-gray-600">NIK</p>
                    <h1 class="font-semibold">{{ detail?.NIK ? detail?.NIK : '-' }}</h1>
                </div>
            </div>
            
            <div class="py-4">
                <p class="text-gray-600">Address</p>
                <h1 class="font-semibold">{{ detail?.Street !== null ? detail?.Street : 'kosong' }}</h1>
            </div>
        </div>
        <div class="flex space-x-2 justify-end pb-4 pt-3 border-t -mx-5 px-5">
            <SecondaryButton @click="emit('close')">Close</SecondaryButton>
            <PrimaryButton @click="submit"> Store to A/R Series</PrimaryButton>
        </div>
    </div>
</template>