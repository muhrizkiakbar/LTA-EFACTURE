<script setup>
import { reactive } from "vue"
import AppLayout from '@/Layouts/AppLayout.vue';
import FiltersTask from "./Partials/Filters.vue"
import TableTask from "./Partials/TableTask.vue"

const props = defineProps({
    task: Object,
    filters: Object
})

const filters = reactive({
    sort: props.filters?.sort,
    tarashed: props.filters?.tarashed ?? null,
    search: props.filters?.search,
    date: props.filters?.date,
    size: props.filters?.size,
    status: props.filters?.status
})

</script>

<template>
    <AppLayout title="Task ">
        <div class="pb-12 pt-6">
            <div class="mx-auto sm:px-6 lg:px-8">
                <FiltersTask v-model="filters"/>
                <TableTask :data="task.data" :total="task.total"/>
            </div>
        </div>
    </AppLayout>
</template>
