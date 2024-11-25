<script setup>
import numeral from "numeral"
import { ref } from "vue";
import { InboxArrowDownIcon, TrashIcon } from "@heroicons/vue/20/solid"
import { useForm } from "@inertiajs/inertia-vue3"
import Modal from "@/Components/Modal.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"

defineProps({
    data: {
        type: Array,
        default: []
    },
    total: {
        type: Number,
        default: 0
    },
    user: {
        type: Array,
        default: []
    }
})

const selectedItems = ref([])
const modal = ref(false)
const formAddTask = useForm({
    tasks: selectedItems.value,
    assigned: null,
})
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
const addTask = () => formAddTask.post(route('masterCra.addTask'), { preserveScroll: true})

</script>
<template>
    <div class="flex justify-between items-center px-3 py-2 bg-white border shadow-sm rounded mb-4">
        <div class="flex items-center">
            <p class="text-[12px] text-gray-500">Selected : <span class="font-semibold text-gray-800">{{ selectedItems?.length }}</span></p>
            <div v-if="selectedItems.length > 0">
                <button type="button" class="border px-2 py-1 rounded flex items-center space-x-2 ml-4 hover:bg-gray-100" @click="modal = true">
                     <InboxArrowDownIcon class="w-5 h-5"/>
                     <span class="text-[13px]">Add To Task</span> 
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
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP NAME</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP NAME</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">TYPE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DOC. NUM</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DOC. DATE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">POST DATE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DUE DATE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BP. REF. NO</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">OR AMOUNT</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">BALANCE DUE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">PLT - BRANCH</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">DELIVERY DATE</th>
                    <!-- <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">PIC ADMIN</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">NOTE</th>
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">REMARK</th> -->
                    <th scope="col" class="px-2 py-2 text-left whitespace-nowrap text-[11px] font-bold text-gray-900">STATUS</th>
                    <!-- <th scope="col" class="relative py-2 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th> -->
                </tr>
            </thead>
            <tbody class="bg-white" v-if="data?.length > 0">
                <tr v-for="(item, index) in data" 
                    :class="[index % 2 === 0 ? undefined : 'bg-gray-50', 'divide-x hover:bg-gray-200/70']">
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> 
                        <input type="checkbox" @click="select(item)" :checked="findId(item?.id)[0] ? true : false">
                    </td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3 "> {{ item['bp_code'] }} <button></button></td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['bp_name'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['type'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-bold text-gray-900 sm:pl-3"> {{ item['doc_num'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['doc_date'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['post_date'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['due_date'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['bp_ref_no'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] text-right font-medium text-gray-900 sm:pl-3"> {{ n(item['original_amount']) }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] text-right font-medium text-gray-900 sm:pl-3"> {{ n(item['balance_due']) }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['pt'] }} - {{ item['branch'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['delivery_date'] }}</td>
                    <!-- <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['pic_admin'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{ item['note'] }}</td>
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3"> {{item['remark']}}</td> -->
                    <td class="whitespace-nowrap py-2 pr-3 text-[12px] font-medium text-gray-900 sm:pl-3 uppercase"> {{item['status'] }}</td>
                    <!-- <t6
                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span
                                class="sr-only">, {{ .name }}</span></a>
                    </td> -->
                </tr>
            </tbody>
            <tbody class="bg-white" v-else>
                <tr>
                    <td colspan="16" class="py-8 w-full text-center">
                        <p class="font-semibold text-gray-500">CRA</p>
                        <p class=" text-gray-400">Data Cra Kosong, Tambahkan data</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <Modal :show="modal" >
        <div class="py-2 px-4">
            <div class="py-2">
                <p>{{selectedItems.length}} <span class="text-gray-500">Data terpilih</span> </p>
            </div>
            <div class="py-2">
                <div>
                    <ul>
                        <li :class="['border p-2 flex justify-between relative', item?.delivery_date ? '' : 'bg-red-100 border-red-500']" v-for="item in selectedItems" >
                            <div>
                                <p class="text-[12px]">{{item?.delivery_date ? item?.delivery_date : '-'}}</p>
                                <p class="text-sm font-semibold">{{item?.bp_code}}</p>
                            </div>
                            <div>
                                <p class="text-[12px]">CUS. NAME</p>
                                <p class="text-sm font-semibold">{{item?.bp_name}}</p>
                            </div>
                            <div>
                                <p class="text-[12px]">OR. AMOUNT</p>
                                <p class="text-sm font-semibold">IDR. {{n(item?.original_amount)}}</p>
                            </div>
                            <button 
                                type="button" 
                                :class="['bg-gray-100 px-4 rounded', item?.delivery_date ? '' : 'bg-red-500']"
                                @click="removeSelected(item?.id)"
                                >
                                <TrashIcon :class="['w-4 h-4', item?.delivery_date ? '' : 'text-white']"/>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="py-2 space-y-2">
                <label >Assign to</label>
                <select v-model="formAddTask.assigned" class="w-full">
                    <option v-for="item in user" :value="item?.id">{{item?.name}}</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <SecondaryButton @click="modal = !modal">Batal</SecondaryButton>
                <PrimaryButton @click="addTask">Simpan</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>