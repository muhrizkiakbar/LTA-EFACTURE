<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormCra from "./Partials/Form.vue"

const form = useForm({
    bp_code: null,
    bp_name: null,
    type: null,
    doc_num: null,
    doc_date: null,
    post_date: null,
    due_date: null,
    bp_ref_no: null,
    original_amount: null,
    balance_due: null,
    pt: null,
    branch: null,
    delivery_date: null,
    pic_admin: null,
    note: null,
    remark: null,
    status: 'close',
    add_other: false
})


const submit = (val) => {
    if(val) {   
        form.add_other = true
    }
    form.post(route('masterCra.store'), 
    {
        preserveScroll: true,
        onSuccess: () => form.reset()
    })
}

</script>
<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-full rounded-lg bg-white py-4 shadow">
                    <FormCra v-model="form" @handleSubmit="submit"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>