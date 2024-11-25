<template>
    <Listbox as="div" v-model="selected" class="w-full">
      <ListboxLabel class="block text-sm font-medium text-gray-700">{{label}}</ListboxLabel>
      <div class="relative mt-1">
        <ListboxButton class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm">
          <span class="block truncate">{{ selected?.name }}</span>
          <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
            <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
          </span>
        </ListboxButton>
  
        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
          <ListboxOptions class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
            <ListboxOption as="template" v-for="item in branch" :key="item.id" :value="item" v-slot="{ active, selected }">
              <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                <span :class="[selected ? 'font-semibold' : 'font-normal', 'block truncate']">{{ item.name }}</span>
  
                <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                </span>
              </li>
            </ListboxOption>
          </ListboxOptions>
        </transition>
      </div>
    </Listbox>
  </template>
  
<script setup>
  import { ref, watch } from 'vue'
  import { Inertia } from "@inertiajs/inertia"
  import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
  import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'
  
  const props = defineProps({
    modelValue: String,
    label: {
        type: String,
        default: ''
    }
  })
  const emit = defineEmits(['update:modelValue']);

  const branch = [
    { id: 1, name: 'Balikpapan', bpl: '3' },
    { id: 2, name: 'Samarinda', bpl: '4'},
    { id: 3, name: 'Banjarmasin',bpl: '5' },
    { id: 4, name: 'Palangkaraya',bpl: '6' },
    { id: 5, name: 'Tarakan',bpl: '8' },
    { id: 6, name: 'Berau',bpl: '4' },
    { id: 7, name: 'Sampit',bpl: '9' },
  ]
  const selected = ref(branch[0])
  emit('update:modelValue', branch[0].bpl)
  watch(() => selected.value, val => {
    emit('update:modelValue', val?.bpl)
  })

</script>