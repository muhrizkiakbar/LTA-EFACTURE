<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-3 bg-blue-50 text-blue-900 white text-sm  font-bold leading-5  focus:outline-none focus:border-indigo-700 transition'
        : 'inline-flex items-center px-3 border-transparent text-gray-400 text-sm font-medium leading-5  hover:text-blue-900 hover:border-white focus:outline-none focus:text-gray-700 focus:border-gray-300 transition';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
