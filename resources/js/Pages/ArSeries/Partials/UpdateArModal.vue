<script setup>
import { useForm } from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia";
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import { ref } from "vue";
const props = defineProps({
    data: {
        type: Array,
        default: []
    },
    clearSelect: {
        type: Function,
        default: () => {}
    } 
})
const emit = defineEmits(['close', 'clearSelect'])
const submit = () => {
    let data = []
    for (const i in props.data) {
        data.push({
            docnum: props.data[i].DocNum
        })
    }
    useForm({ invoices: data }).post(route('arSeries.multipleUpdate'), {
        onSuccess: () => {
            emit("close")
            props.clearSelect()
        }
    })
}

</script>
<template>
    <div class="p-2">
        <div class="h-[50vh] overflow-y-scroll">
            <table class="min-w-full divide-y divide-gray-300">
                <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="(item, index) in data">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                            {{ item?.DocNum }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item?.CardCode }}
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ item?.CardName }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between pb-4 pt-3 border-t px-4">
            <div class="flex space-x-6 items-center">
                <p>
                    {{data?.length}} Data
                </p>
            </div>
            <div class="flex space-x-3">
                <SecondaryButton @click="emit('close')">Close</SecondaryButton>
                 <PrimaryButton @click="submit">UPDATE A/R Series</PrimaryButton>
            </div>
        </div>
    </div>
</template>