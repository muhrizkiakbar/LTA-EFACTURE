<script setup>
import { reactive } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    modelValue: {
        type: Object,
        default: {}
    }
})

const emit = defineEmits(['handleSubmit'])

const submit = () => {
    emit('handleSubmit')
}

const addOther = () => {
    emit('handleSubmit', true)
}
</script>
<template>
    <div class="px-4 py-4">
        <div class="pb-8 text-center">
            <h1 class="text-2xl font-semibold text-gray-800 ">Customer Receivables Aging</h1>
            <p class="underline underline-offset-4 text-gray-700"><i>perhatikan setiap inputan dengan tanda ( * ) wajib untuk diisi.</i></p>
        </div>
        <div class="px-4">
            <div class="grid grid-cols-1 gap-x-4 md:grid-cols-3 lg:grid-cols-4">
                <div class="space-y-2">
                    <label class="label-input">doc. num*</label>
                    <TextInput v-model="modelValue.doc_num" :errMessage="modelValue.errors?.doc_num" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.doc_num"/>
                </div>
                <div class="space-y-2 flex flex-col justify-end">
                    <label class="label-input">type*</label>
                    <select v-model="modelValue.type" :class="['py-1.5 w-full', modelValue.errors?.type ? 'border-red-500 rounded' : 'select-input']">
                        <option value="CN">CN</option>
                        <option value="CN">IN</option>
                    </select>
                    <InputError :message="modelValue.errors?.type"/>
                </div>
                <div class="space-y-2 flex flex-col justify-end">
                    <label class="label-input">PT*</label>
                    <select v-model="modelValue.pt" :class="['py-1.5 w-full', modelValue.errors?.pt ? 'border-red-500 rounded' : 'select-input']">
                        <option value="LTA">LTA</option>
                        <option value="TAA">TAA</option>
                    </select>
                    <InputError :message="modelValue.errors?.pt"/>
                </div>
                <div class="space-y-2 flex flex-col justify-end">
                    <label class="label-input">BRANCH*</label>
                    <select v-model="modelValue.branch" :class="['py-1.5 w-full', modelValue.errors?.branch ? 'border-red-500 rounded' : 'select-input']">
                        <option value="BPP">BPP</option>
                        <option value="BJM">BJM</option>
                    </select>
                    <InputError :message="modelValue.errors?.branch"/>
                </div>
            </div>
        </div>
        <div class="border-t-2 border-dashed my-4 border-gray-200 -mx-4"/>
        <div class="grid grid-cols-1 ">
            <div class="px-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                <!-- DOC DATE -->
                <div class="space-y-2">
                    <label class="label-input">DOC DATE</label>
                    <TextInput v-model="modelValue.doc_date" type="date" class="w-full py-1.5 px-3"/>
                </div>
                <!-- DOC DATE -->
                 <div class="space-y-2">
                    <label class="label-input">POST DATE</label>
                    <TextInput v-model="modelValue.post_date" type="date" class="w-full py-1.5 px-3"/>
                </div>
                <!-- DOC DATE -->
                <div class="space-y-2">
                    <label class="label-input">DUE DATE</label>
                    <TextInput v-model="modelValue.due_date" type="date" class="w-full py-1.5 px-3"/>
                </div>
            </div>
        <div class="border-t-2 border-dashed my-4 border-gray-200 -mx-4"/>
            <div class="px-4 space-y-1">
               
                <!-- BP CODE -->
                <div class="space-y-2">
                    <label class="label-input">bp. code*</label>
                    <TextInput v-model="modelValue.bp_code" :errMessage="modelValue.errors?.bp_code" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.bp_code"/>
                </div>
                <!-- BP NAME -->
                <div class="space-y-2">
                    <label class="label-input">bp. name*</label>
                    <TextInput v-model="modelValue.bp_name" :errMessage="modelValue.errors?.bp_name" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.bp_name"/>
                </div>
            </div>
        </div>
        <div class="border-t-2 border-dashed my-4 border-gray-200 -mx-4"/>
        <div class="px-4 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="space-y-1">
                <!-- BP REF NO -->
                <div class="space-y-2">
                    <label class="label-input">BP. REF. NO*</label>
                    <TextInput v-model="modelValue.bp_ref_no" :errMessage="modelValue.errors?.bp_ref_no" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.bp_ref_no"/>
                </div>
            </div>
            <div class="space-y-1">
                 <!-- ORIGINAL AMOUNT -->
                 <div class="space-y-2">
                    <label class="label-input">original amount*</label>
                    <TextInput v-model="modelValue.original_amount" :errMessage="modelValue.errors?.original_amount" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.original_amount"/>
                </div>
                <!-- BALANCE DUE -->
                <div class="space-y-2">
                    <label class="label-input">balance due*</label>
                    <TextInput v-model="modelValue.balance_due" :errMessage="modelValue.errors?.balance_due" class="w-full py-1.5 px-3"/>
                    <InputError :message="modelValue.errors?.balance_due"/>
                </div>
            </div>
        </div>
        <div class="border-t-2 border-dashed my-4 border-gray-200 -mx-4"/>
        <div class="px-4 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="space-y-1">
                 <!-- PIC ADMIN -->
                 <div class="space-y-2">
                    <label class="label-input">pic admin</label>
                    <TextInput v-model="modelValue.pic_admin" class="w-full py-1.5 px-3"/>
                </div>
            </div>
            <div class=" space-y-1">
                <!-- DELIVERY DATE -->
                <div class="space-y-2">
                    <label class="label-input">delivery date</label>
                    <TextInput type="date" v-model="modelValue.delivery_date" class="w-full py-1.5 px-3"/>
                </div>
                 <!-- DELIVERY DATE -->
                 <div class="space-y-2">
                    <label class="label-input">remarks</label>
                    <TextInput v-model="modelValue.remark" class="w-full py-1.5 px-3"/>
                </div>
            </div>
        </div>
        <div class="px-4 py-2 flex flex-col space-y-1">
            <label class="label-input">Note</label>
            <textarea v-model="modelValue.note" class="select-input"></textarea>
        </div>
        <div class="border-t-2 border-dashed my-4 border-gray-200 -mx-4"/>
        <div class="flex justify-end space-x-2">
            <SecondaryButton >Cancel</SecondaryButton>
            <PrimaryButton type="button" @click="addOther"> CREATE & ADD OTHER DATA</PrimaryButton>
            <PrimaryButton type="button" @click="submit">CREATE</PrimaryButton>
        </div>
    </div>
</template>