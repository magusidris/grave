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
                                <Label for="name">Name</Label>
                                <Input
                                    id="name"
                                    ref="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="name"
                                    placeholder="Name"
                                />
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="width">Width</Label>
                                <Input id="width" ref="width" v-model="form.width" type="text" class="mt-1 block w-full" placeholder="Width" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.width" />
                        </div>
                    </div>
                    <div class="flex w-full flex-col gap-4 xl:flex-row">
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="name">Height</Label>
                                <Input id="height" ref="height" v-model="form.height" type="text" class="mt-1 block w-full" placeholder="height" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="price">Price</Label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-3 flex items-center justify-center">Rp</span>
                                    <Input
                                        id="price"
                                        ref="price"
                                        v-model="form.price"
                                        type="number"
                                        min="0"
                                        class="mt-1 block w-full pl-12"
                                        placeholder="price"
                                    />
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.width" />
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
                        <Button as-child><Link href="/admin/products/types">Batal</Link></Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const onSubmit = () => {
    form.post('/admin/products/types', {
        onSuccess: () => form.reset(),
    });
};
usePage();

defineProps<{
    clusters: object;
    errors: object;
}>();

const form = useForm({
    name: '',
    width: '',
    height: '',
    price: 3000000,
    description: '',
});

const info = { title: 'Create Type', description: 'Create a new type' };

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
        title: 'Types',
        href: '/admin/products/types',
    },
    {
        title: 'Create Type',
        href: '/admin/products/types/create',
    },
];
</script>

<style lang="postcss" scoped></style>
