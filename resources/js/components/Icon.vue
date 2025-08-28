<template>
    <Icon :icon="code" :height="size" />
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue';
defineProps({
    code: { type: String, default: 'fa-solid:plus' },
    size: { type: String },
});
</script>

<style lang="scss" scoped></style>
