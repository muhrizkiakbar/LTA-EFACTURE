<script setup>
defineProps({
    branches: Object,
    data: Object
})
const people = [
    { name: 'Lindsay Walton', title: 'Front-end Developer', email: 'lindsay.walton@example.com', role: 'Member' },
    // More people...
]
</script>
<template>
<div>
    <div class="flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                <tr>
                <th scope="col" class="py-3 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Branch</th>
                <th scope="col" class="px-3 py-3 text-sm font-semibold text-right text-gray-900">New</th>
                <th scope="col" class="px-3 py-3 text-sm font-semibold text-right text-gray-900">Progress</th>
                <th scope="col" class="px-3 py-3 text-sm font-semibold text-right text-gray-900">Updated</th>
                <th scope="col" class="px-3 py-3 text-sm font-semibold text-right text-gray-900">All</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr v-for="(item, index) in branches" :class="index % 2 === 0 ? undefined : 'bg-gray-100'">
                <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ item.title }}</td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-right text-gray-800">{{data[item.bplId] ? data[item.bplId]?.new : 0}}</td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-right text-gray-800">{{data[item.bplId] ? data[item.bplId]?.progress : 0}}</td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-right text-gray-800">{{data[item.bplId] ? data[item.bplId]?.updated : 0}}</td>
                <td class="whitespace-nowrap px-3 py-2 text-sm text-right text-gray-800">{{data[item.bplId] ? data[item.bplId]?.all : 0}}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
</div>
</template>
  
