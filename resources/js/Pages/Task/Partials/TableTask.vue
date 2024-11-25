<script setup>
import numeral from "numeral"
import { ref } from "vue";
import { CheckBadgeIcon,  } from "@heroicons/vue/20/solid"
defineProps({
    data: {
        type: Array,
        default: []
    },
    total: {
        type: Number,
        default: 0
    }
})

const selectedItems = ref([])
const modal = ref(false)
const n = (data) => {
    return numeral(data).format('0,0.00')
}
const select = (item) => {
    let dataId = findId(item.id)
    if (dataId[0]) {
        removeSelected(item.id)
    } else {
        selectedItems.value.push(item)
    }
} 
function removeSelected(id) {
  const objWithIdIndex = selectedItems.value.findIndex((obj) => obj.id === id);
  selectedItems.value.splice(objWithIdIndex, 1);
}
const findId = (id) => selectedItems.value.filter(item => item.id === id)

</script>
<template>
    <div class="flex justify-between items-center px-3 py-2 bg-white border shadow-sm rounded mb-4">
        <div class="flex items-center space-x-2">
            <p class="text-[12px] text-gray-500">Selected : <span class="font-semibold text-gray-800">{{ selectedItems?.length }}</span></p>
            <div v-if="selectedItems.length > 0">
                <button type="button" class="border px-2 py-1 rounded flex items-center space-x-2 ml-4 bg-green-100 group hover:bg-green-800" >
                     <CheckBadgeIcon class="w-5 h-5 text-green-800 group-hover:text-white"/>
                     <span class="text-[13px] text-green-800 font-semibold group-hover:text-white">Mark as done</span> 
                </button>
            </div>
        </div>
        <div>
            <p class="text-[12px] text-gray-500">Total : <span class="font-semibold text-gray-800">{{ total }}</span></p>
        </div>
    </div>
    <div class="overflow-x-scroll shadow ring-1 ring-black ring-opacity-5 max-w-screen-2xl md:rounded-md">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr class="divide-x">
                    <th scope="col" class="py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900 sm:pl-3">#</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">POST DATE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP. CODE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DOC NUM</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP. REF. NO</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP. NAME</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DELIVERY DATE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">OR AMOUNT</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BALANCE DUE</th>
                    <!-- <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">ASSIGNED</th> -->
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">STATUS</th>
                </tr>
            </thead>
            <tbody class="bg-white" v-if="data?.length > 0">
                <tr v-for="(item, index) in data" 
                    :class="[index % 2 === 0 ? undefined : 'bg-gray-50', 'divide-x hover:bg-gray-200/70']">
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 w-10 sm:pl-3"> 
                        <input type="checkbox" @click="select(item)" :checked="findId(item?.id)[0] ? true : false">
                    </td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['posting_date'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3">  {{ item['bp_code'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-bold text-gray-900 sm:pl-3"> {{ item['doc_num'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['bp_ref_no'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['bp_name'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['delivery_date'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ n(item['original_amount']) }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ n(item['balance_due']) }}</td>
                    <!-- <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['user_id'] }}</td> -->
                    <!-- <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['assigned'] }}</td> -->
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-white sm:pl-3 uppercase bg-cyan-600 text-center"> {{item['status'] }}</td>
                </tr>
            </tbody>
            <tbody class="bg-white" v-else>
                <tr>
                    <td colspan="16" class="py-8 w-full text-center">
                        <p class=" text-gray-400">Data Task Kosong</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>