<script setup>
import { InboxStackIcon, EnvelopeOpenIcon, CubeIcon, FireIcon } from "@heroicons/vue/24/outline"

const props = defineProps({
    total: Object,
    branch: Object
})
</script>
<template>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-gradient-to-tr from-blue-700 to-sky-600 rounded-lg pt-4 px-5 overflow-hidden">
            <div class="flex space-x-2 items-center relative">
                <InboxStackIcon class="w-36 h-36 text-blue-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1 class="opacity-70">Total Ar Invoice</h1>
                    <h1 class="font-bold text-4xl">{{total?.all}}</h1>
                </div>
            </div>
            <div class="bg-blue-800/30 backdrop-blur -mx-5 py-2 px-5 mt-5 relative z-10">
                <p class="text-white text-sm">View all</p>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-cyan-700 to-sky-600 rounded-lg pt-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <EnvelopeOpenIcon class="w-36 h-36 text-cyan-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1 class="opacity-70">New Invoices</h1>
                    <h1 class="font-bold text-4xl">{{total?.new}}</h1>
                </div>
            </div>
            <div class="bg-cyan-800/30 backdrop-blur -mx-5 py-2 px-5 mt-5 relative z-10">
                <p class="text-white text-sm">View all</p>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-purple-600 to-violet-600 rounded-lg  pt-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <CubeIcon class="w-36 h-36 text-purple-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1 class="opacity-70">On Process</h1>
                    <h1 class="font-bold text-4xl">{{total?.progress}}</h1>
                </div>
            </div>
            <div class="bg-purple-800/30 backdrop-blur -mx-5 py-2 px-5 mt-5 relative z-10">
                <p class="text-white text-sm">View all</p>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-lime-600 to-green-600 rounded-lg  pt-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <FireIcon class="w-36 h-36 text-lime-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1 class="opacity-70">Updated</h1>
                    <h1 class="font-bold text-4xl">{{total?.updated}}</h1>
                </div>
            </div>
            <div class="bg-lime-800/30 backdrop-blur -mx-5 py-2 px-5 mt-5 relative z-10">
                <p class="text-white text-sm">View all</p>
            </div>
        </div>
    </div>
</template>