<template>
    <div v-if="mobile && last > 1" class="grid w-full grid-cols-[1fr_auto_1fr]">
        <Button :variant="prev !== null ? 'secondary' : 'outline'" as-child>
            <Link :href="prev !== null ? prev : '#'" class="justify-self-start">«</Link>
        </Button>
        <div
            class="flex cursor-default items-center justify-center justify-self-center rounded-xl bg-secondary px-4 text-sm font-extrabold hover:border-none hover:outline-none"
            v-html="`Page ${current} of ${last}`"
        ></div>
        <Button :variant="next !== null ? 'secondary' : 'outline'" as-child>
            <Link :href="next !== null ? next : '#'" class="btn join-item justify-self-end">»</Link>
        </Button>
    </div>
    <div v-else-if="desktop && last > 1" class="join">
        <template v-for="(link, index) in links" :key="index">
            <Button v-if="link.url != null && link.active" class="rounded-none" as-child><Link :href="link.url" v-html="link.label"></Link></Button>
            <Button
                :class="
                    link.label.includes('Previous')
                        ? 'rounded-l-xl rounded-r-none'
                        : link.label.includes('Next')
                          ? 'rounded-l-none rounded-r-xl'
                          : 'rounded-none'
                "
                v-else-if="link.url != null && !link.active"
                variant="outline"
                as-child
            >
                <Link :href="link.url" v-html="link.label"></Link>
            </Button>
            <Button
                v-else
                :class="[
                    link.label.includes('Previous')
                        ? 'rounded-l-xl rounded-r-none'
                        : link.label.includes('Next')
                          ? 'rounded-l-none rounded-r-xl'
                          : 'rounded-none',
                    'cursor-not-allowed',
                ]"
                variant="secondary"
                as-child
            >
                <Link href="#" v-html="link.label"></Link>
            </Button>
        </template>
    </div>
</template>

<script setup>
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useMq } from 'vue3-mq';

const mq = useMq();

const props = defineProps({
    links: Array,
    align: String,
    prev: String,
    next: String,
    current: Number,
    last: Number,
    size: {
        default: 'btn-sm xl:btn-md',
        type: String,
    },
});

const mobile = computed(() => {
    return mq.mobile;
});

const desktop = computed(() => {
    return mq.desktop;
});
</script>

<style lang="scss" scoped>
.join-item {
    @apply rounded-none;
}
</style>
