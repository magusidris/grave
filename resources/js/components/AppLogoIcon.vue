<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img src="/images/logo.webp" alt="eDigi Logo" class="h-5 w-5" :class="$attrs.className" v-bind="$attrs" />
</template>
