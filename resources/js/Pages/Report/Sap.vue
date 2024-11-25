<script setup>
import { useForm } from "@inertiajs/inertia-vue3"
import AppLayout from '@/Layouts/AppLayout.vue';
import GridTotalData from "./ComponentSap/GridTotalData.vue";
import TableInvoice from "./ComponentSap/TableInvoice.vue"
import TextInput from "@/Components/TextInput.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"

const props = defineProps({
    count: Object,
    data: Object,
    filter: Object
})
const form = useForm({
    branch: props?.filter?.branch,
    dateStart: props?.filter?.dateStart,
    dateEnd: props?.filter?.dateEnd
})
const submit = () => form.get(route('report.erp'))
</script>

<template>
    <AppLayout title="Sap Report">
        <div class="pt-8 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-col pb-6 lg:items-center lg:justify-between md:flex-row">
                    <form @submit.prevent="submit" class="flex-shrink space-x-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <!-- <SelectInput v-model="form.branch" label="Pilih Cabang"/> -->
                            <div class="space-y-1">
                                <label class="text-sm text-gray-700">Branch</label>
                                <select v-model="form.branch" class="text-sm w-full border-gray-300 rounded-md">
                                    <option value="3">Balikpapan</option>
                                    <option value="4">Samarinda</option>
                                    <option value="5">Banjarmasin</option>
                                    <option value="6">Palangkaraya</option>
                                    <option value="8">Tarakan</option>
                                    <option value="4">Berau</option>
                                    <option value="9">Sampit</option>
                                </select>
                            </div>
                            <TextInput v-model="form.dateStart" label="Dari tangal" type="date"/>
                            <TextInput v-model="form.dateEnd" label="Sampai" type="date"/>
                            <div>
                                <PrimaryButton type="submit" class="py-2.5"> sync a/r invoice </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
                <GridTotalData :count="count"/>
                <div class="py-4">
                    <p class="uppercase text-gray-700">Invalid AR INVOICE</p>
                </div>
                <TableInvoice :data="data?.invalid"/>
            </div>
        </div>
    </AppLayout>
</template>
