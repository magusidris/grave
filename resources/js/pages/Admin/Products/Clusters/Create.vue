<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <form class="space-y-7" @submit.prevent="onSubmit">
                    <div>
                        <Label for="name">Cluster Name</Label>
                        <Input
                            id="name"
                            ref="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="title"
                            placeholder="Cluster Name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <Label for="description">Cluster Description</Label>
                        <Textarea
                            id="description"
                            ref="description"
                            v-model="form.description"
                            type="text"
                            rows="6"
                            class="mt-1 block w-full"
                            placeholder="Cluster Description"
                        />
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <Button class="bg-teal-600 hover:bg-teal-700" type="submit"> Save </Button>
                        <Button as-child><Link href="/admin/products/clusters">Batal</Link></Button>
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
    form.post('/admin/products/clusters', {
        onSuccess: () => form.reset(),
    });
};
usePage();

defineProps<{
    errors: object;
}>();

const form = useForm({
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
        title: 'Clusters',
        href: '/admin/products/clusters',
    },
    {
        title: 'Create Cluster',
        href: '/admin/products/clusters/create',
    },
];
</script>

<style lang="postcss" scoped></style>
