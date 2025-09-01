<template>
    <Icon :icon="code" :height="size" :class="class" />
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue';
defineProps({
    code: { type: String, default: 'fa-solid:plus' },
    size: { type: String },
    class: { type: String },
});
</script>

<style lang="scss" scoped></style>
