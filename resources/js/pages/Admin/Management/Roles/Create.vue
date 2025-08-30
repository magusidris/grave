<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall title="Create Category" description="Create a new category" />
                <form class="w-2/3 space-y-6" @submit.prevent="onSubmit">
                    <div class="grid gap-2">
                        <Label for="image">Image</Label>
                        <FileUpload v-model="form.image" id="image" type="file" />
                        <InputError :message="form.errors.image" />
                    </div>
                    <div class="grid gap-2">
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
                        <InputError :message="form.errors.name" />
                    </div>
                    <Button type="submit"> Submit </Button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import FileUpload from '@/components/Fileupload.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type GPCategory } from '@/types';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const form = useForm({
    image: null,
    name: '',
});

const onSubmit = () => {
    form.post('/admin/master/categories', {
        onSuccess: () => form.reset(),
    });
};
const page = usePage();

const props = defineProps<{
    categories: GPCategory[];
    errors: Object;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Master',
        href: '#',
    },
    {
        title: 'Categories',
        href: '/admin/master/categories',
    },
    {
        title: 'Create Category',
        href: '/admin/master/categories/create',
    },
];
</script>

<style lang="postcss" scoped></style>
