<script setup>
import axios from "axios";
import { useForm } from "@inertiajs/inertia-vue3"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import TextInput from "@/Components/TextInput.vue"
import { ref } from "vue";
const props = defineProps({
    detail: {
        type: Object,
        default: {}
    },
    branch: {
        type: String, 
        default: ''
    }
})
const emit = defineEmits(['close', 'submit'])
const form = useForm({
    ar_series: props.detail?.id,
    docNum: props.detail?.DocNum,
    series: null,
    keyId: null,
})
const formUpdate = useForm({
    series: props.detail?.key?.series,
    docnum: props.detail?.DocNum,
    address: props.detail?.Street,
    date: props.detail?.posting_date
})

const generateKey = () => {
    axios.get(route('keySeries.generate'))
    .then((res) => {
        console.log(res.data)
        form.series = res.data?.series
        form.keyId = res.data?.id
    }).catch((err) => {
        console.log(err)
    })
}
const submit = () => form.post(route('pair.store'), {
    onSuccess: () => emit("close")
})
const update = () => formUpdate.post(route('arSeries.update'), {
    onSuccess: (e) => emit("close")
})
// const update = () => {
//     console.log(formUpdate)
// }
</script>
<template>
    <div class="px-5 ">
        <div>
            <div :class="[ 'flex space-x-4 justify-between -mx-5 px-5 py-4'] ">
                <div>
                    <p class="text-gray-600">Doc. Number</p>
                    <h1 class="font-semibold">{{ detail?.DocNum }}</h1>
                </div>
                <div>
                    <p class="text-gray-600">Customer Code</p>
                    <h1 class="font-semibold">{{ detail?.CardCode }}</h1>
                </div>
                <div>
                    <p class="text-gray-600">NPWP</p>
                    <h1 class="font-semibold">{{ detail?.LicTradNum !== null ? detail?.LicTradNum : 'KOSONG'  }}</h1>
                </div>
            </div>
            <div class="bg-slate-100 -mx-5 px-5 py-2">
                <p class="text-gray-600">Customer</p>
                <h1 class="font-semibold">{{ detail?.CardName }}</h1>
            </div>
            <div class="py-4">
                <p class="text-gray-600">Address</p>
                <h1 class="font-semibold">{{ detail?.Street !== null ? detail?.Street : 'kosong' }}</h1>
            </div>
            <div v-if="detail.key === null" class="flex space-x-2 items-end py-4">
                <div>
                    <TextInput v-model="form.series" :disabled="true"/>
                </div>
                <div>
                    <PrimaryButton @click="generateKey" class="py-2.5">Generate NSFP</PrimaryButton>
                </div>
            </div>
            <div v-else class="py-4">
                <p class="text-gray-600">NSFP</p>
                <h1 class="font-semibold">{{ detail?.key?.series }}</h1>
            </div>
        </div>
        <div class="flex space-x-2 justify-end pb-4 pt-3 border-t -mx-5 px-5">
            <SecondaryButton @click="emit('close')">Close</SecondaryButton>
            <PrimaryButton v-if="detail?.status == '0'" @click="submit">Pairing key</PrimaryButton>
            <PrimaryButton v-if="(detail?.status == '1' || detail?.status == '2')" @click="update">Update AR</PrimaryButton>
        </div>
    </div>
</template>