<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <div>
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Button class="h-10 w-27 rounded-r-none bg-teal-600 uppercase hover:bg-teal-700" as-child
                                ><Link href="/admin/management/users/create"><Icon code="fa6-solid:plus" /> New</Link>
                            </Button>
                            <Input v-model="search" class="h-10 rounded-none" id="search" type="text" placeholder="Search" />
                            <Button class="h-10 w-27 rounded-l-none bg-teal-600 uppercase hover:bg-teal-700" type="submit">
                                <Icon code="heroicons:magnifying-glass-16-solid" /> Cari
                            </Button>
                        </div>
                    </form>
                    <Table class="table-fixed">
                        <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
                        <TableHeader>
                            <TableRow>
                                <TableHead> Name </TableHead>
                                <TableHead> Email Address </TableHead>
                                <TableHead> Roles </TableHead>
                                <TableHead class="w-[20em] text-center"> Actions </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(value, id) in users.data" :key="id">
                                <TableCell class="content-start text-start text-base">
                                    {{ value.name }}
                                </TableCell>
                                <TableCell class="content-start">
                                    {{ value.email }}
                                </TableCell>
                                <TableCell class="content-start">
                                    <Badge variant="secondary">
                                        {{ value.roles[0].name }}
                                    </Badge>
                                </TableCell>
                                <TableCell class="content-start text-center">
                                    <Button class="mr-2 bg-green-600 hover:bg-green-700" size="sm" as-child
                                        ><Link :href="`/admin/management/users/${value.id}/edit`">
                                            <Icon code="fa6-solid:pencil" /> Edit
                                        </Link></Button
                                    >
                                    <AlertDialog
                                        @confirm="handleConfirmDelete(value)"
                                        iconTrigger="fa6-solid:trash"
                                        textTrigger="Delete"
                                        title="Yakin hapus peran ini?"
                                        description="Peran ini akan dihapus secara permanen."
                                        cancelText="Batal"
                                        confirmText="Hapus"
                                        type="warning"
                                    >
                                    </AlertDialog>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>
                <div class="flex justify-end">
                    <Pagination
                        :links="users.links"
                        :prev="users.prev_page_url"
                        :next="users.next_page_url"
                        :current="users.current_page"
                        :last="users.last_page"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AlertDialog from '@/components/AlertDialog.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import Pagination from '@/components/Pagination.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import iziToast from 'izitoast';

import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Identity } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

import 'izitoast/dist/css/iziToast.min.css';

const page = usePage();

const props = defineProps<{
    users: Identity[];
    errors: object;
}>();

const search = ref(new URL(document.location).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.management.users.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

const info = { title: 'User Management', description: 'Manage your Users' };

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
        title: 'User Management',
        href: '/admin/management/users',
    },
];

const handleConfirmDelete = (user: Identity) => {
    router.delete(route('admin.management.users.destroy', user.id), {
        preserveState: true,
        onSuccess: () => {
            iziToast.show({
                title: 'Success',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                progressBarColor: 'rgb(0, 255, 184)',
                message: `User ${user.name} deleted successfully.`,
            });
        },
    });
};
</script>

<style scoped></style>
