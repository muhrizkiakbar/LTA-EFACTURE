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
import { Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/dist/style.css';
import moment from "moment";

const props = defineProps({
    modelValue: Object,
    openModalUpload: {
        type: Function, 
        default: () => {}
    }
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
const submit = (params) => Inertia.get(route("masterCra", params), {}, { preserveState: true });

const handleSort = () => {
    if (form.sort === 'desc') form.sort = 'asc'
    else  form.sort = 'desc'
}

const resetFilter = () => Inertia.get(route('masterCra'), {}, { preserveState: true })
</script>
<template>
    <div class="grid grid-cols-1 py-2 items-center  md:grid-cols-2">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">CRA</h1>
            <h4 class="text-sm text-gray-700">Master data CRA</h4>
        </div>
        
        <div class="flex justify-end space-x-2 ">
            <div class="flex-1">
                <TextInput placeholder="BP. CODE, BP. NAME, DOC. NUM" v-model="form.search" class="px-3 text-sm py-2 w-full placeholder:text-gray-300" />
            </div>
            <div>
                <!-- upload modal -->
                <SecondaryButton type="button" class="flex space-x-2" @click="openModalUpload">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-auto mx-auto text-gray-800"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m2.859 2.877 12.57-1.795a.5.5 0 0 1 .571.495v20.846a.5.5 0 0 1-.57.495L2.858 21.123a1 1 0 0 1-.859-.99V3.867a1 1 0 0 1 .859-.99zM4 4.735v14.53l10 1.429V3.306L4 4.735zM17 19h3V5h-3V3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-4v-2zm-6.8-7 2.8 4h-2.4L9 13.714 7.4 16H5l2.8-4L5 8h2.4L9 10.286 10.6 8H13l-2.8 4z" />
                    </svg>
                    <span>Upload</span>
                </SecondaryButton>
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
                    <DisclosureButton class="space-x-2 text-gray-800 py-2 px-3 rounded border border-gray-300 bg-white relativ">
                        <AdjustmentsVerticalIcon class="w-5 h-5" />
                    </DisclosureButton>
                    <DisclosurePanel class="absolute space-y-2 p-2 bg-white rounded-lg border border-gray-300 w-[15rem] -left-[10rem] mt-2 shadow-lg">
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
                                <option value="close">CLOSE</option>
                                <option value="open">OPEN</option>
                                <option value="progress">PROGRESS</option>
                                <option value="done">DONE</option>
                            </select>
                        </div>
                        <SecondaryButton class="w-full flex items-center justify-center space-x-2" @click="resetFilter">
                            <ArrowPathRoundedSquareIcon class="w-5"/>
                            <span>Reset</span>
                        </SecondaryButton>
                    </DisclosurePanel>
                </Disclosure>
            </div>
            <div>
                <Link :href="route('masterCra.create')" class="inline-flex space-x-2 items-center px-4 py-2 bg-gray-800 text-white rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-gray-700 hover:text-gray-200 focus:outline-none focus:border-gray-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                    <PlusIcon class="w-5 h-5"/>
                    <span>ADD</span>
                </Link>
            </div>
        </div>
    </div>
</template>