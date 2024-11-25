<script setup>
import { reactive, watch } from "vue"
import { Inertia } from "@inertiajs/inertia"
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline"
import TextInput from "@/Components/TextInput.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import pickBy from "lodash-es/pickBy"

const props = defineProps({
    filters: Object,
    branch: {
        type: Object,
        default: {}
    },
    status: Number,
    recap: Object
})
const form = reactive({
    status: props.status,
    branch: props?.filters?.branch,
    search: props?.filters?.search,
    limit: props?.filters?.limit
})

watch(
  () => form,
  (value) => {
    let params = pickBy(value);
    if (Object.keys(params).length === 0) {
      params = { remember: "forget" };
    }
    submit(params);
  },
  {
    deep: true,
  }
)

const submit = (params) => Inertia.get(route('arSeries.index', params), {}, { preserveState: true })

</script>
<template>
<div class="pt-6 pb-2">
    <div class="grid grid-cols-1 lg:grid-cols-2 lg:items-end gap-y-4 ">
        <div class="flex space-x-2 items-end">
            <TextInput v-model="form.search" label="Doc. Number"/>
            <div class="flex-shrink-0">
                <label class="text-sm text-gray-700">Status</label>
                <select v-model="form.status" class="text-sm w-full border-gray-300 rounded-md">
                    <option :value="0">NEW</option>
                    <option :value="1">PROCESS</option>
                    <option :value="2">UPDATED</option>
                </select>
            </div>
            <div class="flex-shrink-0">
                <label class="text-sm text-gray-700">Branch</label>
                <select v-model="form.branch" class="text-sm w-full border-gray-300 rounded-md">
                    <option v-for="item in branch" :value="item.bplId">{{item?.title}}</option>
                </select>
            </div>
            <TextInput label="Limit" v-model="form.limit" class="w-20"/>
        </div>
        <div class="flex space-x-2 px-3 justify-start lg:justify-end items-center">
            <div >
                <h1 class="text-gray-400">NEW: <span class="text-gray-700 font-bold">{{recap?.new}}</span></h1>
            </div>
            <div >
                <h1 class="text-gray-400">PROGRESS: <span class="text-gray-700 font-bold">{{recap?.progress}}</span></h1>
            </div>
            <div >
                <h1 class="text-gray-400">UPDATED: <span class="text-gray-700 font-bold">{{recap?.updated}}</span></h1>
            </div>
        </div>
    </div>
</div>
</template>