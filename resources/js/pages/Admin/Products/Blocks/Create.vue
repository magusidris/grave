<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <form class="space-y-7" @submit.prevent="onSubmit">
                    <div class="flex w-full flex-col gap-4 xl:flex-row">
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="cluster">Cluster</Label>
                                <SimpleCombobox
                                    class="inset-y-0 start-0 w-full"
                                    title="Cluster"
                                    v-model="form.cluster"
                                    :datas="clusters"
                                    placeholder="Select Cluster"
                                />
                            </div>
                            <InputError class="mt-2" :message="form.errors.cluster" />
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="name">Block Name</Label>
                                <Input
                                    id="name"
                                    ref="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="title"
                                    placeholder="Block Name"
                                />
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="description">Block Description</Label>
                            <Textarea
                                id="description"
                                ref="description"
                                v-model="form.description"
                                type="text"
                                rows="6"
                                class="mt-1 block w-full"
                                placeholder="Block Description"
                            />
                        </div>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <Button class="bg-teal-600 hover:bg-teal-700" type="submit"> Save </Button>
                        <Button as-child><Link href="/admin/products/blocks">Batal</Link></Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import SimpleCombobox from '@/components/SimpleCombobox.vue';
// import Combobox from '@/components/Combobox.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const onSubmit = () => {
    form.post('/admin/products/blocks', {
        onSuccess: () => form.reset(),
    });
};
usePage();

defineProps<{
    clusters: object;
    errors: object;
}>();

const form = useForm({
    cluster: '',
    name: '',
    description: '',
});

const info = { title: 'Create Cluster', description: 'Create a new cluster' };

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Products',
        href: '#',
    },
    {
        title: 'Blocks',
        href: '/admin/products/blocks',
    },
    {
        title: 'Create Block',
        href: '/admin/products/blocks/create',
    },
];
</script>

<style lang="postcss" scoped></style>
