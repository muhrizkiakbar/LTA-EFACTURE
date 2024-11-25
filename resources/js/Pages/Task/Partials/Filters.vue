<script setup>
import { reactive, ref, watch } from "vue"
import { Inertia,  } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3"
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue"
import { BarsArrowDownIcon, BarsArrowUpIcon, CalendarDaysIcon, ArrowPathRoundedSquareIcon, PlusIcon, AdjustmentsVerticalIcon } from "@heroicons/vue/20/solid"
import { 
    Menu, 
    MenuButton, 
    MenuItems, 
    MenuItem,
    Disclosure,
    DisclosureButton,
    DisclosurePanel 
} from '@headlessui/vue'
import {  DatePicker } from 'v-calendar';
import 'v-calendar/dist/style.css';
import moment from "moment";

const props = defineProps({
    modelValue: Object,
})

const form = reactive({
    sort: props.modelValue?.sort,
    tarashed: props.modelValue?.tarashed ?? null,
    search: props.modelValue?.search,
    date: props.modelValue?.date,
    size: props.modelValue?.size,
    status: props.modelValue?.status,
})

const dateInput = ref(null)

watch(() => dateInput.value, 
(val) => {
    form.date = moment(val).format('YYYY-MM-DD')
    console.log(form.date)
}, {deep: true})

watch(
  () => form,
  (value) => {
    submit(value)
    console.log(form)
  },
  {
    deep: true,
  }
)
const submit = (params) => Inertia.get(route("task", params), {}, { preserveState: true });

const handleSort = () => {
    if (form.sort === 'desc') form.sort = 'asc'
    else  form.sort = 'desc'
}

const resetFilter = () => Inertia.get(route('task'), {}, { preserveState: true })
</script>
<template>
    <div class="grid grid-cols-1 py-2 items-center  md:grid-cols-2">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Task</h1>
            <h4 class="text-sm text-gray-700">Task pekerjaan</h4>
        </div>
        
        <div class="flex justify-end space-x-2 ">
            <div class="flex-1">
                <TextInput placeholder="BP. CODE, BP. NAME, DOC. NUM" v-model="form.search" class="px-3 text-sm py-2 w-full placeholder:text-gray-300" />
            </div>
            <div>
                <Menu as="div" class="relative">
                    <MenuButton class="space-x-2 text-gray-800 py-2 px-3 rounded border border-gray-300 bg-white relative">
                        <CalendarDaysIcon class="w-5 h-5" />
                    </MenuButton>
                    <MenuItems as="div" class="absolute left-[-9rem] mt-2 shadow-xl rounded">
                        <MenuItem as="div" class="space-y-2 p-2 bg-white rounded-lg border border-gray-300 relative">
                            <DatePicker 
                                v-model="dateInput"
                                :max-date="new Date()"
                                color="blue"
                            />
                            <SecondaryButton class="w-full flex items-center justify-center space-x-2" @click="form.date = null">
                                <ArrowPathRoundedSquareIcon class="w-5"/>
                                <span>Reset</span>
                            </SecondaryButton>
                        </MenuItem>
                    </MenuItems>
                </Menu>
            </div>
            <div class="relative">
                <Disclosure as="div" >
                    <DisclosureButton class="space-x-2 text-gray-800 py-2 px-3 rounded border border-gray-300 bg-white relative">
                        <AdjustmentsVerticalIcon class="w-5 h-5" />
                    </DisclosureButton>
                    <DisclosurePanel class="absolute space-y-2 p-2 bg-white rounded-lg border border-gray-300 w-[15rem] -left-[12rem] mt-2 shadow-lg">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="relative">
                               <SecondaryButton  type="button" @click="handleSort" class="w-full flex space-x-2">
                                    <BarsArrowDownIcon v-if="form?.sort === 'desc'" class="w-5" />
                                    <BarsArrowUpIcon v-if="form?.sort === 'asc'" class="w-5" />
                                    <span>{{form?.sort}}</span>
                                </SecondaryButton>
                            </div>
                            <div class="relative">
                                <select v-model="form.size" class="w-full border text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="60">60</option>
                                    <option value="80">80</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="relative">
                        <select v-model="form.status" class="w-full border text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                <option value="close">OPEN</option>
                                <option value="open">FINISH</option>
                            </select>
                        </div>
                        <SecondaryButton class="w-full flex items-center justify-center space-x-2" @click="resetFilter">
                            <ArrowPathRoundedSquareIcon class="w-5"/>
                            <span>Reset</span>
                        </SecondaryButton>
                    </DisclosurePanel>
                </Disclosure>
            </div>
        </div>
    </div>
</template>