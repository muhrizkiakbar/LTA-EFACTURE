<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import GridTotalMonthly from "./Components/GridTotalMonthly.vue"
import ArSeriesBarChart from './Components/ArSeriesBarChart.vue';
import ArSeriesPieChart from './Components/ArSeriesPieChart.vue';
import TableBranch from "./Components/TableBranch.vue"
defineProps({
    branch: Object,
    total: Object,
    time: String,
    branches: Object,
    chart: Object,
    keySeries: Object
})
</script>
<template>
    <AppLayout title="Report">
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div >
                        <div class=" bg-white shadow py-5 px-4 rounded-lg">
                            <ArSeriesPieChart :data="keySeries"/>
                        </div>
                    </div>
                    <div class="space-y-4"> 
                        <div class="w-full py-4 px-5 rounded-lg border bg-white flex justify-between">
                            <div>
                                <h1 class="text-gray-500">Report sync at</h1>
                            </div>
                            <div class="relative">
                                <h1 class="font-bold text-gray-800">{{time}}</h1>
                                <div class="h-5 w-5 bg-rose-600 animate-ping rounded-full -top-6 -right-6 absolute"/>
                                <div class="h-5 w-5 bg-rose-600/70 rounded-full -top-6 -right-6 absolute"/>
                            </div>
                        </div>
                        <GridTotalMonthly :total="total" :branch="branch"/>
                    </div>
                </div>
                <div class="mt-6 space-y-4">
                    <h1 class="text-gray-600">Report by branch</h1>
                    <TableBranch :branches="branches" :data="branch" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
