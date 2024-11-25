<script setup>
import { CreditCardIcon, MapPinIcon, WalletIcon } from "@heroicons/vue/24/outline"
const props = defineProps({
    data : {
        type: Object,
        default: {}
    }
})
</script>
<template>
    <div class="px-5">
        <div class="flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle px-3">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                        Doc. number</th>
                                    <th scope="col" class="px-3 py-3.5 w-20 whitespace-nowrap text-left text-sm font-semibold text-gray-900">
                                        Card code</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Customer</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        NSFP</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Cus. Ref Number</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 text-center sm:pr-6">
                                        {{data?.length}} Invoice
                                    </th>
                                </tr>
                            </thead>
                            <tbody v-if="data?.length > 0" class="bg-white">
                                <tr v-for="(item, index) in data.sort((a, b ) => a.DocNum - b.DocNum)" 
                                :class="[index % 2 ? 'bg-gray-100' : '','hover:bg-gray-100 cursor-pointer']">
                                    <td @click="openDetail(item)" class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 hover:underline">
                                        {{ item?.DocNum }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.CardCode }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-900">{{ item?.CardName }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.NSFP }}</td>
                                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-700">{{ item?.NumAtCard }}</td>
                                    <td class="relative whitespace-nowrap py-2 text-sm font-medium flex items-center space-x-4 justify-center">
                                        <WalletIcon class="w-5 h-5" :class="[ item?.LicTradNum == '00.000.000.0-000.000' || item?.LicTradNum == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
                                        <CreditCardIcon class="w-5 h-5" :class="[ item?.NIK == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
                                        <MapPinIcon class="w-5 h-5" :class="[ item?.Street == null ? 'text-rose-500' : 'text-emerald-500' ]"/>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="6" class="py-3 text-center">
                                        Ar invoice kosong
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>