<script setup>
import { ref } from 'vue';
import { PieChart } from 'vue-chart-3'
import { Chart, registerables } from 'chart.js'

const props = defineProps({
    data: Object
})
Chart.register(...registerables)
const options = ref({
    responsive: true,
    plugins: {
        title: {
            display: true,
            text: 'No Seri Faktur Pajak'
        },
        legend:{
            display: true,
            position: 'bottom'
        },
        
    }
})

const chartData = {
    labels: [
        'OPEN (UNUSED) ' + props.data?.data[0],
        'CLOSE (USED) ' + props.data?.data[1],
    ],
    datasets: [
        {
            label: 'My First Dataset',
            data: props.data?.data,
            backgroundColor: [
            '#334155',
            '#cbd5e1',
            ],
            hoverOffset: 7
        }
    ]
}
console.log(props.data)
</script>
<template>
    <PieChart :chart-data="chartData" :options="options" class="h-[20rem]"/>
</template>