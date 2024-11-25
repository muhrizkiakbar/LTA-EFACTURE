<script setup>
import { ref } from 'vue';
import { BarChart } from 'vue-chart-3'
import { Chart, registerables } from 'chart.js'
import { Inertia } from "@inertiajs/inertia"

const props = defineProps({
    data: Object
})

Chart.register(...registerables)

const options = ref({
    responsive: true,
    plugins: {
        legend:{
            display: false,

        },
        title: {
            display: true,
            text: 'Sync Ar Invoice By date'
        }
    },
    scales: {
        x: {
            grid: { display: false, borderColor: 'transparent' },
            ticks: {
                color: '#94a3b8'
            }
        },
        y: {
            grid: { display: true, borderColor: 'transparent' },
            ticks: {
                color: '#94a3b8',
                display: true
            }
        },
    }
})

const chartData =  {
    labels: props.data?.keysSeries?.labels,
    datasets: [
        {
            label: 'key Series',
            backgroundColor: '#475569',
            data: props.data?.keysSeries?.data
        },
        {
            label: 'Invoices',
            backgroundColor: '#1e293b',
            data: props.data?.invoices?.data
        }
    ]
}

console.log(props.data)
</script>
<template>
    <BarChart :chart-data="chartData" :options="options" class="h-[20rem]"/>
</template>