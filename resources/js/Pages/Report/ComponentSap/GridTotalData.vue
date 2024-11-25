<script setup>
import { InboxStackIcon, EnvelopeOpenIcon, CubeIcon, FireIcon } from "@heroicons/vue/24/outline"

const props = defineProps({
    count: Object,
})
</script>
<template>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-tr from-blue-700 to-sky-600 rounded-lg py-4 px-5 overflow-hidden">
            <div class="flex space-x-2 items-center relative">
                <InboxStackIcon class="w-36 h-36 text-blue-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1>Total A/R Invoices</h1>
                    <h1 class="font-bold text-4xl">{{count?.total}}</h1>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-cyan-700 to-sky-600 rounded-lg py-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <EnvelopeOpenIcon class="w-36 h-36 text-cyan-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1>Valid Data</h1>
                    <h1 class="font-bold text-4xl">{{count?.valid}}</h1>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-purple-600 to-violet-600 rounded-lg  py-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <CubeIcon class="w-36 h-36 text-purple-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1>NSFP Integrated</h1>
                    <h1 class="font-bold text-4xl">{{count?.integrate}}</h1>
                </div>
            </div>
        </div>
        <div class="bg-gradient-to-tr from-lime-600 to-green-600 rounded-lg  py-4 px-5 overflow-clip">
            <div class="flex space-x-2 items-center relative">
                <FireIcon class="w-36 h-36 text-lime-800/30 absolute -left-10 -top-8" />
                <div class="px-8" />
                <div class="text-white relative z-10">
                    <h1>Not Integrated</h1>
                    <h1 class="font-bold text-4xl">{{count?.notIntegrate}}</h1>
                </div>
            </div>
        </div>
    </div>
</template>