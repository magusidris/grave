<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall title="Create User" description="Create a new user" />
                <form class="space-y-7" @submit.prevent="onSubmit">
                    <div class="flex w-full flex-col gap-4 xl:flex-row">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="name">User Name</Label>
                            <Input
                                id="name"
                                ref="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="title"
                                placeholder="User Name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="email">Email Address</Label>
                            <Input
                                id="email"
                                ref="email"
                                v-model="form.email"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="email"
                                placeholder="Email Address"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="flex w-full flex-col gap-4 xl:flex-row">
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="password">Password</Label>
                            <Input id="password" ref="password" v-model="form.password" type="password" class="mt-1 block w-full" />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="grid w-full items-center gap-1.5">
                            <Label for="password_confirmation">Password Confirmation</Label>
                            <Input
                                id="password_confirmation"
                                ref="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                    </div>
                    <hr />
                    <div class="mr-3 inline-flex" v-for="(value, id) in roles" :key="id">
                        <div class="flex items-center space-x-2">
                            <label class="label cursor-pointer space-x-2 select-none" :for="`check-${value.id}`">
                                <input
                                    type="checkbox"
                                    checked="checked"
                                    class="checkbox"
                                    v-model="form.roles"
                                    :value="value.name"
                                    :id="`check-${value.id}`"
                                />
                                <span class="label-text">{{ value.name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <Button class="bg-teal-600 hover:bg-teal-700" type="submit"> Save </Button>
                        <Button as-child><Link href="/admin/management/users">Batal</Link></Button>
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
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const onSubmit = () => {
    form.post('/admin/management/users', {
        onSuccess: () => form.reset(),
    });
};
const page = usePage();

defineProps<{
    roles: Array;
    errors: Object;
}>();

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    roles: [],
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'User Management',
        href: '#',
    },
    {
        title: 'Role User',
        href: '/admin/management/users',
    },
    {
        title: 'Create Role',
        href: '/admin/management/users/create',
    },
];
</script>

<style lang="postcss" scoped></style>
