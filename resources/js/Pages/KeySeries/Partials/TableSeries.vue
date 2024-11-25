<script setup>
import { Link } from "@inertiajs/inertia-vue3"
defineProps({
    data: Object
})
const percentage = (num, per) => {
    return (num/100)*per;
}
</script>
<template>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                    Tanggal Terbit</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sisa
                                    No. Seri Faktur Pajak 
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-right text-sm font-semibold text-gray-900">
                                    Nomor Faktur Pajak
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="data?.length == 0" class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td colspan="3" class="whitespace-nowrap pl-4 pr-3 py-4 text-sm text-gray-500 font-semibold text-center">Nomer Serial Faktur Pajak, kosong</td>
                            </tr>
                        </tbody>
                        <tbody v-else class="divide-y divide-gray-200 bg-white">
                            <tr v-for="(item, index) in data">
                                <td class="whitespace-nowrap pl-4 pr-3 py-4 text-sm text-left text-gray-800 font-semibold w-32">{{index}}</td>
                                <td class="whitespace-nowrap px-3 text-sm font-medium text-gray-900 group ">
                                    <Link :href="route('keySeries.detail', index)" class="group-hover:underline">{{item?.first}} - {{item?.last}}</Link>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>
                                        <div class="flex justify-end space-x-4">
                                            <p class="font-semibold text-gray-800 text-[14px] text-right">{{item?.unused}} <span class="font-normal text-gray-400">Remaining</span></p>
                                            <p class="font-semibold text-gray-500 text-[14px] text-right"><span class="font-bold text-gray-800">{{item?.used}}</span>/{{item?.total}}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>