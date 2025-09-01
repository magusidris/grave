<script setup lang="ts">
import Icon from '@/components/Icon.vue';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { computed } from 'vue';

const iconCode = {
    success: 'line-md:confirm-circle',
    error: 'line-md:close-circle',
    warning: 'line-md:alert-circle-loop',
    info: 'solar:info-circle-broken',
    question: 'line-md:question-circle',
};

const alertIconColor = {
    success: '!text-green-300',
    error: '!text-red-300',
    warning: '!text-orange-200',
    info: '!text-blue-300',
    question: '!text-gray-400',
};

const alertConfirmColor = {
    success: 'bg-green-100 text-green-800 hover:bg-green-200',
    error: 'bg-red-100 text-red-800 hover:bg-red-200',
    warning: 'bg-red-100 text-red-800 hover:bg-red-200',
    info: 'bg-blue-100 text-blue-800 hover:bg-blue-200',
    question: 'bg-red-100 text-red-800 hover:bg-red-200',
};

const alertCancelColor = {
    success: '!bg-green-100 !text-green-800 hover:!bg-green-200',
    error: '!bg-green-100 !text-green-800 hover:!bg-green-200',
    warning: '!bg-gray-100 !text-gray-800 hover:!bg-gray-200',
    info: '!bg-gray-100 !text-gray-800 hover:!bg-gray-200',
    question: '!bg-gray-100 !text-gray-800 hover:!bg-gray-200',
};

const props = defineProps({
    iconTrigger: {
        type: String,
        default: 'fa6-solid:trash',
    },
    textTrigger: {
        type: String,
        default: 'Delete',
    },
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    cancelText: {
        type: String,
        default: 'Cancel',
    },
    confirmText: {
        type: String,
        default: 'Confirm',
    },
    type: {
        type: String,
        default: 'success',
    },
});

const selectedIconColor = computed(() => {
    return props.type?.success ?? `${alertIconColor[props.type]}`;
});

const selectedIcon = computed(() => {
    return props.type?.success ?? `${iconCode[props.type]}`;
});

const selectedConfirmColor = computed(() => {
    return props.type?.success ?? `${alertConfirmColor[props.type]}`;
});

const selectedCancelColor = computed(() => {
    return props.type?.success ?? `${alertCancelColor[props.type]}`;
});

defineEmits(['confirm']);
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <Button class="bg-red-600 hover:bg-red-700">
                <Icon :code="iconTrigger" />
                {{ textTrigger }}
            </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <div class="mb-2 flex items-center justify-center">
                    <Icon :code="selectedIcon" size="100" :class="selectedIconColor" />
                </div>
                <AlertDialogTitle>{{ title }}</AlertDialogTitle>
                <AlertDialogDescription v-if="type !== 'success' && type !== 'error'">
                    {{ description }}
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter :class="type === 'success' || type === 'error' ? 'mt-3 flex items-center !justify-center' : ''">
                <AlertDialogCancel :class="selectedCancelColor">{{ type !== 'success' && type !== 'error' ? cancelText : 'Ok' }}</AlertDialogCancel>
                <AlertDialogAction
                    v-if="type !== 'success' && type !== 'error'"
                    class="bg-red-600 text-white hover:bg-red-700"
                    :class="selectedConfirmColor"
                    @click.prevent="$emit('confirm')"
                    >{{ confirmText }}</AlertDialogAction
                >
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>
