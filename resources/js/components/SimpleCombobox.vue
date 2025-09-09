<script setup>
import Icon from '@/components/Icon.vue';
import { Combobox, ComboboxButton, ComboboxInput, ComboboxOption, ComboboxOptions } from '@headlessui/vue';
import { computed, ref } from 'vue';

const props = defineProps({
    modelValue: Object,
    title: String,
    placeholder: {
        type: String,
        default: 'Search for a person',
    },
    datas: {
        type: Object,
        default: {},
    },
    isRequired: {
        type: Boolean,
        default: false,
    },
    id: {
        type: String,
        default: '',
    },
    selected: Object,
});
const emit = defineEmits(['update:modelValue', 'change']);

const query = ref('');
const selectedPerson = ref(props.modelValue);
const filteredPeople = computed(() =>
    query.value === ''
        ? props.datas
        : props.datas.filter((person) => {
              return person.name.toLowerCase().includes(query.value.toLowerCase());
          }),
);

function updateHandler(e) {
    emit('update:modelValue', e);
    emit('change', e);
    // console.log(e)
}
</script>

<template>
    <Combobox as="div" v-model="selectedPerson" @update:modelValue="(val) => updateHandler(val)">
        <div class="relative mt-1">
            <ComboboxInput
                :id="id"
                :placeholder="placeholder"
                class="bg-base-100 h-9 w-full rounded-lg border-0 py-1.5 pr-10 pl-3 text-primary capitalize shadow-sm ring-1 ring-gray-300 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-primary focus:ring-inset focus-visible:outline-none sm:text-sm sm:leading-6"
                :display-value="(person) => person?.name"
            />
            <ComboboxButton class="absolute inset-y-0 right-0 flex items-center rounded-r-md px-2 focus:outline-none">
                <Icon code="heroicons:chevron-up-down" size="12" class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </ComboboxButton>

            <ComboboxOptions
                v-if="filteredPeople.length > 0"
                class="ring-opacity-5 absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-0 text-base shadow-lg ring-1 ring-primary focus:outline-none sm:text-sm"
            >
                <ComboboxOption v-for="person in filteredPeople" :key="person.id" :value="person" as="template" v-slot="{ active, selected }">
                    <li
                        :class="[
                            'relative cursor-default py-2 pr-9 pl-3 select-none',
                            active ? 'text-primary-content bg-secondary' : 'text-gray-900',
                        ]"
                    >
                        <span :class="['block truncate capitalize', selected && 'font-semibold']">
                            {{ person.name }}
                        </span>
                        <span
                            v-if="selected"
                            :class="['absolute inset-y-0 right-0 flex items-center pr-4', active ? 'text-primary-content' : 'text-primary']"
                        >
                            <Icon code="heroicons:check-solid" class="h-5 w-5" aria-hidden="true" />
                        </span>
                    </li>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

<style scoped lang="scss"></style>
