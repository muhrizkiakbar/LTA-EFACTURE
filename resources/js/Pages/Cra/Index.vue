<script setup>
import { FunnelIcon, BarsArrowDownIcon } from "@heroicons/vue/24/solid"
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TableCra from './Partials/Table.vue'

</script>
    
<template>
    <AppLayout title="CRA">
        <div class="py-10">
            <div class="max-w-screen-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
                <div>
                    <h1 class="text-3xl font-bold">CRA</h1>
                    <h1 class="">Customer Receivables Aging</h1>
                </div>
                <!-- table -->
                <div class="space-y-4">
                    <div class="w-full flex justify-between space-x-2">
                        <div class="flex-1">
                            <TextInput class="px-3 py-1.5 w-full" placeholder="Search"/>
                        </div>
                        <div class="flex items-center space-x-2">
                            <SecondaryButton>
                                <BarsArrowDownIcon class="w-4 h-4"/>
                            </SecondaryButton>
                            <SecondaryButton>
                                <FunnelIcon class="w-4 h-4"/>
                            </SecondaryButton>
                        </div>
                    </div>
                    <TableCra />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
    