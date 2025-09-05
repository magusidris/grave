<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <form class="space-y-7" @submit.prevent="onSubmit">
                    <div>
                        <Label for="name">Permission Name</Label>
                        <Input
                            id="name"
                            ref="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            autocomplete="title"
                            placeholder="Permission Name"
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
                        <Button as-child><Link href="/admin/management/permissions">Batal</Link></Button>
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
    form.post(`/admin/management/permissions/${props.permission.id}`, {
        onSuccess: () => form.reset(),
    });
};
usePage();

const props = defineProps<{
    permission: object;
    errors: object;
}>();

const form = useForm({
    _method: 'PATCH',
    name: props.permission.name,
});

const info = { title: 'Edit Permission', description: 'Edit an existing permission' };

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
        title: 'Permission User',
        href: '/admin/management/permissions',
    },
    {
        title: 'Create Permission',
        href: '/admin/management/permissions/create',
    },
];
</script>

<style lang="postcss" scoped></style>
