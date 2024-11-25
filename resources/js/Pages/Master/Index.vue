<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

</script>
    
<template>
    <AppLayout title="Master Data">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid gap-4 grid-cols-3">
                    <Link href="#"
                        class="group w-full flex space-x-3 bg-white shadow-md shadow-gray-200 p-4 px-4 rounded-lg border hover:bg-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                        class="w-20 h-auto text-gray-400 group-hover:text-white"
                        viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 0 1 2 2m4 0a6 6 0 0 1-7.743 5.743L11 17H9v2H7v2H4a1 1 0 0 1-1-1v-2.586a1 1 0 0 1 .293-.707l5.964-5.964A6 6 0 1 1 21 9Z"/></svg>
                        <div class="py-2">
                            <h1 class="text-xl font-bold text-gray-800 group-hover:text-white">Pelanggan</h1>
                            <p class="text-gray-700 group-hover:text-white">Master data pelanggan</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
    