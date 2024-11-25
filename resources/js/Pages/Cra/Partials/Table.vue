<script setup>
import { TrashIcon, PencilIcon } from "@heroicons/vue/24/outline"
const people = [
    { DocNum: '2130216283 ', bpref: 'FK/FXG-21004265', customer: 'AMI H', amount: '1643400' },
    { DocNum: '2130216283 ', bpref: 'FK/FXG-21004265', customer: 'AMI H', amount: '1643400' },
    { DocNum: '2130216283 ', bpref: 'FK/FXG-21004265', customer: 'AMI H', amount: '1643400' },
    { DocNum: '2130216283 ', bpref: 'FK/FXG-21004265', customer: 'AMI H', amount: '1643400' },
    // More people...
]
</script>
<template>
    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="relative py-3.5 flex justify-start pl-3">
                        <input type="checkbox">
                    </th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm uppercase font-semibold text-gray-900 sm:pl-6">No. Document
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm uppercase font-semibold text-gray-900">Bp Ref. No</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm uppercase font-semibold text-gray-900">Customer</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm uppercase font-semibold text-gray-900">Amount</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr v-for="(person, personIdx) in people" :key="person.email"
                    :class="['group hover:bg-gray-100 ']">
                    <td class="whitespace-nowrap  font-medium text-gray-900 flex justify-start pl-3 py-3">
                        <input type="checkbox">
                    </td>
                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-900">{{ person.DocNum }}</td>
                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-900">{{ person.bpref }}</td>
                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-900">{{ person.customer }}</td>
                    <td class="whitespace-nowrap px-3 py-3 text-sm text-gray-900">{{ person.amount }}</td>
                    <td class="relative whitespace-nowrap py-3 pl-3 pr-4 text-right text-sm font-medium space-x-2 sm:pr-6">
                        <button type="button" class="p-1 bg-indigo-100 rounded  "><PencilIcon class="w-4 h-4 "/></button>
                        <button type="button" class="p-1 bg-gray-100 rounded "><TrashIcon class="w-4 h-4 "/></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>