<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head :title="info.title" />
        <div class="p-4">
            <div class="flex h-full flex-col space-y-6">
                <HeadingSmall :title="info.title" :description="info.description" />
                <div class="h-[29rem]">
                    <form @submit.prevent="handleSearch">
                        <div class="mb-4 flex w-full items-center">
                            <Dialog>
                                <template #trigger>
                                    <Button class="h-10 w-27 rounded-r-none bg-teal-600 uppercase hover:bg-teal-700"
                                        ><Icon code="fa6-solid:plus" /> New
                                    </Button>
                                </template>
                                <template #header>
                                    <DialogTitle>Edit profile</DialogTitle>
                                    <DialogDescription> Make changes to your profile here. Click save when you're done. </DialogDescription>
                                </template>
                                <template #default>
                                    <div class="grid gap-4 py-4">
                                        <div class="grid grid-cols-4 items-center gap-4">
                                            <Label for="name" class="text-right"> Name </Label>
                                            <Input id="name" default-value="Pedro Duarte" class="col-span-3" />
                                        </div>
                                        <div class="grid grid-cols-4 items-center gap-4">
                                            <Label for="username" class="text-right"> Username </Label>
                                            <Input id="username" default-value="@peduarte" class="col-span-3" />
                                        </div>
                                    </div>
                                </template>
                            </Dialog>
                            <Input v-model="search" class="h-10 rounded-none" id="search" type="text" placeholder="Search" />
                            <Button class="h-10 w-27 rounded-l-none bg-teal-600 uppercase hover:bg-teal-700" type="submit">
                                <Icon code="heroicons:magnifying-glass-16-solid" /> Cari
                            </Button>
                        </div>
                    </form>
                    <Table>
                        <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
                        <TableHeader>
                            <TableRow>
                                <TableHead> Name </TableHead>
                                <TableHead> Cluster </TableHead>
                                <TableHead> Description </TableHead>
                                <TableHead class="w-[20em] text-center"> Actions </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(value, id) in graves.data" :key="id">
                                <TableCell class="content-start text-start text-base">
                                    {{ value.name }}
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    <Badge variant="secondary">
                                        {{ value.cluster.name }}
                                    </Badge>
                                </TableCell>
                                <TableCell class="content-start text-start text-base">
                                    {{ value.description }}
                                </TableCell>
                                <TableCell class="content-start text-center">
                                    <Button class="mr-2 bg-green-600 hover:bg-green-700" size="sm" as-child
                                        ><Link :href="`/admin/products/graves/${value.id}/edit`">
                                            <Icon code="fa6-solid:pencil" /> Edit
                                        </Link></Button
                                    >
                                    <AlertDialog
                                        @confirm="handleConfirmDelete(value)"
                                        iconTrigger="fa6-solid:trash"
                                        textTrigger="Delete"
                                        title="Yakin hapus cluster ini?"
                                        description="Cluster ini akan dihapus secara permanen."
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
                        :links="graves.links"
                        :prev="graves.prev_page_url"
                        :next="graves.next_page_url"
                        :current="graves.current_page"
                        :last="graves.last_page"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AlertDialog from '@/components/AlertDialog.vue';
import Dialog from '@/components/Dialog.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import Icon from '@/components/Icon.vue';
import Pagination from '@/components/Pagination.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { type Block, type BreadcrumbItem } from '@/types';
import { Head, Link, router, usePage } from '@inertiajs/vue3';

import { Label } from '@/components/ui/label';

import iziToast from 'izitoast';

import 'izitoast/dist/css/iziToast.min.css';
import { ref } from 'vue';

usePage();

defineProps<{
    graves: Block[];
    errors: object;
}>();

const search = ref(new URL(window.location.href).searchParams.get('q'));

const handleSearch = () => {
    router.get(
        route('admin.products.graves.index'),
        {
            q: search.value !== null ? search.value : '',
        },
        {
            preserveState: true,
        },
    );
};

const info = { title: 'Grave Management', description: 'Manage your Graves' };

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
        title: 'Graves',
        href: '/admin/products/graves',
    },
];

const handleConfirmDelete = (value: Block) => {
    router.delete(route('admin.products.graves.destroy', value.id), {
        preserveState: true,
        onSuccess: () => {
            iziToast.show({
                title: 'Success',
                theme: 'dark',
                icon: 'fa-solid fa-check',
                progressBarColor: 'rgb(0, 255, 184)',
                message: `Grave ${value.name} deleted successfully.`,
            });
        },
    });
};
</script>

<style scoped></style>
