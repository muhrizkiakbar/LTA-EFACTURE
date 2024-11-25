<script setup>
import { InertiaLink } from "@inertiajs/inertia-vue3"
defineProps({
    links: {
        type: Array,
        default: []
    }
})
</script>
<template>
    <div v-if="links.length > 3" class="mt-4">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <div v-if="link.url === null" :key="key"
                    class="mr-1 px-4 py-2 text-[10px] font-semibold text-gray-400 bg-white border rounded-lg" v-html="link.label" />
                <InertiaLink v-else
                    class="mr-1 px-4 py-2 text-[10px] font-semibold border rounded-lg bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-gray-900 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>