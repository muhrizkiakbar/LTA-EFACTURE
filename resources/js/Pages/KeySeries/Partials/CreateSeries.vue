<script setup>
import { ref } from "vue"
import { watchDebounced } from "@vueuse/core"
import { useForm } from "@inertiajs/inertia-vue3"
import numeral from "numeral"
import axios from "axios"

import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { padStart } from "lodash"

const props = defineProps({
    actionClose : {
        type: Function,
        default: () => {} 
    }
})
const date = ref(null)
const code = ref(null)
const year = ref(null)
const first_series = ref(null)
const amount = ref(0)
const series = ref([])
const checkSerial = ref(null)
const loadingSerial = ref(false)
const errors = ref(null)

const submit = () => {
    const form = useForm({
        series: series.value,
        date: date.value,
    })
    form.post(
    route('keySeries.store'),{
        onSuccess: () => {
            props.actionClose()
            form.reset()
        },
        onError: (e) => {
            errors.value = e
            console.log(e)
        }
    })
}

const check = () => {
    loadingSerial.value = true
    axios.get(route('keySeries.check', {
        series: `${code.value}.${year.value}.${first_series.value}`
    })).then((res) => {
        console.log(res.data.id)
        loadingSerial.value = false
        checkSerial.value = res.data
    }).catch((err) => {
        console.log(err)
        loadingSerial.value = false
    })
}

watchDebounced(
    amount, 
    () => {
        series.value = []
        const seriesNum = numeral(first_series.value)
        for (let index = 0; index < amount.value; index++) {
            series.value.push(`${code.value}-${year.value}.${String(seriesNum._value + index).padStart(8, '0') }`)
        }
    },
    { debounce: 1000, maxWait: 1000 },
)
</script>
<template>
    <div class="pt-6">
        <form class="space-y-4" @submit.prevent="submit">
            <div class="space-y-2 flex flex-col">
                <label for="">Tanggal Terbit</label>
                <TextInput v-model="date" type="date" class="w-1/2" required/>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 flex flex-col">
                        <label for="">Kode</label>
                        <TextInput v-model="code" type="text" required/>
                    </div>
                    <div class="space-y-2 flex flex-col">
                        <label for="">Tahun</label>
                        <TextInput v-model="year" type="text" required/>
                    </div>
                </div>
                <div class="space-y-2 flex flex-col">
                    <label for="">Nomor Awal</label>
                    <TextInput v-model="first_series" type="text" required/>
                    <p v-if="errors?.series" class="text-red-700">{{errors?.series}}</p>
                </div>
                <div class="space-y-2 flex flex-col">
                    <label for="">Jumlah Nomor</label>
                    <input v-model="amount" type="number" class="border border-gray-300  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2 flex flex-col">
                    <label for="">Nomor Akhir</label>
                   <p class="text-xl font-semibold">{{series[(amount - 1 )]}}</p> 
                </div>
            </div>
            <div class="flex space-x-2 items-center">
                <input type="checkbox" required>
                <p>Dengan ini saya memastikan bahwa nomor telah terisi dengan benar.</p>
            </div>
            <div class="flex space-x-2 justify-end pt-4 border-t border-dashed border-gray-200">
                <SecondaryButton @click="actionClose">BATAL</SecondaryButton>
                <PrimaryButton type="submit">SIMPAN</PrimaryButton>
            </div>
        </form>
    </div>
</template>