<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Dashboard" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall title="Create Category" description="Create a new category" />
                <form class="space-y-7" @submit.prevent="onSubmit">
                    <div>
                        <Label for="name">Role Name</Label>
                        <Input
                            id="name"
                            ref="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="title"
                            placeholder="Role Name"
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <hr />
                    <div class="mr-3 inline-flex" v-for="(value, id) in permissions" :key="id">
                        <div class="flex items-center space-x-2">
                            <label class="label cursor-pointer space-x-2 select-none" :for="`check-${value.id}`">
                                <input
                                    type="checkbox"
                                    checked="checked"
                                    class="checkbox"
                                    v-model="form.permissions"
                                    :value="value.name"
                                    :id="`check-${value.id}`"
                                />
                                <span class="label-text">{{ value.name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <Button class="bg-teal-600 hover:bg-teal-700" type="submit"> Save </Button>
                        <Button as-child><Link href="/admin/management/roles">Batal</Link></Button>
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
    form.post(`/admin/management/roles/${props.role.id}`, {
        onSuccess: () => form.reset(),
    });
};
const page = usePage();

const props = defineProps<{
    permissions: Array;
    role: Object;
    errors: Object;
}>();

const form = useForm({
    _method: 'PATCH',
    name: props.role.name,
    permissions: props.role.permissions.map((obj) => obj.name),
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
        href: '/admin/management/roles',
    },
    {
        title: 'Create Role',
        href: '/admin/management/roles/create',
    },
];
</script>

<style lang="postcss" scoped></style>
