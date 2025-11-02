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
                                <Label for="name">Customer Name</Label>
                                <div class="mt-1 flex w-full items-center">
                                    <Combobox
                                        class="inset-y-0 start-0 w-30 rounded-r-none"
                                        v-model="form.title"
                                        :items="titles"
                                        placeholder="Select title"
                                    />
                                    <Input v-model="form.name" class="rounded-l-none" id="name" type="text" placeholder="Customer Name" />
                                </div>
                                <div class="flex">
                                    <InputError
                                        class="mt-2"
                                        :class="form.errors.name ? 'mr-3 flex' : 'whitespace-nowrap'"
                                        :message="form.errors.title"
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="email">Email Address</Label>
                                <Input
                                    id="email"
                                    ref="email"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block"
                                    autocomplete="email"
                                    placeholder="Email Address"
                                />
                            </div>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                    </div>
                    <div class="flex w-full flex-col gap-4 xl:flex-row">
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="phone">Phone</Label>
                                <Input
                                    id="phone"
                                    ref="phone"
                                    v-model="form.phone"
                                    type="text"
                                    class="mt-1 block"
                                    autocomplete="phone"
                                    placeholder="Phone Number"
                                />
                            </div>
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="password">Password</Label>
                                <Input id="password" ref="password" v-model="form.password" type="password" class="mt-1 block w-full" />
                            </div>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="w-full">
                            <div class="grid w-full items-center gap-1.5">
                                <Label for="password_confirmation">Password Confirmation</Label>
                                <Input
                                    id="password_confirmation"
                                    ref="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <Button class="bg-teal-600 hover:bg-teal-700" type="submit"> Save </Button>
                        <Button as-child><Link href="/admin/customers">Batal</Link></Button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import Combobox from '@/components/Combobox.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';

const onSubmit = () => {
    form.post(`/admin/customers/${props.customer.id}`, {
        onSuccess: () => form.reset(),
    });
};
const page = usePage();

const props = defineProps<{
    titles: Array;
    customer: object;
    errors: object;
}>();

const form = useForm({
    _method: 'PATCH',
    title: props.customer.title,
    name: props.customer.name,
    email: props.customer.email,
    phone: props.customer.phone,
    password: '',
    password_confirmation: '',
});

const info = { title: 'Edit Customer', description: 'Edit customer details' };

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Admin',
        href: '#',
    },
    {
        title: 'Customer Management',
        href: '/admin/customers',
    },
    {
        title: 'Edit Customer',
        href: '/admin/customers/edit',
    },
];
</script>

<style lang="postcss" scoped></style>
