<script setup>
import { onMounted, ref, computed } from 'vue';

defineProps({
    modelValue: String,
    placeholder: {
        type: String,
        default: ''
    },
    errMessage: String,
    label: {
        type: String,
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    disabled: {
        type: Boolean,
        default: false
    }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="flex flex-col space-y-1">
        <label for="" class="block text-sm font-medium text-gray-700">{{label}}</label>
        <input
            ref="input"
            :class="[errMessage?.length > 0 ? 'border-red-500' : 'border-gray-300' ,'border  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md py-1.5 px-3']"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :placeholder="placeholder"
            :type="type"
            :disabled="disabled"
        >
    </div>
</template>
