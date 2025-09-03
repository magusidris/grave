<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    Combobox,
    ComboboxAnchor,
    ComboboxEmpty,
    ComboboxGroup,
    ComboboxInput,
    ComboboxItem,
    ComboboxItemIndicator,
    ComboboxList,
    ComboboxTrigger,
} from '@/components/ui/combobox';
import { cn } from '@/lib/utils';
import { useVModel } from '@vueuse/core';
import { Check, ChevronsUpDown, Search } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    items: Array<{ value: string; label: string }>;
    modelValue?: string | number;
    class?: string;
    placeholder?: string;
}>();

const value = ref<(typeof props.items)[0]>();

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void;
}>();

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue,
});
</script>

<template>
    <Combobox v-model="modelValue" by="name">
        <ComboboxAnchor as-child>
            <ComboboxTrigger as-child>
                <Button variant="outline" class="justify-between" :class="props.class">
                    {{ modelValue?.name ?? props.placeholder }}

                    <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
            </ComboboxTrigger>
        </ComboboxAnchor>

        <ComboboxList>
            <div class="relative items-center">
                <ComboboxInput class="h-10 rounded-none border-0 border-b pl-1 focus-visible:ring-0" :placeholder="`${props.placeholder}...`" />
                <span class="absolute inset-y-0 start-0 flex items-center justify-center px-3">
                    <Search class="size-4 text-muted-foreground" />
                </span>
            </div>

            <ComboboxEmpty> No framework found. </ComboboxEmpty>

            <ComboboxGroup>
                <ComboboxItem v-for="value in props.items" :key="value.id" :value="value">
                    {{ value.name }}

                    <ComboboxItemIndicator>
                        <Check :class="cn('ml-auto h-4 w-4')" />
                    </ComboboxItemIndicator>
                </ComboboxItem>
            </ComboboxGroup>
        </ComboboxList>
    </Combobox>
</template>

<style scoped></style>
